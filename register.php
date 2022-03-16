<?php 
    session_start();
    if (isset($_SESSION['type'])) {
        if($_SESSION['type']==1)
            header("location:customer_home.php");
        elseif($_SESSION['type']==2)
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
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <div id="wrap">
        <img src="images/logo 1.png" alt="Logo">
        <p>Welcome back. Input your Login details.</p>
        <form method="post" id="reg">
            <label for="name"></label><br>
            <input type="text" name="name" id="name" placeholder="Name" required><br>
            <label for="email"></label><br>
            <input type="email" name="email" id="email" placeholder="Email: abc@xyz.com" required><br>
            <label for="pass"></label><br>
            <input type="password" name="pass" id="pass" placeholder="Password" required><br>
            <label for="type"></label><br>
            <select name="type" id="type" required>
                <option value="0" default disabled>Select an option</option>
                <option value="1">Customer</option>
                <option value="2">Business</option>
            </select><br>
            <input type="submit" name="Submit" id="sub">
        </form>
    </div>
</body>
</html>

<?php
    $conn = connect();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $type= $_POST['type'];
        $password = $_POST['pass'];
        $email = $_POST['email'];
        // Check for Some Unique Constraints
        if($type==1){
            $query = mysqli_query($conn, "SELECT email FROM customer WHERE email = '$email'");
            if(mysqli_num_rows($query) > 0){
                $row = mysqli_fetch_assoc($query);
                if($email == $row['email']){
                    ?> <script>
                    alert("This Email already exists.");
                    </script> <?php
                }
            }
            // Insert Data
            $sql = "INSERT INTO customer(name, email, pass)
                    VALUES ('$name', '$email', '$password')";
            $query = mysqli_query($conn, $sql);
            if($query){
                $query = mysqli_query($conn, "SELECT cust_id FROM customer WHERE email = '$email'");
                $row = mysqli_fetch_assoc($query);
                $_SESSION['user_id'] = $row['cust_id'];
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['type'] = 1;
                header("location:customer_home.php");
            }
        }
        elseif($type==2){
            $query = mysqli_query($conn, "SELECT email FROM business WHERE email = '$email'");
            if(mysqli_num_rows($query) > 0){
                $row = mysqli_fetch_assoc($query);
                if($email == $row['email']){
                    ?> <script>
                    alert("This Email already exists.");
                    </script> <?php
                }
            }
            // Insert Data
            $sql = "INSERT INTO business(name, email, pass)
                    VALUES ('$name', '$email', '$password')";
            $query = mysqli_query($conn, $sql);
            if($query){
                $query = mysqli_query($conn, "SELECT bsns_id FROM business WHERE email = '$email'");
                $row = mysqli_fetch_assoc($query);
                $_SESSION['user_id'] = $row['cust_id'];
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['type'] = 1;
                header("location:bsns_home.php");
            }
        }
    }
?>