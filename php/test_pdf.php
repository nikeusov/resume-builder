<?php
require '../vendor/autoload.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$html = '<h1>Test PDF</h1><p>This is a test PDF generated by Dompdf.</p>';
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("test.pdf", ["Attachment" => true]);
?>