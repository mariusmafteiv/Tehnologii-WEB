<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes</title>
    <link rel="stylesheet" href="stylesheets/myclasses.css">
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

    $isTeacher = isset($_SESSION['user']['Role']) && $_SESSION['user']['Role'] === 'teacher';

    if (isset($_SESSION['user']['Role']) && $_SESSION['user']['Role'] == 'student') {
        $userId = $_SESSION['user']['ID'];

        $query = "SELECT classes.ID, classes.Title, classes.CreatedAt, users.FirstName, users.LastName,
              (SELECT COUNT(*) FROM classmembers WHERE classmembers.ClassID = classes.ID) AS MemberCount
              FROM classes
              JOIN users ON classes.CreatedBy = users.ID
              JOIN classmembers ON classmembers.ClassID = classes.ID
              WHERE classmembers.StudentID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $classes = $result->fetch_all(MYSQLI_ASSOC);

    } else {
        $userId = $_SESSION['user']['ID'];

        $query = "SELECT classes.ID, classes.Title, classes.CreatedAt, users.FirstName, users.LastName,
            (SELECT COUNT(*) FROM classmembers WHERE classmembers.ClassID = classes.ID) AS MemberCount
            FROM classes
            JOIN users ON classes.CreatedBy = users.ID
            WHERE classes.CreatedBy = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $classes = $result->fetch_all(MYSQLI_ASSOC);
    }

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        $loginText = "Logout";
    } else {
        $loginText = "Login";
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

    <?php if ($isTeacher): ?>
        <button class="new-post new-class" onclick="openPopup()">New Class</button>
        <button class="new-post assign-homework" onclick="openAssignPopup()">Assign Homework</button>
        <div class="container">
            <div class="popup" id="pp">
                <button class="close-button" aria-label="Close alert" type="button" data-close onclick="closePopup()">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="popup-title">Create New Class</h2>
                <form action="createClass.php" method="POST">
                    <label for="title" type="required">Class Title: </label>
                    <input type="text" id="title" name="title" required><br>

                    <label for="teachs">Add Teachers: </label>
                    <textarea id="teachs" name="teachs"></textarea><br>

                    <label for="studs">Add Students: </label>
                    <textarea id="studs" name="studs"></textarea><br>

                    <div class="buttons-container">
                        <button type="submit" class="create-button">Create</button>
                        <button type="button" class="cancel-button" onclick="closePopup()">Cancel</button>
                    </div>
                </form>
            </div>

            <div class="assign-popup" id="ap">
                <button class="close-button-h" aria-label="Close alert" type="button" data-close
                    onclick="closeAssignPopup()">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="popup-title-h">Assign Homework</h2>
                <form action="assignHomework.php" method="POST">
                    <label for="hw-problems" type="required">Homework Problems: </label>
                    <textarea id="hw-problems" name="hw-problems"></textarea><br>

                    <label for="hw-class" type="required">Class: </label>
                    <textarea id="hw-class" name="hw-class"></textarea><br>

                    <div class="buttons-container">
                        <button type="submit" class="create-button-h">Assign</button>
                        <button type="button" class="cancel-button-h" onclick="closeAssignPopup()">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    <?php endif; ?>

    <ul class="problem-list">
        <?php foreach ($classes as $class): ?>
            <div class="box">
                <li class="list-item">
                    <?php echo $class['Title']; ?>
                    <div class="problem-details">
                        <p>Number of students:
                            <?php echo $class['MemberCount']; ?>
                        </p>
                        <p>Created by:
                            <?php echo $class['FirstName'] . ' ' . $class['LastName']; ?>
                        </p>
                        <p>Created at:
                            <?php echo $class['CreatedAt']; ?>
                        </p>
                        <a href="selectedClass.php?class_id=<?php echo $class['ID']; ?>" class="button">View Class</a>
                    </div>
                </li>
            </div>
        <?php endforeach; ?>
    </ul>

    <script src="scripts/myclasses.js"></script>
    <script src="scripts/navbar.js"></script>
</body>

</html>