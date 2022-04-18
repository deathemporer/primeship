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
    require __DIR__.'/vendor/autoload.php';
    use Web3\Web3;
    use Web3\Contract;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrimeShip</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/bsns_prod_added.css">
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
	 <div id="wrap_bus">
    <p style="height: fit-content; margin-top: 10px; text-align: center; color: #00ab66; font-weight: bold;"> Product Added Successfully!</p>
        <form method="post" id="login" style="margin-top: 0;">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="<?php echo $_GET['name']?>" readonly><br>
            <label for="type" id="lab_type">Brand:</label>
            <input type="text" name="type" id="type" placeholder="<?php echo $_GET['bname']?>" readonly><br>
        </form>
        <a style="position: absolute; color: white; text-decoration: none; margin-top: 230px;" href="bsns_home.php" id="done"><button style=" width: 250px;  margin-left: 100px; margin-top: 20px; height: 40px; border: none; background: #00ab66; color: white; text-align: center; cursor: pointer; border-radius: 5px;">Done</button></a>
    </div>
</body>
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../Code/node_modules/web3/dist/web3.min.js"></script>
<script src="../Code/app.js"></script>
<script>
	$(document).ready(function(event) {
	    web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:7545'));

	      // Set the Contract
	    var contract = new web3.eth.Contract(contractAbi, contractAddress);
		var prod_id = "<?php echo $_GET['pid'];?>";
		var bname = "<?php echo $_GET['bname'];?>";
		var pname = "<?php echo $_GET['name'];?>";
		web3.eth.getAccounts().then(async function(accounts) {
			console.log("1");
          var receipt = await contract.methods.newItem(pname, prod_id, bname).send({ from: accounts[0], gas: 1000000 })
          .then(receipt => {
          	console.log("2");
             //var msg="<h5 style='color: #53D769'><b>Item Added Successfully</b></h5><p>Product ID: "+receipt.events.Added.returnValues[0]+"</p>";
              //qr.value = receipt.events.Added.returnValues[0];
              //$bottom="<p style='color: #FECB2E'> You may print the QR Code if required </p>"
             //document.getElementById('result').innerHTML = "Product Added";
          });
          //console.log(receipt);
        });

	});
	    
</script>