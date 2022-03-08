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
            <input type="text" name="name" id="name" placeholder="Name"><br>
            <label for="email"></label><br>
            <input type="email" name="email" id="email" placeholder="Email: abc@xyz.com"><br>
            <label for="pass"></label><br>
            <input type="password" name="pass" id="pass" placeholder="Password"><br>
            <label for="type"></label><br>
            <select name="type" id="type">
                <option value="def" selected>Select an option</option>
                <option value="cust">Customer</option>
                <option value="bsns">Business</option>
            </select><br>
            <input type="submit" name="Submit" id="sub">
        </form>
    </div>
</body>
</html>