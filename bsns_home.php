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
    <link rel="stylesheet" href="css/bsns_home.css">
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
                  <li class="nav-item" style="width: 100px;">
                    <form method=post action="logout.php">
                      <input type="submit" name="Logout" value="Logout" style="border: none; background-color: transparent; color: red; cursor: pointer;"></input>
                    </form>
                  </li>
              </ul>
            </div>
        </nav>
    </div>
    <div id="wrap">
        <p>Add new product to the database.</p>
        <form action="" method="post" id="add_product">
            <input type="text" name="pname" placeholder="Product Name" id="pname"><br>
            <input type="submit" name="Submit" id="sub" style="width: 250px;  background: #00ab66; color: white; text-align: center; cursor: pointer;">
        </form>
    </p>
    </div>
</body>
</html>

<?php
    $conn = connect();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['pname'];
        $brandId = $_SESSION['user_id'];
        $email = $_SESSION['email'];
        // Check for Some Unique Constraints
            $query = mysqli_query($conn, "SELECT name FROM product WHERE name='$name' and bsns_id='$brandId'");
            if(mysqli_num_rows($query) > 0){
                $row = mysqli_fetch_assoc($query);
                if($name == $row['name']){
                    ?> <script>
                    alert("This product already exists.");
                    </script> <?php
                }
            }
            // Insert Data
            $sql = "INSERT INTO product(name, bsns_id)
                    VALUES ('$name', '$brandId')";
            $query = mysqli_query($conn, $sql);
            if(!$query){
            	?><script>
                alert("Product added");
                </script><?php
                header("location:bsns_home.php");
            }
    }
?>

<