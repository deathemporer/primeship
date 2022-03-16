<?php 
    require 'functions/connect.php';
    //require 'functions/logout.php';
    session_start();
    // Check whether user is logged on or not
    if (!isset($_SESSION['user_id'])) {
        header("location:index.php");
    }
    $temp = $_SESSION['user_id'];
    session_destroy();
    session_start();
    $_SESSION['user_id'] = $temp;
    ob_start(); 
    // Establish Database Connection
    $conn = connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrimeShip</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/cust_home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div id="navbar">
        <nav class="navbar navbar-expand-lg navbar-dark shadow-5-strong">
            <a class="navbar-brand" href="customer_home.php" style="width: 200px;"><img src="images/logo 1.png" alt="logo"></a>
            
            <div class="collapse navbar-collapse" id="navbarNavDropdown" style="margin-left: 500px;">
              <ul class="navbar-nav">
                <li class="nav-item active" style="width: 200px;">
                  <a class="nav-link" href="customer_home.php" style="color: black; font-weight: bold; width: fit-content;">Scan Product<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item" style="width: 180px;">
                  <a class="nav-link" href="customer_about.php" style="color: black; width: fit-content;">About</a>
                </li>
                <li class="nav-item" style="width: 200px;">
                    <a class="nav-link" href="#" style="color: black; width: fit-content;">My Account</a>
                  </li>
                  <li class="nav-item" style="width: 100px;">
                    <form method=post action="logout.php">
                        <input type="submit" name="Logout" value="Logout"></input>
                    </form>
                    
                  </li>
              </ul>
            </div>
        </nav>
    </div>
    <div id="wrap">
        <p>Scan a product to check the geuineness. Enter either the serial number or scan/upload the QR Code.</p>

        <form action="" method="get" id="sno_form">
            <input type="text" placeholder="Serial Number..." id="sno"><br>
            <input type="submit" name="Submit" id="sub" style="width: 250px;  background: #00ab66; color: white; text-align: center; cursor: pointer;">
        </form>
        <br><p>--OR--</p><br>
        <button id="but">Scan from Camera</button>
        <button id="but">Upload QR Code</button>
    </div>
</body>
</html>
