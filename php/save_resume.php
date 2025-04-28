<?php
session_start();
require 'db_connect.php';

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
        header("Location: ../resume_form.php?error=required_fields");
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO resumes (user_id, name, email, phone, education, experience, skills, template) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $name, $email, $phone, $education, $experience, $skills, $template]);
        header("Location: ../resume_form.php?success=1");
        exit;
    } catch (PDOException $e) {
        header("Location: ../resume_form.php?error=db_error");
        exit;
    }
} else {
    header("Location: ../login.html");
    exit;
}
?>