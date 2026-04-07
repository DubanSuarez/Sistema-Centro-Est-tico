<?php
require_once('../../Conexiones/conexion.php');
require_once('../../Factura/fpdf186/fpdf.php');

if (!isset($_GET['id'])) {
    die('Factura no válida');
}

$idFactura = (int) $_GET['id'];

/* ==========================
   FUNCIÓN UTF8
========================== */
function txt($s) {
    return utf8_decode($s);
}

/* ==========================
   CLASE PDF (ROTACIÓN)
========================== */
class PDF extends FPDF
{
    protected $angle = 0;

    function Rotate($angle, $x = -1, $y = -1)
    {
        if ($x == -1) $x = $this->x;
        if ($y == -1) $y = $this->y;

        if ($this->angle != 0) {
            $this->_out('Q');
        }

        $this->angle = $angle;

        if ($angle != 0) {
            $angle *= M_PI / 180;
            $c = cos($angle);
            $s = sin($angle);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;

            $this->_out(sprintf(
                'q %.5F %.5F %.5F %.5F %.5F %.5F cm',
                $c, $s, -$s, $c,
                $cx, $cy
            ));
        }
    }

    function RotatedText($x, $y, $txt, $angle)
    {
        $this->Rotate($angle, $x, $y);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
    }
}

/* ==========================
   DATOS FACTURA
========================== */
$sqlFactura = "
    SELECT 
        f.numero_factura,
        f.FechaHora,
        f.Subtotal,
        f.Descuento,
        f.Total,
        f.Metodo_Pago,
        f.Estado,
        p.Nombre,
        p.Apellido,
        p.NumeroDocumento,
        p.NumeroTelefono
    FROM factura f
    INNER JOIN paciente p ON p.Id = f.Id_Paciente
    WHERE f.Id = $idFactura
";
$factura = $conexion->query($sqlFactura)->fetch_assoc();

/* ==========================
   DETALLE
========================== */
$sqlDetalle = "
    SELECT
        c.Servicio,
        c.Descuento,
        df.Precio,
        df.Total
    FROM detalle_factura df
    INNER JOIN cita c ON c.Id = df.Id_Cita
    WHERE df.Id_Factura = $idFactura
";
$detalle = $conexion->query($sqlDetalle);

/* ==========================
   PDF
========================== */
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);

/* ===== MARCA DE AGUA ===== */
$pdf->SetFont('Arial', 'B', 50);
$pdf->SetTextColor(220, 235, 235);
$pdf->RotatedText(25, 190, txt('LOTUS SPLENDOR'), 45);

/* ===== ENCABEZADO ===== */
$pdf->SetTextColor(0, 128, 128);
$pdf->Image('../../Factura/Img/logo.png', 10, 10, 28);

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, txt('LOTUS SPLENDOR'), 0, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 6, txt('Centro Estético y Bienestar'), 0, 1, 'C');
$pdf->Ln(10);

/* ===== INFO FACTURA ===== */
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 8, txt('Factura #') . $factura['numero_factura'], 0, 1);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(100, 6, txt('Paciente: ') . txt($factura['Nombre'].' '.$factura['Apellido']), 0, 0);
$pdf->Cell(0, 6, txt('Fecha: ') . date('d/m/Y H:i', strtotime($factura['FechaHora'])), 0, 1);

$pdf->Cell(100, 6, txt('Documento: ') . $factura['NumeroDocumento'], 0, 0);
$pdf->Cell(0, 6, txt('Método de pago: ') . txt($factura['Metodo_Pago']), 0, 1);

$pdf->Ln(8);

/* ===== TABLA ===== */
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 235, 235);

$pdf->Cell(70, 8, txt('Servicio'), 1, 0, 'C', true);
$pdf->Cell(30, 8, txt('Precio'), 1, 0, 'C', true);
$pdf->Cell(30, 8, txt('Desc.'), 1, 0, 'C', true);
$pdf->Cell(30, 8, txt('Total'), 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 10);

while ($row = $detalle->fetch_assoc()) {

    $desc = $row['Descuento'] > 0 ? $row['Descuento'].'%' : '0%';

    $pdf->Cell(70, 8, txt($row['Servicio']), 1);
    $pdf->Cell(30, 8, '$'.number_format($row['Precio'], 0, ',', '.'), 1, 0, 'R');
    $pdf->Cell(30, 8, $desc, 1, 0, 'R');
    $pdf->Cell(30, 8, '$'.number_format($row['Total'], 0, ',', '.'), 1, 1, 'R');
}

/* ===== TOTALES ===== */
$pdf->Ln(6);
$pdf->Cell(130);
$pdf->Cell(30, 6, txt('Subtotal:'), 0);
$pdf->Cell(30, 6, '$'.number_format($factura['Subtotal'], 0, ',', '.'), 0, 1, 'R');

$pdf->Cell(130);
$pdf->Cell(30, 6, txt('Descuento:'), 0);
$pdf->Cell(30, 6, '$'.number_format($factura['Descuento'], 0, ',', '.'), 0, 1, 'R');

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(130);
$pdf->Cell(30, 8, txt('TOTAL:'), 0);
$pdf->Cell(30, 8, '$'.number_format($factura['Total'], 0, ',', '.'), 0, 1, 'R');

/* ===== PIE ===== */
$pdf->Ln(12);
$pdf->SetFont('Arial', 'I', 9);
$pdf->SetTextColor(100, 100, 100);
$pdf->Cell(0, 6, txt('Gracias por confiar en Lotus Splendor'), 0, 1, 'C');

/* ===== SALIDA ===== */
$pdf->Output('I', 'Factura_'.$factura['numero_factura'].'.pdf');
