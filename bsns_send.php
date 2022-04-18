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
    <link rel="stylesheet" href="css/bsns_send.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                  <a class="nav-link" href="bsns_check.php" style="color: black; width: fit-content;">Check Serial</a>
                </li>
                <li class="nav-item" style="width: 180px;">
                  <a class="nav-link" href="bsns_send.php" style="color: black; width: fit-content; font-weight: bold; ">Send Shipment</a>
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
        <p>Send new shipment</p>
        <form action="" method="post" id="send">
            <input type="text" name="pid" placeholder="Product ID" id="pid" value = "<?php echo (isset($_GET['prod_id']))?$_GET['prod_id']:'';?>"><br>
            <input type="text" name="mrp" placeholder="MRP" id="mrp"><br>
            <input type="text" name="loc" placeholder="Manufacturing Location" id="loc"><br>
            <input type="date" name="date" placeholder="Date of Manufacturing" id="date"><br>
            <input type="text" name="sent" placeholder="Recieving Store" id="sent"><br>
            <input type="submit" name="Submit" id="sub" style="width: 250px;  background: #00ab66; color: white; text-align: center; cursor: pointer;">
        </form>
    </div>
</body>
<script>
  date.max = new Date().toISOString().split("T")[0];
</script>
</html>


<?php
    $conn = connect();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pid = $_POST['pid'];
        $brandId = $_SESSION['user_id'];
        // Check for Some Unique Constraints
            $query = mysqli_query($conn, "SELECT prod_id, bsns_id FROM product WHERE prod_id='$pid' and bsns_id='$brandId'");
            if(mysqli_num_rows($query) == 0){
              ?> 
                <script>
                  alert("This product does not exist.");
                </script> 
              <?php
            }
            // Insert Data
            else{
              $mrp = $_POST['mrp'];
              $loc = $_POST['loc'];
              $sent = $_POST['sent'];
              $date = $_POST['date'];
              ?>
              <script>
              	alert(document.getElementById("date").value);
              </script>
              <?php
              $txn_id = "T" . $pid . $brandId . substr($loc,0,2) . substr($sent,0,2) . substr($date,8,10) . substr($date,5,7);
              $sql = "INSERT INTO `transaction`(`txn_id`, `MRP`, `location`, `sent_to`, `time_of_man`, `bsns_id`, `prod_id`) VALUES ('$txn_id','$mrp','$loc','$sent','$date','$brandId','$pid')";
              $query = mysqli_query($conn, $sql);
              if($query){
                ?>
                  <script>
                    alert("Shipment added");
                  </script>
                <?php
              }
              header("location:bsns_success.php?prod_id=$pid&txn_date=$date&txn_id=$txn_id&sent_to=$sent&loc=$loc&mrp=$mrp");
            }
    }
?>
