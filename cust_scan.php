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
    <link rel="stylesheet" href="css/cust_scan.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <style>
      #file, #l_txn, #sub, #but{
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

      #l_txn{
          margin-top: 10px;
      }

      #txn{
          display:none;
      }

      #but{
          width: 300px;
          cursor: pointer;
      }

      #sno_form{
          margin-top: 50px;
          height: fit-content;
      }

    </style>
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
                    <a class="nav-link" href="customer_account.php" style="color: black; width: fit-content;">My Account</a>
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
        <p>Scan your QR Code using the camera.</p>
        <div id="camera">
            <video id="preview" width="100%" style="border-radius: 10px;"></video>
        </div>
        <div id="qr">
            <form method="post" id="formqr">
                <input type="text" id="text" name="text" readonly="" placeholder="Bring QR Code within frame">
                <input type="submit" name="submit" value="Submit" id="sub" style="background-color: #00ab66; color: white;">
            </form>
        </div>
    </div>
</body>
</html>

<script>
    let scanner = new Instascan.Scanner({video: document.getElementById('preview')});
    Instascan.Camera.getCameras().then(function(cameras){
        if(cameras.length >0){
            scanner.start(cameras[0]);
        }
        else{
            alert('No camera');
        }
    }).catch(function(e){
        console.error(e);
    });
    scanner.addListener('scan', function(c){
        document.getElementById('preview').style.border = "7px solid green";
        document.getElementById('text').value = c;
    });
</script>


<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $txn_id=$_POST['text'];
        header("location:cust_result.php?txn_id=$txn_id");
    }
?>