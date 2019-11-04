<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "db_Connect.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){


        $query = "SELECT name, id from users WHERE name='$username' AND password='$password'";
        $myResult = mysqli_query($link,$query);
        var_dump($myResult);
        if(mysqli_num_rows($myResult)){
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $myResult[1];
            $_SESSION["username"] = $username;
        }
        else{
            echo "oops something isnt right";
        }
        
        //$sql = "SELECT id, username, password FROM users WHERE username = ?";
        
    //     if($stmt = mysqli_prepare($link, $sql)){
    //         mysqli_stmt_bind_param($stmt, "s", $param_username);
            
    //         $param_username = $username;
            
    //         if(mysqli_stmt_execute($stmt)){
    //             mysqli_stmt_store_result($stmt);
                
    //             if(mysqli_stmt_num_rows($stmt) == 1){                    
    //                 mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
    //                 if(mysqli_stmt_fetch($stmt)){
    //                     if(password_verify($password, $hashed_password)){
    //                         session_start();
                            
    //                         $_SESSION["loggedin"] = true;
    //                         $_SESSION["id"] = $id;
    //                         $_SESSION["username"] = $username;                            
                            
    //                         header("location: welcome.php");
    //                     } else{
    //                         $password_err = "The password you entered was not valid.";
    //                     }
    //                 }
    //             } else{
    //                 $username_err = "No account found with that username.";
    //             }
    //         } else{
    //             echo "Oops! Something went wrong. Please try again later.";
    //         }
    //     }
    //     mysqli_stmt_close($stmt);
    // }
    mysqli_close($link);
}
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        /* .wrapper{ width: 350px; padding: 20px; } */
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <p>Please fill in your credentials to login.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>    
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
                <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
            </form>
    </div>    
</body>
</html>