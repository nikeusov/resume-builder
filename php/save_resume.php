<?php
header('Content-Type: application/json');
session_start();
require 'db_connect.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $education = trim($_POST['education']);
    $experience = trim($_POST['experience']);
    $skills = trim($_POST['skills']);
    $template = trim($_POST['template']);

    if (empty($name) || empty($email)) {
        $response['message'] = 'All required fields must be filled.';
        echo json_encode($response);
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO resumes (user_id, name, email, phone, education, experience, skills, template) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $name, $email, $phone, $education, $experience, $skills, $template]);
        $resume_id = $pdo->lastInsertId(); 
        $response['success'] = true;
        $response['message'] = 'Resume saved successfully!';
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