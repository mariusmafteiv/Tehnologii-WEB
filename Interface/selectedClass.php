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
    <div class="container">
        <div class="title-box">
            <div class="title">Class Name</div>
            <div class="subtitle">Created by: Name</div>
            <div class="subtitle">Members: member1, member2</div>
        </div>
        <div class="problems-box">
            <div class="problem">
                <a href="selectedProblem.php" class="box-link">
                    <div class="problem-title">Problem Title 1</div>
                    <div class="problem-tags">#tag1 #tag2 #tag3</div>
                    <img src="assets/Easy.png" class="problem-img">
                </a>
            </div>
            <div class="problem">
                <a href="selectedProblem.php" class="box-link">
                    <div class="problem-title">Problem Title 2</div>
                    <div class="problem-tags">#tag1 #tag2 #tag3</div>
                    <img src="assets/Hard.jpg" class="problem-img">
                </a>
            </div>
            <div class="problem">
                <a href="selectedProblem.php" class="box-link">
                    <div class="problem-title">Problem Title 3</div>
                    <div class="problem-tags">#tag1 #tag2 #tag3</div>
                    <img src="assets/Medium.png" class="problem-img">
                </a>
            </div>
            <div class="problem">
                <a href="selectedProblem.php" class="box-link">
                    <div class="problem-title">Problem Title 4</div>
                    <div class="problem-tags">#tag1 #tag2 #tag3</div>
                    <img src="assets/Hard.jpg" class="problem-img">
                </a>
            </div>
            <div class="problem">
                <a href="selectedProblem.php" class="box-link">
                    <div class="problem-title">Problem Title 5</div>
                    <div class="problem-tags">#tag1 #tag2 #tag3</div>
                    <img src="assets/Easy.png" class="problem-img">
                </a>
            </div>
            <div class="problem">
                <a href="selectedProblem.php" class="box-link">
                    <div class="problem-title">Problem Title 6</div>
                    <div class="problem-tags">#tag1 #tag2 #tag3</div>
                    <img src="assets/Easy.png" class="problem-img">
                </a>
            </div>
        </div>
    </div>
    <script src="scripts/navbar.js"></script>
</body>

</html>