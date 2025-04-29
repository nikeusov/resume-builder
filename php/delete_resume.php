<?php
header('Content-Type: application/json');
session_start();
require 'db_connect.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $resume_id = trim($_POST['resume_id']);

    if (empty($resume_id)) {
        $response['message'] = 'Resume ID is required.';
        echo json_encode($response);
        exit;
    }

    try {
        // Проверяем, что резюме принадлежит текущему пользователю
        $stmt = $pdo->prepare("SELECT id FROM resumes WHERE id = ? AND user_id = ?");
        $stmt->execute([$resume_id, $user_id]);
        if (!$stmt->fetch()) {
            $response['message'] = 'Resume not found or unauthorized.';
            echo json_encode($response);
            exit;
        }

        // Удаляем резюме
        $stmt = $pdo->prepare("DELETE FROM resumes WHERE id = ? AND user_id = ?");
        $stmt->execute([$resume_id, $user_id]);
        
        $response['success'] = true;
        $response['message'] = 'Resume deleted successfully!';
        $response['resume_id'] = $resume_id;
    } catch (PDOException $e) {
        $response['message'] = 'Database error: ' . $e->getMessage();
    }
} else {
    $response['message'] = 'Unauthorized access.';
}

echo json_encode($response);
exit;
?>