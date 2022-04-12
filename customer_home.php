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
    <style>
      #file, #l_txn, #sub, #but,#lblFile{
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

      #selectedFile{
        display: none;
      }

      #lblFile{
        width: 130px;  
        background: rgba(117, 225, 255, 0.8); 
        color: black; 
        text-align: center; 
        cursor: pointer;
        padding-left: 0;
        margin-top: 0;
        height: fit-content;
      }

      #l_txn{
          margin-top: 10px;
          display: none;
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

      #prodid{
        margin: 10px; 
        width: 300px; 
        height: 40px; 
        padding-left: 10px; 
        border: none; 
        background: rgba(203, 243, 254, 0.82); 
        color: black; 
        border-radius: 10px; 
        box-shadow: 0px 3px 15px rgba(0,0,0,0.24); 
        font-size: large; 
      }


    </style>
    <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>
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
        <p>Scan a product to check the geuineness. Either scan or upload the QR Code.</p><br>

        <form id="form2" autocomplete="off" style="height: fit-content" method="post">
        <div class="formitem" style="height: fit-content">
            <input type="text" placeholder="Upload QR Code" class="forminput" id="prodid" onkeypress="isInputNumber(event)" required style="">
            <label class=qrcode-text-btn id="lblFile">Upload a File
                <input type=file accept="image/*" id="selectedFile" capture=environment onchange="openQRCamera(this);" tabindex=-1 style="height: fit-content" style="width: 100px">
            </label><br>
            <input type="submit" name="Submit" id="sub" style="width: 250px;  background: #00ab66; color: white; text-align: center; cursor: pointer;">
            
        </div>
    </form>
    
        <br><p>--OR--</p><br>
        <a href="cust_scan.php"><button id="but">Scan from Camera</button></a>
    </div>
</body>
</html>

<script>
document.getElementById("prodid").onchange = function() {myFunction()};

function myFunction() {
  var x = document.getElementById("prodid");
  alert(x.value);
}
</script>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $txn_id=$_POST['prodid'];
        header("location:cust_result.php?txn_id=$txn_id");
    }
?>

 <script>
        function openQRCamera(node) {
        var reader = new FileReader();
        reader.onload = function() {
        node.value = "";
        qrcode.callback = function(res) {
        if(res instanceof Error) {
            alert("No QR code found. Please make sure the QR code is within the camera's frame and try again.");
        } else {
            node.parentNode.previousElementSibling.value = res;
            document.getElementById('searchButton').click();
          }
          };
          qrcode.decode(reader.result);
        };
        reader.readAsDataURL(node.files[0]);
    }
</script>