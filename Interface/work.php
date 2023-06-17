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
    ?>
    <header>
        <div class="navbar">
            <div class="logo"><h2>PrInfo</h2></div>
            <ul class="links">
                <li><a href="home.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="myclasses.php">Classes</a></li>
                <li><a href="work.php">Work</a></li>
            </ul>
            <a href="connection.php" class="login-btn" style="--clr:#E9DCD1"><?php echo $loginText; ?></a>
            <div class="toggle-btn">
                <i class="fa fa-bars"></i>
            </div>
        </div>
        <div class="dropdown-menu">
            <li><a href="home.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="myclasses.php">Classes</a></li>
            <li><a href="work.php">Work</a></li>
            <li><a href="connection.php" class="dm-login-btn" style="--clr:#39424A"><?php echo $loginText; ?></a></li>
        </div>  
    </header>
    
    <button class="new-post" onclick="openPopup()">New Post</button>
    <div class="container">
        <div class="popup" id="pp">
            <button class="close-button" aria-label="Close alert" type="button" data-close onclick="closePopup()">
                <span aria-hidden="true">&times;</span>
            </button>
            <h2 class="popup-title">Create New Post</h2>
            <form>
                <label for="title" type="required">Title: </label>
                <input type="text" id="title" name="title"><br>

                <label for="tags" type="required">Tags: </label>
                <input type="text" id="tags" name="tags"><br>

                <label for="description">Description: </label>
                <textarea id="description" name="description"></textarea><br>

                <div class="buttons-container">
                    <button class="import-button" type="button">Import</button>
                    <button onclick="closePopup()" class="create-button" type="button">Create</button>
                </div>
            </form>
        </div>
    </div>

    <ul class="problem-list">
        <a href="selectedProblem.php" class="box-link">
            <div class="box">
                <li class="list-item">Problem 1</li>
                <p class="description">Description of problem 1 goes here</p>
                <img src="assets/Hard.jpg" class="problem-image">
            </div>
        </a>
        <a href="selectedProblem.php" class="box-link">
            <div class="box">
                <li class="list-item">Problem 2</li>
                <p class="description">Description of problem 2 goes here</p>
                <img src="assets/Easy.png" class="problem-image">
            </div>
        </a>
        <a href="selectedProblem.php" class="box-link">
            <div class="box">
                <li class="list-item">Problem 3</li>
                <p class="description">Description of problem 3 goes here</p>
                <img src="assets/Medium.png" class="problem-image">
            </div>
        </a>
        <a href="selectedProblem.php" class="box-link">
            <div class="box">
                <li class="list-item">Problem 4</li>
                <p class="description">Description of problem 4 goes here</p>
                <img src="assets/Medium.png" class="problem-image">
            </div>
        </a>
        <a href="selectedProblem.php" class="box-link">
            <div class="box">
                <li class="list-item">Problem 5</li>
                <p class="description">Description of problem 5 goes here</p>
                <img src="assets/Easy.png" class="problem-image">
            </div>
        </a>
        <a href="selectedProblem.php" class="box-link">
            <div class="box">
                <li class="list-item">Problem 6</li>
                <p class="description">Description of problem 6 goes here</p>
                <img src="assets/Hard.jpg" class="problem-image">
            </div>
        </a>
        <a href="selectedProblem.php" class="box-link">
            <div class="box">
                <li class="list-item">Problem 7</li>
                <p class="description">Description of problem 7 goes here</p>
                <img src="assets/Easy.png" class="problem-image">
            </div>
        </a>
        <a href="selectedProblem.php" class="box-link">
            <div class="box">
                <li class="list-item">Problem 8</li>
                <p class="description">Description of problem 8 goes here</p>
                <img src="assets/Hard.jpg" class="problem-image">
            </div>
        </a>
        <a href="selectedProblem.php" class="box-link">
            <div class="box">
                <li class="list-item">Problem 9</li>
                <p class="description">Description of problem 9 goes here</p>
                <img src="assets/Easy.png" class="problem-image">
            </div>
        </a>
        <a href="selectedProblem.php" class="box-link">
            <div class="box">
                <li class="list-item">Problem 10</li>
                <p class="description">Description of problem 10 goes here</p>
                <img src="assets/Medium.png" class="problem-image">
            </div>
        </a>
    </ul>
    <script src="scripts/work.js"></script>
    <script src="scripts/navbar.js"></script>
</body>
</html>