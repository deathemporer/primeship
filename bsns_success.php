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
    <link rel="stylesheet" href="css/bsns_success.css">
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
        <p style="color: green;">Successfully created a Shipment!</p>
        <p style="font-size: 15px;">Save the QR Code by right-clicking and save image as...</p>
        <canvas id="qr"></canvas><br><br>
        <a style="color: white; text-decoration: none;" href="bsns_home.php"><button style="width: 250px;  background: #00ab66; color: white; text-align: center; cursor: pointer; border-radius: 5px;">Done</button></a>
    </div>
</body>
</html>
<script src="node_modules\qrious\dist\qrious.js"></script>
    <script>
      (function() {
        var txn_id = <?php echo(json_encode($_GET['txn_id'])); ?>;
        var qr = new QRious({
          element: document.getElementById('qr'),
          value: txn_id
        });
      })();
    </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../Code/node_modules/web3/dist/web3.min.js"></script>
<script src="../Code/app.js"></script>
<script>
  $(document).ready(function(event) {
    console.log("3");
      web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:7545'));

        // Set the Contract
    var contract = new web3.eth.Contract(contractAbi, contractAddress);
    var prod_id = "<?php echo $_GET['prod_id'];?>";
    var txn_id = "<?php echo $_GET['txn_id'];?>";
    var txn_date = "<?php echo $_GET['txn_date'];?>";
    var sent_to = "<?php echo $_GET['sent_to'];?>";
    var loc = "<?php echo $_GET['loc'];?>";
    var mrp = "<?php echo $_GET['mrp'];?>";
    web3.eth.getAccounts().then(async function(accounts) {
      console.log("1");
          var receipt = await contract.methods.addDetails(prod_id, txn_id, txn_date, sent_to, loc, mrp).send({ from: accounts[0], gas: 1000000 })
          .then(receipt => {
            console.log("2");
             //var msg="<h5 style='color: #53D769'><b>Item Added Successfully</b></h5><p>Product ID: "+receipt.events.Added.returnValues[0]+"</p>";
              //qr.value = receipt.events.Added.returnValues[0];
              //$bottom="<p style='color: #FECB2E'> You may print the QR Code if required </p>"
             //document.getElementById('result').innerHTML = "Product Added";
          });
          console.log(receipt);
        });

  });
      
</script>


