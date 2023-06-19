<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: connection.php');
    exit;
}
include 'db_connection.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    $loginText = "Logout";
} else {
    $loginText = "Login";
}

$isTeacher = isset($_SESSION['user']['Role']) && $_SESSION['user']['Role'] === 'teacher';

// Obțineți toate problemele din baza de date
$problemQuery = "SELECT * FROM problems";
$problemResult = $conn->query($problemQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work</title>
    <link rel="stylesheet" href="stylesheets/work.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
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

    <?php if ($isTeacher): ?>
        <button class="new-post" onclick="openPopup()">New Post</button>
        <button class="validate-solutions" onclick="openSolutionPopup()">Validate Solutions</button>
        <div class="container">
            <div class="popup" id="pp">
                <button class="close-button" aria-label="Close alert" type="button" data-close onclick="closePopup()">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="popup-title">Create New Post</h2>
                <form action="createPost.php" method="POST">
                    <label for="difficulty">Difficulty: </label>
                    <select id="difficulty" name="difficulty" required>
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                    </select><br>

                    <label for="title" type="required">Title: </label>
                    <input type="text" id="title" name="title" required><br>

                    <label for="tags" type="required">Tags: </label>
                    <input type="text" id="tags" name="tags" required><br>

                    <label for="description">Description: </label>
                    <textarea id="description" name="description" required></textarea><br>

                    <div class="buttons-container">
                        <button class="import-button" type="button">Import</button>
                        <button class="create-button" type="submit">Create</button>
                        <button class="cancel-button" type="button" onclick="closePopup()">Cancel</button>
                    </div>
                </form>
            </div>

            <div class="solution-popup" id="sp">
    <button class="close-button" aria-label="Close alert" type="button" data-close onclick="closeSolutionPopup()">
        <span aria-hidden="true">&times;</span>
    </button>
    <h2 class="popup-title-s">Validate Solutions</h2>
    <?php
    $solutionQuery = "SELECT solutions.ID as SolutionID, SolutionText, problems.Title as ProblemTitle, problems.Description as ProblemDescription, users.FirstName, users.LastName FROM solutions JOIN problems ON solutions.ProblemID = problems.ID JOIN users ON solutions.UserID = users.ID";
    $solutionResult = $conn->query($solutionQuery);

    if ($solutionResult->num_rows > 0) {
        while ($row = $solutionResult->fetch_assoc()) {
            $solutionId = $row['SolutionID'];
            $solutionText = $row['SolutionText'];
            $problemTitle = $row['ProblemTitle'];
            $problemDescription = $row['ProblemDescription'];
            $submittedBy = $row['FirstName'] . ' ' . $row['LastName'];
            ?>
            <div class="solution">
                <h3><?php echo $problemTitle; ?></h3>
                <p><?php echo $problemDescription; ?></p>
                <p>Submitted by: <?php echo $submittedBy; ?></p>
                <p class="solution-text">
                    <?php echo $solutionText; ?>
                </p>
                <form action="validateSolution.php" method="POST">
                    <input type="hidden" name="solution_id" value="<?php echo $solutionId; ?>">
                    <select name="is_correct" required>
                        <option value="">Select status</option>
                        <option value="corect">corect</option>
                        <option value="incorect">incorect</option>
                    </select>
                    <button type="submit">Validate</button>
                </form>
            </div>
            <?php
        }
    }
    ?>
</div>

        </div>
    <?php endif; ?>

    <ul class="problem-list">
        <?php
        // Verifică dacă există probleme în rezultatul interogării
        if ($problemResult->num_rows > 0) {
            // Iterează prin fiecare problemă și afișează informațiile
            while ($row = $problemResult->fetch_assoc()) {
                $problemId = $row['ID'];
                $title = $row['Title'];
                $description = $row['Description'];
                ?>
                <a href="selectedProblem.php?problem_id=<?php echo $problemId; ?>" class="box-link">
                    <div class="box">
                        <li class="list-item">
                            <?php echo $title; ?>
                        </li>
                        <p class="description">
                            <?php echo $description; ?>
                        </p>
                        <img src="assets/<?php echo $row['Difficulty']; ?>.png" class="problem-image">
                    </div>
                </a>
                <?php
            }
        }
        ?>
    </ul>
    <script src="scripts/work.js"></script>
    <script src="scripts/navbar.js"></script>
</body>

</html>