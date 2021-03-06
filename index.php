<?php 
    session_start();
    if (isset($_SESSION['type'])) {
        if($_SESSION['type']==1)
            header("location:customer_home.php");
        elseif($_SESSION['type']==2)
            header("location:bsns_home.php");
    }
    session_destroy();
    session_start();
    ob_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrimeShip</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div id="body-wrapper">
        <div id="left-side">
            <img src="images/logo 1.png" alt="Logo">
            <p>Your products, protected by the power of BlockChain.</p>
            <form method="post">
            <input type="submit" id="login_btn" value="Returning user, Login" name="login"></input>
            <input type="submit" id="reg_btn" value="New User, Register" name="register"></input>
            </form>
        </div>
        <div id="right-side">
            <img id="bg" src="images/bg1.png" alt="image">
        </div>
    </div>
</body>
</html>

<?php
    if(isset($_POST['login'])) {
        header("location:login.php");
    }
    if(isset($_POST['register'])) {
        header("location:register.php");
    }
?>