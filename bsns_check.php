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
</head>
<body>
    <div id="navbar">
        <nav class="navbar navbar-expand-lg navbar-dark shadow-5-strong">
            <a class="navbar-brand" href="#" style="width: 150px;"><img src="images/logo 1.png" alt="logo"></a>
            
            <div class="collapse navbar-collapse" id="navbarNavDropdown" style="margin-left: 500px;">
              <ul class="navbar-nav">
                <li class="nav-item active" style="width: 200px;">
                  <a class="nav-link" href="#" style="color: black; font-weight: bold; width: fit-content;">Add Product<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item" style="width: 180px;">
                  <a class="nav-link" href="#" style="color: black; width: fit-content;">Check Serial</a>
                </li>
                <li class="nav-item" style="width: 180px;">
                  <a class="nav-link" href="#" style="color: black; width: fit-content;">Send Shipment</a>
                </li>
                <li class="nav-item" style="width: 200px;">
                    <a class="nav-link" href="#" style="color: black; width: fit-content;">My Account</a>
                  </li>
                  <li class="nav-item" style="width: 100px;">
                    <a class="nav-link" href="#" style="color: red; width: fit-content;">Logout</a>
                  </li>
              </ul>
            </div>
        </nav>
    </div>
    <div id="wrap">
        <p>Check Serial Number of added products for details.</p>
        <form action="" method="get" id="check_product">
            <input type="text" placeholder="Serial Number..." id="sno"><br>
            <input type="submit" name="Submit" id="sub" style="width: 250px;  background: #00ab66; color: white; text-align: center; cursor: pointer;">
        </form>
    </p>
    </div>

</body>
</html>