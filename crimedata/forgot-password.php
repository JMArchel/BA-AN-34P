<?php
// Include config file
include "connection.php";

// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: main");
    exit;
}
 
// Define variables and initialize with empty values
$email = $email_err ="";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email=$_POST["email"];
    
    if(empty($_POST["email"])){
        $email_err = "Please enter your email.";
    }
    else{

        $sql = "SELECT `email` FROM `user` WHERE `email`= ? AND approval=1";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result 
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $code = rand(999999, 111111);
                    $insert_code = "UPDATE `user` SET code = $code WHERE email = '$email'";
                    $run_query =  mysqli_query($conn, $insert_code);
                    if($run_query){
                        $subject = "Password Reset Code";
                        $message = "Your password reset code is $code";
                        $header= "From:crimedata <codeverification@crimedata.mydatamarker.com>\r\n";
                        if( mail($email,$subject,$message,$header)){
                            session_start();
                            $info = "We've sent a passwrod reset otp to your email - $email";
                            $_SESSION['info'] = $info;
                            $_SESSION['email'] = $email;
                            header("location: reset-code");
                            exit();
                        }else{
                            $email_err = "Failed while sending code!";
                        }
                    }else{
                        $email_err = "Something went wrong!";
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $email_err = "Email doesn't exist";
                }
            } else{
                $email_err = "Oops! Something went wrong. Please try again later.";
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
    <title>Dumaguete CDMS</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/icon3.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&family=Vollkorn:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body class="body">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-4">
                <?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br>
            </div>
            <div class="col-4 fillup form-container">
                <h3>Forgot Password</h3>
                <p>Enter your Email Address.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                    <div class="form-group">
                        <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" placeholder="Enter email address">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </div>
                    <div><?php echo "&nbsp&nbsp&nbsp" ?></div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary" value="submit">
                    </div>
                    <p class="sl">Remebered your password? <a href="login">Sign In</a>.</p>
                </form>
            </div>
            <div class="col-4">
                <?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br>
            </div>
        </div>
    </div>
</body>
</html>