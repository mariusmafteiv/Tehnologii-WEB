<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
    <link rel="stylesheet" href="stylesheets/navbar.css">
    <!-- followin link is for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
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
                <li><a href="#">Profile</a></li>
                <li><a href="#">Classes</a></li>
                <li><a href="#">Work</a></li>
            </ul>
            <a href="#" class="login-btn" style="--clr:#E9DCD1"><?php echo $loginText; ?></a>
            <div class="toggle-btn">
                <i class="fa fa-bars"></i>
            </div>
        </div>
        <div class="dropdown-menu">
            <li><a href="#">Home</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Classes</a></li>
            <li><a href="#">Work</a></li>
            <li><a href="#" class="dm-login-btn" style="--clr:#39424A"><?php echo $loginText; ?></a></li>
        </div>  
    </header>
    <section id="login-reg-form">

    </section>

    <script src="scripts/navbar.js"></script>
    <!-- Following scripts are for icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>