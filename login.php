<?php 
    require 'functions/functions.php';
    session_start();
    if (isset($_SESSION['user_id'])) {
        if(//cust)
            header("location:customer_home.php");
        else
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
    <title>PrimeShip | Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div id="left-side">
        <img src="images/logo 1.png" alt="Logo">
        <p>Welcome back. Input your Login details.</p>
        <form method="post" id="login" onsubmit="return formValidation();">
            <label for="email" id="lab_mail"></label><br>
            <input type="email" name="email" id="email" placeholder="Email: abc@xyz.com" required><br>
            <label for="pass"></label><br>
            <input type="password" name="pass" id="pass" placeholder="Password" required><br>
            <label for="type" id="lab_type"></label><br>
            <select name="type" id="type" required>
                <option value="0" selected>Select an option</option>
                <option value="1">Customer</option>
                <option value="2">Business</option>
            </select><br>
            <input type="submit" name="Submit" id="sub">
        </form>
    </div>
</body>
<script>
    function formValidation(){
        var mail = Document.getElementById("email").value;
        var type = Document.getElementById("type").value;

        return (validMail(mail) && validType(type));
    }

    function validMail(mail){
        var re="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?";
        if(!re.test(mail)){
            Document.getElementById("lab_mail").innerHTML = "Enter Valid Email";
            return false;
        }
        return true;
    }

    function validType(type){
        if(type!=1 && type!=2){
            Document.getElementById("lab_type").innerHTML = "Select Account Type";
            return false;
        }
        return true;
    }
</script>
</html>

<?php
    $conn = connect();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { // A form is posted
        // Login process
            $useremail = $_POST['useremail'];
            $userpass = $_POST['userpass'];
            $query = mysqli_query($conn, "SELECT * FROM users WHERE user_email = '$useremail' AND user_password = '$userpass'");
            if($query){
                if(mysqli_num_rows($query) == 1) {
                    $row = mysqli_fetch_assoc($query);
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_name'] = $row['user_firstname'] . " " . $row['user_lastname'];
                    setcookie("useremail", $useremail, time()+3600);
                    setcookie("userpass", $userpass, time()+3600);
                    header("location:home.php");
                }
                else {
                    ?> <script>
                        document.getElementsByClassName("required")[0].innerHTML = "Invalid Login Credentials.";
                        document.getElementsByClassName("required")[0].innerHTML = "Invalid Login Credentials.";
                    </script> <?php
                }
            } else{
                echo mysqli_error($conn);
            }
    }
?>