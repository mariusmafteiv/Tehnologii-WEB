<?php
session_start();
include 'db_connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE Email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['Password'])) {
                $_SESSION['logged_in'] = true;
                $_SESSION['user'] = $user;
                header('Location: profile.php');
                exit;
            } else {
                echo "Incorrect password. Please try again.";
            }
        } else {
            echo "No user found with this email.";
        }
    } else {
        echo "Database error: " . $stmt->error;
    }
}
?>