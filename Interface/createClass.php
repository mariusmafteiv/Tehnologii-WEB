<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header('Location: connection.php');
        exit;
    }

    if (!isset($_POST['title']) || empty($_POST['title'])) {
        header('Location: myclasses.php');
        exit;
    }

    include 'db_connection.php';

    $title = $_POST['title'];
    $teachers = $_POST['teachs'];
    $students = $_POST['studs'];
    $userId = $_SESSION['user']['ID'];

    $query = "INSERT INTO classes (Title, CreatedAt, CreatedBy) VALUES (?, NOW(), ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $title, $userId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $classId = $stmt->insert_id;

        if (!empty($teachers)) {
            $teachersArr = explode(",", $teachers);
            foreach ($teachersArr as $teacher) {
                $teacher = trim($teacher);
                $query = "INSERT INTO classmembers (ClassID, StudentID) 
                          SELECT ?, ID FROM users WHERE Email = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('is', $classId, $teacher);
                $stmt->execute();
            }
        }

        if (!empty($students)) {
            $studentsArr = explode(",", $students);
            foreach ($studentsArr as $student) {
                $student = trim($student);
                $query = "INSERT INTO classmembers (ClassID, StudentID) 
                          SELECT ?, ID FROM users WHERE Email = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('is', $classId, $student);
                $stmt->execute();
            }
        }
    }

    header('Location: myclasses.php');
    exit;
}
?>
