<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Images</title>
    <link rel="stylesheet" href="bootstrap-4.3.1-dist\css\bootstrap.min.css">
 
</head>
<body>
    <div class="container" >
        <form enctype="multipart/form-data" method="post">
        <div class="form-group">
            <label for="Input">Image</label>
            <input type="file" name="fileToUpload" class="form-control" id="ImageFile" aria-describedby="ImageFileHelp" placeholder="Choose the file to pbe uploaded">
            <small id="ImageFileHelp" class="form-text text-muted">Choose only PNG or JPG < 2MB size</small>
        </div>
        <button type="submit" class="btn btn-primary" >Submit</button>
        </form>
    </div>

<?php
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $filePath = $target_dir.$_FILES["fileToUpload"]["name"];
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
$cardTitle = "F";
$cardBody="dolr irmaet";

$card = "
<div class='card' style='width:400px'>
<img class='card-img-top' src='$filePath' alt='Card image'>
<div class='card-body'>
  <h4 class='card-title'>$cardTitle</h4>
  <p class='card-text'>$cardBody</p>
</div>
</div>";
echo $card;
?>

</body>
</html>