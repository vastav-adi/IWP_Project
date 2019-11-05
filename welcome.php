<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "db_Connect.php";

//pid uid title body src tags lk lkdk

$sql = "SELECT * FROM photos ";
$photoResult = mysqli_query($link,$sql);
$card = "";

while($row = mysqli_fetch_assoc($photoResult)){
    $src = $row['src'];
    $title = $row['title'];
    $body = $row['body'];
    $card .= "
<div class='card' style='width:400px'>
<img class='card-img-top' width='400px' src='$src' alt='Card image'>
<div class='card-body'>
  <h4 class='card-title'>$title</h4>
  <p class='card-text'>$body</p>
</div>
</div>";
}


$cardTitle = "F";
$cardBody="dolor irmhet";

// $card = "
// <div class='card' style='width:400px'>
// <img class='card-img-top' src='$photoResultArray[4]' alt='Card image'>
// <div class='card-body'>
//   <h4 class='card-title'>$photoResultArray[2]</h4>
//   <p class='card-text'>$photoResultArray[3]</p>
// </div>
// </div>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="bootstrap-4.3.1-dist\css\bootstrap.min.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="jumbotron" style="font:14px">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to your gallery.</h1>
    </div>
    <p>
        <a href="upload.php"class="btn btn-primary">Upload a photo</a>
        <a href="reset-password.php" class="btn btn-dark">Reset Your Password</a>
        <a href="logout.php" class="btn btn-secondary">Sign Out of Your Account</a>
    
    </p>

    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <?php echo $card; ?>
            </div>
        </div>
    </div>
    
    <!-- <?php //echo $card; ?> -->
</body>
</html>

