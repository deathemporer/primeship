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
    <link rel="stylesheet" href="css/bsns_check.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style type="text/css">
            *{
                margin: 0;
                padding: 0;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                width: 100%;
                height: 100%;
            }

            body{
                background: rgb(219,243,250);
                background: linear-gradient(128deg, rgba(219,243,250,1) 0%, rgba(146,223,243,1) 100%);
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }


            #navbar{
                height: 60px;
            }

            .nav-link{
                color: black;
            }

            nav img{
                width: 200px;
                height: 32px;
            }

            #wrap{
                background: rgba(255, 255, 255, 0.71);
                width: 1100px;
                height: 420px;
                margin-left: 220px;
                margin-top: 100px;
                position: absolute;
                border-radius: 10px;
                box-shadow: 0 10px 20px rgba(0,0,0,0.24);
                padding: 30px;
                padding-top: 0px;
                text-align: center;
            }

            #wrap p{
                font-size: 20px;
                height: fit-content;
                position: relative;
                color: rgba(0,0,0,0.7);
                margin-top: 20px;
            }

            #sno, #sub{
                margin: 10px;
                width: 450px;
                height: 40px;
                padding-left: 10px;
                border: none;
                background: rgba(203, 243, 254, 0.82);
                color: black;
                border-radius: 10px;
                box-shadow: 0px 3px 15px rgba(0,0,0,0.24);
                font-size: large;
            }

            #check_product{
                height: fit-content;
                margin-top: 0px;
                padding-top: 30px;
            }

            #prod {
                margin-top: 10px;
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
                border-radius: 10px;
            }
              
            #prod td, #prod th {
                border: 1px solid #ddd;
                padding: 8px;
            }
              
            #t1{
                width: 20%;
            }

            #t2,#t3{
                width: 40%;
            }

            #prod tr:nth-child(even){background-color: rgba(219,243,250,0);}
              
            #prod tr:hover {background-color: rgba(146,223,243,1);}
              
            #prod th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: rgba(203, 243, 254, 0.82);
                color: black;
            }
    </style>
</head>
<body>
    <div id="navbar">
        <nav class="navbar navbar-expand-lg navbar-dark shadow-5-strong">
            <a class="navbar-brand" href="bsns_home.php" style="width: 150px;"><img src="images/logo 1.png" alt="logo"></a>
            
            <div class="collapse navbar-collapse" id="navbarNavDropdown" style="margin-left: 500px;">
              <ul class="navbar-nav">
                <li class="nav-item active" style="width: 200px;">
                  <a class="nav-link" href="bsns_home.php" style="color: black; width: fit-content;">Add Product<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item" style="width: 180px;">
                  <a class="nav-link" href="bsns_check.php" style="color: black; font-weight: bold; width: fit-content;">Check Serial</a>
                </li>
                <li class="nav-item" style="width: 180px;">
                  <a class="nav-link" href="bsns_send.php" style="color: black; width: fit-content;">Send Shipment</a>
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
        <form action="" method="get" id="check_product">
            <input type="text" placeholder="Product Name..." id="sno" name="sno">
            <input type="submit" name="Submit" id="sub" style="width: 250px;  background: #00ab66; color: white; text-align: center; cursor: pointer;">
            <table id="prod" name="prod">
              <th id="t1">Product ID</th>
              <th id="t2">Name</th>
              <th id="t3">Brand</th>
              <?php 
                      $prod_bsns = $_SESSION['user_id'];
                      $sql2 = "SELECT name from business where bsns_id=\"".$prod_bsns."\";";
                      $sql = "SELECT * from product where bsns_id=\"".$prod_bsns."\";";
                      $conn = connect();
                      $query = mysqli_query($conn, $sql);
                      $query2 = mysqli_query($conn, $sql2);
                      $row = mysqli_fetch_assoc($query);
                      $row2 = mysqli_fetch_assoc($query2);
                      $bsns_name = $row2['name'];
                      if(mysqli_num_rows($query) > 0){
                        while($row = mysqli_fetch_assoc($query)){
                            echo '<tr>';
                            echo "<td id='t1'>".$row['prod_id']."</td>";
                            echo "<td id='t2'>".$row['name']."</td>";
                            echo "<td id='t3'>".$bsns_name."</td>";
                        }
                      }
                      else{
                        ?>
                        <script>
                          document.getElementById("prod").style.display = "none";
                        </script>
                        <?php
                          echo "<p>No products added yet.</p>";
                      }
              ?>
            </table>
        </form>
    </div>

</body>
</html>