<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: main.php");
    exit;
}
 
// Include config file
require_once "connection.php";
 
// Define variables and initialize with empty values
$user_id = $password = "";
$user_id_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if user id is empty
    if(empty(trim($_POST["user_id"]))){
        $user_id_err = "Please enter your ID.";
    } else{
        $user_id = trim($_POST["user_id"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($user_id_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT `user_id`,`first_name`, `last_name`, `email`, `password`,`position` ,`image_name` FROM `user` WHERE `user_id`= ? AND approval=1";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_user_id);
            
            // Set parameters
            $param_user_id = $user_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result 
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $user_id, $first_name, $last_name, $email, $hashed_password,$position ,$image_name);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["user_id"] = $user_id;
                            $_SESSION["first_name"] = $first_name;
                            $_SESSION["last_name"] = $last_name;
                            $_SESSION["email"] = $email;
                            $_SESSION["image_name"] = $image_name;
                            $_SESSION["position"] = $position;
                            
                            // Redirect user to welcome page
                            header("location: main.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid input or Check for validation.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid input or Check for validation.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>LOGIN • Dumaguete CDMS</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="icon3.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="background: url(img/backgroundimage.png);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-3">
                <?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br>
            </div>
            <div class="col-6 fillup">
                <div class="form-container">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                        <h3>login now</h3>
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" name="user_id" class="form-control <?php echo (!empty($user_id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $user_id; ?>" placeholder="Enter ID">
                            <span class="invalid-feedback"><?php echo $user_id_err; ?></span>
                        </div>    
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="Enter Password">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        <div><?php echo "&nbsp&nbsp&nbsp" ?></div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="submit">
                        </div>
                        <p class="sl">Don't have an account? <a href="register.php">Register now</a>.</p>
                        <?php 
                        if(!empty($login_err)){
                            echo '<div class="alert alert-danger">' . $login_err . '</div>';
                        }        
                        ?>
                    </form>
                </div>
            </div>
            <div class="col-3">
                <?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br>
            </div>
        </div>
    </div>
</body>
</html>