<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header('Location: connection.php');
        exit;
    }

    if (!isset($_POST['hw-problems']) || empty($_POST['hw-problems']) || !isset($_POST['hw-class']) || empty($_POST['hw-class'])) {
        header('Location: myclasses.php');
        exit;
    }

    include 'db_connection.php';

    $problems = $_POST['hw-problems'];
    $classTitle = $_POST['hw-class'];

    // Obțineți ID-ul clasei folosind titlul
    $query = "SELECT ID FROM classes WHERE Title = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $classTitle);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificați dacă clasa există în baza de date
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $classId = $row['ID'];

        // Explodați titlurile problemelor într-un array folosind separatorul virgulă
        $problemTitles = explode(",", $problems);

        foreach ($problemTitles as $problemTitle) {
            $problemTitle = trim($problemTitle);

            // Obțineți ID-ul problemei folosind titlul
            $query = "SELECT ID FROM problems WHERE Title = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $problemTitle);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verificați dacă problema există în baza de date
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $problemId = $row['ID'];

                // Efectuați inserția în tabelul classproblems
                $query = "INSERT INTO classproblems (ClassID, ProblemID) VALUES (?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('ii', $classId, $problemId);
                $stmt->execute();
            } else {
                header('Location: myclasses.php');
                exit;
            }
        }
    } else {
        header('Location: myclasses.php');
        exit;
    }

    header('Location: myclasses.php');
    exit;
}
?>