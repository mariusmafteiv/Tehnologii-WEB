<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/profile.css">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header('Location: connection.php');
        exit;
    }

    include 'db_connection.php';

    $email = $_SESSION['user']['Email'];
    $firstName = $_SESSION['user']['FirstName'];
    $lastName = $_SESSION['user']['LastName'];
    $userId = $_SESSION['user']['ID'];

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        $loginText = "Logout";
    } else {
        $loginText = "Login";
    }

    $query = 'SELECT classes.Title FROM classes 
        JOIN classmembers ON classes.ID = classmembers.ClassID 
        WHERE classmembers.StudentID = ?';

    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userId);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        $classes = array();
        while ($row = $result->fetch_assoc()) {
            $classes[] = $row['Title'];
        }

        $classesString = implode(', ', $classes);
    } else {
        echo "Database error: " . $stmt->error;
    }

    $queryProblemsSolved = 'SELECT COUNT(DISTINCT ProblemID) as numProblemsSolved FROM solutions WHERE UserId = ?';
    $stmtProblemsSolved = $conn->prepare($queryProblemsSolved);
    $stmtProblemsSolved->bind_param('i', $userId);

    if ($stmtProblemsSolved->execute()) {
        $resultProblemsSolved = $stmtProblemsSolved->get_result();
        $rowProblemsSolved = $resultProblemsSolved->fetch_assoc();
        $numProblemsSolved = $rowProblemsSolved['numProblemsSolved'];
    } else {
        echo "Database error: " . $stmtProblemsSolved->error;
    }


    $queryProblemsSolvedC = 'SELECT COUNT(DISTINCT ProblemID) as numProblemsSolvedCorr FROM solutions WHERE UserId = ? AND IsCorrect = "corect"';
    $stmtProblemsSolvedC = $conn->prepare($queryProblemsSolvedC);
    $stmtProblemsSolvedC->bind_param('i', $userId);

    if ($stmtProblemsSolvedC->execute()) {
        $resultProblemsSolvedC = $stmtProblemsSolvedC->get_result();
        $rowProblemsSolvedC = $resultProblemsSolvedC->fetch_assoc();
        $numProblemsSolvedC = $rowProblemsSolvedC['numProblemsSolvedCorr'];
    } else {
        echo "Database error: " . $stmtProblemsSolvedC->error;
    }

    $queryAttemptedProblems = "SELECT problems.Id, problems.Title FROM problems
    JOIN solutions ON problems.Id = solutions.ProblemId
    WHERE solutions.UserId = ?";
    $stmtAttemptedProblems = $conn->prepare($queryAttemptedProblems);
    $stmtAttemptedProblems->bind_param('i', $userId);

    if ($stmtAttemptedProblems->execute()) {
        $resultAttemptedProblems = $stmtAttemptedProblems->get_result();

        $uniqueProblems = array();
        while ($row = $resultAttemptedProblems->fetch_assoc()) {
            $problemName = $row['Title'];
            $problemId = $row['Id'];

            if (!isset($uniqueProblems[$problemName])) {
                $uniqueProblems[$problemName] = $problemId;
            }
        }

        // Sortăm problemele după nume în ordine alfabetică
        ksort($uniqueProblems);

    } else {
        echo "Database error: " . $stmtAttemptedProblems->error;
    }

    ?>
    <header>
        <div class="navbar">
            <div class="logo">
                <h2>PrInfo</h2>
            </div>
            <ul class="links">
                <li><a href="home.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="myclasses.php">Classes</a></li>
                <li><a href="work.php">Work</a></li>
            </ul>
            <a href="connection.php" class="login-btn" style="--clr:#E9DCD1">
                <?php echo $loginText; ?>
            </a>
            <div class="toggle-btn">
                <i class="fa fa-bars"></i>
            </div>
        </div>
        <div class="dropdown-menu">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="myclasses.php">Classes</a></li>
                <li><a href="work.php">Work</a></li>
                <li><a href="connection.php" class="dm-login-btn" style="--clr:#39424A">
                        <?php echo $loginText; ?>
                    </a></li>
            </ul>
        </div>
    </header>
    <div class="content">
        <div class="upper">
            <div class="profile-box">
                <span class="profile picture"></span>
            </div>
            <div class="upper-right">
                <div class="information-box">
                    <div class="username">
                        <h2>
                            <?php echo $firstName; ?>
                        </h2>
                        <h2>
                            <?php echo $lastName; ?>
                        </h2>
                    </div>
                    <div class="details">
                        <h1>Email :
                            <?php echo $email; ?>
                        </h1>
                        <h1>Number of problems solved :
                            <?php echo $numProblemsSolved; ?>
                        </h1>
                        <h1>Correct solutions :
                            <?php echo $numProblemsSolvedC; ?>
                        </h1>
                        <h1>Joined Classes :
                            <?php echo implode(', ', $classes); ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom">
            <h2>Problems Solved</h2>
            <ul class="list">
                <?php foreach ($uniqueProblems as $problemName => $problemId) { ?>
                    <a href="solvedProblem.php?problem_id=<?php echo $problemId; ?>"
                        style="text-decoration: none; color: inherit;">
                        <li class="list-item">
                            <?php echo $problemName; ?>
                        </li>
                    </a>
                <?php } ?>
            </ul>

        </div>
    </div>
    <script src="scripts/navbar.js"></script>
    <!-- Following scripts are for icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>