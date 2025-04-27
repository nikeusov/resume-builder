<?php
header('Content-Type: application/json');
require 'db_connect.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $password]);
        $response['success'] = true;
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            $response['message'] = 'User with this email is already registered';
        } else {
            $response['message'] = 'Error: ' . $e->getMessage();
        }
    }
}

echo json_encode($response);
?>