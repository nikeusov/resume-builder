<?php
header('Content-Type: application/json');
session_start();
require 'db_connect.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $resume_id = trim($_POST['resume_id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $education = trim($_POST['education']);
    $experience = trim($_POST['experience']);
    $skills = trim($_POST['skills']);
    $template = trim($_POST['template']);

    if (empty($name) || empty($email) || empty($resume_id)) {
        $response['message'] = 'All required fields must be filled.';
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

        // Обновляем резюме
        $stmt = $pdo->prepare("UPDATE resumes SET name = ?, email = ?, phone = ?, education = ?, experience = ?, skills = ?, template = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([$name, $email, $phone, $education, $experience, $skills, $template, $resume_id, $user_id]);
        
        $response['success'] = true;
        $response['message'] = 'Resume updated successfully!';
        $response['resume_id'] = $resume_id;
        $response['name'] = $name;
        $response['created_at'] = date('Y-m-d H:i:s');
    } catch (PDOException $e) {
        $response['message'] = 'Database error: ' . $e->getMessage();
    }
} else {
    $response['message'] = 'Unauthorized access.';
}

echo json_encode($response);
exit;
?>