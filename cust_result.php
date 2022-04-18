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
    <title>PrimeShip | Account</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/cust_result.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div id="navbar">
        <nav class="navbar navbar-expand-lg navbar-dark shadow-5-strong">
            <a class="navbar-brand" href="customer_home.php" style="width: 200px;"><img src="images/logo 1.png" alt="logo"></a>
            
            <div class="collapse navbar-collapse" id="navbarNavDropdown" style="margin-left: 500px;">
              <ul class="navbar-nav">
                <li class="nav-item" style="width: 200px;">
                  <a class="nav-link" href="customer_home.php" style="font-weight: bold; color: black; width: fit-content;">Scan Product<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item" style="width: 180px;">
                  <a class="nav-link" href="customer_about.php" style="color: black; width: fit-content;">About</a>
                </li>
                <li class="nav-item active" style="width: 200px;">
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
        <table style="margin-top: 10px;">
            <form method="post" id="prod_form">
                
            </form>
        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../Code/node_modules/web3/dist/web3.min.js"></script>
    <script src="../Code/app.js"></script>
    <script>
        $(document).ready(function(event) {
            var txn_id = "<?php echo $_GET['txn_id'];?>";
            web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:7545'));
            
            var contract = new web3.eth.Contract(contractAbi, contractAddress);

        
            //event.preventDefault(); // to prevent page reload when form is submitted
            console.log(txn_id)
            //$("#database").text(greeting);

            contract.methods.getItems(txn_id).call(function(err, result) {
              console.log(err, result);
              //document.getElementById('prod_form').innerHTML = result;
              document.getElementById('wrap').innerHTML = result;
            });

        });

    </script>

</body>
</html>