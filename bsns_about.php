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
    <link rel="stylesheet" href="css/cust_about.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div id="navbar">
        <nav class="navbar navbar-expand-lg navbar-dark shadow-5-strong">
            <a class="navbar-brand" href="bsns_home.php" style="width: 150px;"><img src="images/logo 1.png" alt="logo"></a>
            
            <div class="collapse navbar-collapse" id="navbarNavDropdown" style="margin-left: 500px;">
              <ul class="navbar-nav">
                <li class="nav-item active" style="width: 200px;">
                  <a class="nav-link" href="bsns_home.php" style="color: black; font-weight: bold; width: fit-content;">Add Product<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item" style="width: 180px;">
                  <a class="nav-link" href="bsns_check.php" style="color: black; width: fit-content;">Check Serial</a>
                </li>
                <li class="nav-item" style="width: 180px;">
                  <a class="nav-link" href="#" style="color: black; width: fit-content;">Send Shipment</a>
                </li>
                <li class="nav-item" style="width: 200px;">
                    <a class="nav-link" href="bsns_account.php" style="color: black; width: fit-content;">My Account</a>
                  </li>
                  <<li class="nav-item" style="width: 100px;">
                    <form method=post action="logout.php">
                      <input type="submit" name="Logout" value="Logout" style="border: none; background-color: transparent; color: red; cursor: pointer;"></input>
                    </form>
                  </li>
              </ul>
            </div>
        </nav>
    </div>
    <div id="wrap">
        <p><p>Lorem ipsum dolor sit amet. Et galisum galisum non sapiente tempore eum autem dolores. Id blanditiis aliquid et nihil ullam rem perferendis harum sit esse fugiat  enim nostrum ut eligendi enim qui placeat voluptates. Sed enim iste et saepe eligendi et exercitationem molestiae et magnam quod ut quaerat officiis. </p><p>Ad aperiam iusto qui nulla aspernatur est eius ipsam. Aut repellat provident qui adipisci magnam aut totam quas vel autem Quis et perferendis maiores aut nulla molestias eum consequatur facilis. </p><p>Est debitis eius aut consectetur Quis rem quos facere non quas officia ut deleniti ullam qui temporibus nobis ut temporibus enim. Est inventore sequi quo omnis porro sed dolor saepe vel quam amet et placeat provident quo inventore maxime! </p>
    </p>
    </div>

</body>
</html>