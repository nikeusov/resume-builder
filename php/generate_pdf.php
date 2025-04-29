<?php
session_start();
require 'db_connect.php';
require '../vendor/autoload.php';

use Dompdf\Dompdf;

if (!isset($_SESSION['user_id']) || !isset($_GET['resume_id'])) {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
        exit;
    }
    header("Location: ../login.html");
    exit;
}

$resume_id = $_GET['resume_id'];
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM resumes WHERE id = ? AND user_id = ?");
$stmt->execute([$resume_id, $user_id]);
$resume = $stmt->fetch();

if (!$resume) {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Resume not found']);
        exit;
    }
    echo "Resume not found.";
    exit;
}

ob_start();
include "../templates/{$resume['template']}.php";
$html = ob_get_clean();

// Указываем кодировку UTF-8
$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

$dompdf = new Dompdf();
$dompdf->loadHtml($html, 'UTF-8');
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("resume_{$resume['id']}.pdf", ["Attachment" => true]);
exit;
?>