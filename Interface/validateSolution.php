<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: connection.php');
    exit;
}

if ($_SESSION['user']['Role'] !== 'teacher') {
    header('Location: work.php');
    exit;
}

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $solution_id = $_POST['solution_id'];
    $is_correct = $_POST['is_correct'];

    $updateQuery = "UPDATE solutions SET isCorrect = ? WHERE ID = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param('si', $is_correct, $solution_id);

    if ($stmt->execute()) {
        header('Location: work.php?message=Solution+validated+successfully');
    } else {
        header('Location: work.php?message=Solution+validation+failed');
    }
}
?>
