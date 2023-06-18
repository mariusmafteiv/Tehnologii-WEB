<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $isProfessor = isset($_POST['is_professor']) ? 1 : 0;

    $query = "SELECT * FROM users WHERE Email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "A user with this email already exists.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $role = $isProfessor ? 'teacher' : 'student';

        $query = "INSERT INTO users (FirstName, LastName, Email, Password, Role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssss', $name, $surname, $email, $hashedPassword, $role);
        
        if ($stmt->execute()) {
            header("Location: connection.php");
            exit;
        } else {
            echo "Database error: " . $stmt->error;
        }
    }
}
?>