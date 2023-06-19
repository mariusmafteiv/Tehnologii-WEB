<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selected Class</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="stylesheets/selectedClass.css">
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header('Location: connection.php');
        exit;
    }

    include 'db_connection.php';

    $loginText = $_SESSION['logged_in'] == true ? "Logout" : "Login";

    // Getting class details
    $classId = $_GET['class_id'];
    $query = "SELECT classes.Title, users.FirstName, users.LastName FROM classes JOIN users ON classes.CreatedBy = users.ID WHERE classes.ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $classId);
    $stmt->execute();
    $result = $stmt->get_result();
    $class = $result->fetch_assoc();

    // Getting members of class
    $query = "SELECT users.FirstName, users.LastName FROM classmembers JOIN users ON classmembers.StudentID = users.ID WHERE classmembers.ClassID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $classId);
    $stmt->execute();
    $result = $stmt->get_result();
    $membersArray = $result->fetch_all(MYSQLI_ASSOC);

    $members = [];
    foreach ($membersArray as $member) {
        $members[] = $member['FirstName'] . ' ' . $member['LastName'];
    }


    // Getting problems of class
    $query = "SELECT problems.ID, problems.Title, problems.Difficulty, GROUP_CONCAT(tags.Name SEPARATOR '|||') as Tags 
        FROM classproblems JOIN problems ON classproblems.ProblemID = problems.ID JOIN problemtags ON problems.ID = problemtags.ProblemID JOIN tags ON problemtags.TagID = tags.ID 
        WHERE classproblems.ClassID = ? GROUP BY problems.ID";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $classId);
    $stmt->execute();
    $result = $stmt->get_result();
    $problemsArray = $result->fetch_all(MYSQLI_ASSOC);

    $problems = [];
    foreach ($problemsArray as $problem) {
        $tagsArray = explode('|||', $problem['Tags']);
        $problem['Tags'] = implode(', ', $tagsArray);
        $problems[] = $problem;
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
            <li><a href="home.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="myclasses.php">Classes</a></li>
            <li><a href="work.php">Work</a></li>
            <li><a href="connection.php" class="dm-login-btn" style="--clr:#39424A">
                    <?php echo $loginText; ?>
                </a></li>
        </div>
    </header>
    <div class="container">
        <div class="title-box">
            <div class="title">
                <?php echo $class['Title']; ?>
            </div>
            <div class="subtitle">Created by:
                <?php echo $class['FirstName'] . ' ' . $class['LastName']; ?>
            </div>
            <div class="subtitle">Members:
                <?php echo implode(', ', $members); ?>
            </div>
        </div>
        <div class="problems-box">
            <?php foreach ($problems as $problem) { ?>
                <a href="selectedProblem.php?problem_id=<?php echo $problem['ID']; ?>" class="box-link">
                    <img src="assets/<?php echo ucfirst($problem['Difficulty']); ?>.png" class="problem-img">
                    <div class="problem">
                        <div class="problem-title">
                            <?php echo $problem['Title']; ?>
                        </div>
                        <div class="problem-tags">#
                            <?php echo $problem['Tags']; ?>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
    <script src="scripts/navbar.js"></script>
</body>

</html>