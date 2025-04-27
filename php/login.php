<?php
ini_set('display_errors', 0);


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

require 'db_connect.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['email']) || empty($_POST['password'])) {
        $response['message'] = 'All fields are required';
        echo json_encode($response);
        exit;
    }

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $response['success'] = true;
        } else {
            $response['message'] = 'Invalid email or password';
        }
    } catch (PDOException $e) {
        $response['message'] = 'Database error: ' . $e->getMessage();
    }
} else {
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
exit;
?>