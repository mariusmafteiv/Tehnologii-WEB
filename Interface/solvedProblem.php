<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solved Problem</title>
    <link rel="stylesheet" href="stylesheets/solvedProblem.css">
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

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        $loginText = "Logout";
    } else {
        $loginText = "Login";
    }

    $example = false;

    // Check if problem_id is set in the URL
    if (isset($_GET['problem_id'])) {
        $problemId = $_GET['problem_id'];

        // Select the problem from the database
        $queryProblem = 'SELECT * FROM problems WHERE ID = ?';
        $stmtProblem = $conn->prepare($queryProblem);
        $stmtProblem->bind_param('i', $problemId);

        if ($stmtProblem->execute()) {
            $resultProblem = $stmtProblem->get_result();
            $problem = $resultProblem->fetch_assoc();

            // Get the author's ID
            $authorId = $problem['CreatedBy'];

            // Select the author from the database
            $queryAuthor = 'SELECT * FROM users WHERE ID = ?';
            $stmtAuthor = $conn->prepare($queryAuthor);
            $stmtAuthor->bind_param('i', $authorId);

            if ($stmtAuthor->execute()) {
                $resultAuthor = $stmtAuthor->get_result();
                $author = $resultAuthor->fetch_assoc();
            } else {
                echo "Database error: " . $stmtAuthor->error;
                exit;
            }

            // Select the problem's tags from the database
            $queryTags = 'SELECT tags.Name FROM tags JOIN problemtags ON tags.ID = problemtags.TagID 
                WHERE problemtags.ProblemID = ?';
            $stmtTags = $conn->prepare($queryTags);
            $stmtTags->bind_param('i', $problemId);

            $tags = [];
            if ($stmtTags->execute()) {
                $resultTags = $stmtTags->get_result();
                while ($row = $resultTags->fetch_assoc()) {
                    $tags[] = $row['Name'];
                }
            } else {
                echo "Database error: " . $stmtTags->error;
                exit;
            }

            $querySol = 'SELECT * FROM solutions WHERE ProblemID = ? AND UserID = ? ORDER BY SubmittedAt DESC LIMIT 1';
            $stmtSol = $conn->prepare($querySol);
            $stmtSol->bind_param('ii', $problemId, $_SESSION['user']['ID']);

            if ($stmtSol->execute()) {
                $resultSol = $stmtSol->get_result();
                if ($resultSol->num_rows > 0) {
                    $sol = $resultSol->fetch_assoc();
                }
            } else {
                echo "Database error: " . $stmtSol->error;
                exit;
            }
        } else {
            echo "Database error: " . $stmtProblem->error;
            exit;
        }
    } else {
        // If problem_id is not set in the URL, display an example problem
        $example = true;
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
    <div class="big-box">
        <div class="title">
            <?php echo $example ? "Exemplu" : $problem['Title']; ?>
        </div>
        <div class="tags">#
            <?php echo $example ? "Exemplu" : implode(', ', $tags); ?>
        </div>
        <div class="small-box">
            <?php echo $example ? "Exemplu" : $problem['Description']; ?>
        </div>
        <div class="small-box">
            <?php echo $example ? "Exemplu" : $sol['SolutionText']; ?>
        </div>
        <div class="author-box">
            <img src="assets/avatar.png" class="author-image">
            <div class="author-name">
                <?php echo $example ? "Exemplu" : $author['FirstName']; ?>
            </div>
            <div class="author-surname">
                <?php echo $example ? "Exemplu" : $author['LastName']; ?>
            </div>
        </div>
    </div>
    <script src="scripts/navbar.js"></script>
</body>

</html>