<?php
require_once "db_Connect.php";
$sql = "select * from photos";
$result = mysqli_query($link, $sql);
$src = "";
while ($row = mysqli_fetch_assoc($result)) {
    $src = $row['src'];
}
// $handle = fopen($src, "r");
// $fileInput = fread($handle, filesize($src));
// $writer = fopen("image.png", "w");
// fputs($writer, $fileInput);
?>
<!DOCTYPE html>
<html lang="en">
    <head><title>Suck</title></head>
    <body>
        <img src="<?php echo $src; ?>" alt="nigger">
    </body>
</html>