<?php
require_once "db_Connect.php";
 
$username = $email = $password = $confirm_password = "";
$username_err = $password_err = $email_err = $confirm_password_err = "";
$interest = "nature;plant;rose;lily;dark";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["username"])){
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT max(id) from users";
        $result = mysqli_query($link, $sql);

            while($row = mysqli_fetch_row($result)){
                $nextID = $row[0];
            }
        $nextID++;
    
    
        // if($stmt = mysqli_prepare($link, $sql)){
        //     mysqli_stmt_bind_param($stmt, "s", $param_username);
            
        //     $param_username = trim($_POST["username"]);
            
        //     // if(mysqli_stmt_execute($stmt)){
        //     //     mysqli_stmt_store_result($stmt);
                
        //     //     if(mysqli_stmt_num_rows($stmt) == 1){
        //     //         $username_err = "This username is already taken.";
        //     //     } else{
        //     //         $username = trim($_POST["username"]);
        //     //     }
        //     // } else{
        //     //     echo "Oops! Something went wrong. Please try again later.";
        //     // }
        // }
        // mysqli_stmt_close($stmt);
        
        }

    if(empty($_POST["email"])){
        $email_err = "Please enter an email";
    }
    else{
        $email = trim($_POST["email"]);
    }

    if(empty(trim($_POST["username"]))){
        $username_err = "Enter the username ";     
    } 
    else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";}
    else{
        $password = trim($_POST["password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        $sql = "INSERT INTO users VALUES ($nextID,'$email','$username','$password','$interest')";

        if(mysqli_query($link,$sql)){
            sleep(3);
            header("location: login.php");
        }else{
            echo "wrong something wrong in insertion";
        }
        // if($stmt = mysqli_prepare($link, $sql)){
        //     mysqli_stmt_bind_param($stmt, "issss", $param_id, $param_username, $param_password, $param_interest);
        //     $param_username = $username;
        //     $param_password = password_hash($password, PASSWORD_DEFAULT);
        //     if(mysqli_stmt_execute($stmt)){
        //         header("location: login.php");
        //     } else{
        //         echo "Something went wrong. Please try again later.";
        //     }
        // }
        // mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .conatainer{ width: 350px; padding: 20px; }
        .card-header{
            background-color: #acabdd; 
            padding:20px;
            }
            .card-body{
            background-color:beige; 
            padding:20px;
            }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
            <h2>Sign Up</h2>
            </div>
            <div class="card-body">
                <p>Please fill this form to create an account.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" >
                        <span class="help-block"><?php echo $email_err; ?></span>
                </div>  
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control">
                        <span class="help-block"><?php echo $username_err; ?></span>
                    </div>    
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                        <span class="help-block"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <input type="reset" class="btn btn-default" value="Reset">
                    </div>
            </div>
            <div class="card-footer">
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </div>
            </form>
        </div>    
    </div>
</body>
</html>