<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifică dacă toate câmpurile sunt completate
    if (isset($_POST['title']) && isset($_POST['tags']) && isset($_POST['description']) && isset($_POST['difficulty'])) {
        // Preia valorile trimise prin formular
        $title = $_POST['title'];
        $tags = $_POST['tags'];
        $description = $_POST['description'];
        $difficulty = $_POST['difficulty'];
        $createdBy = $_SESSION['user']['ID'];

        $queryCheck = "SELECT ID FROM problems WHERE Title = ?";
        $stmtCheck = $conn->prepare($queryCheck);
        $stmtCheck->bind_param('s', $title);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            // Titlul problemei există deja în baza de date
            header('Location: work.php');
            exit;
        }

        $problemQuery = "INSERT INTO problems (Title, Description, Difficulty, CreatedAt, CreatedBy) VALUES (?, ?, ?, CURRENT_TIMESTAMP(), ?)";
        $problemStmt = $conn->prepare($problemQuery);
        $problemStmt->bind_param('sssi', $title, $description, $difficulty, $createdBy);
        $problemStmt->execute();

        if ($problemStmt->affected_rows > 0) {
            // Inserarea problemei s-a realizat cu succes
            $problemId = $problemStmt->insert_id;
            $tagArray = explode(',', $tags);
            $tagIds = [];

            foreach ($tagArray as $tagName) {
                $tagName = trim($tagName);

                // Verifică dacă tagul există deja în tabela tags
                $tagCheckQuery = "SELECT ID FROM tags WHERE Name = ?";
                $tagCheckStmt = $conn->prepare($tagCheckQuery);
                $tagCheckStmt->bind_param('s', $tagName);
                $tagCheckStmt->execute();
                $tagCheckResult = $tagCheckStmt->get_result();

                if ($tagCheckResult->num_rows > 0) {
                    // Tagul există deja, obține ID-ul și îl adaugă în lista tagIds
                    $existingTag = $tagCheckResult->fetch_assoc();
                    $tagIds[] = $existingTag['ID'];
                } else {
                    // Tagul nu există, inserează-l în tabela tags și obține ID-ul
                    $tagInsertQuery = "INSERT INTO tags (Name) VALUES (?)";
                    $tagInsertStmt = $conn->prepare($tagInsertQuery);
                    $tagInsertStmt->bind_param('s', $tagName);
                    $tagInsertStmt->execute();

                    if ($tagInsertStmt->affected_rows > 0) {
                        $tagId = $tagInsertStmt->insert_id;
                        $tagIds[] = $tagId;
                    }
                }
            }

            // Inserează relația dintre problema nou-creată și tagurile asociate în tabela problemtags
            foreach ($tagIds as $tagId) {
                $problemtagQuery = "INSERT INTO problemtags (ProblemID, TagID) VALUES (?, ?)";
                $problemtagStmt = $conn->prepare($problemtagQuery);
                $problemtagStmt->bind_param('ii', $problemId, $tagId);
                $problemtagStmt->execute();
            }

            // Redirecționează utilizatorul către o pagină de succes sau afișează un mesaj de confirmare
            header('Location: work.php');
            exit;
        }
    }
}

// Redirecționează utilizatorul către pagina de lucru în caz de eroare sau acces nepermis
header('Location: work.php');
exit;
?>
