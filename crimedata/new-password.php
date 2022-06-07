<?php
include 'connection.php';
session_start();

$email = $_SESSION['email'];
if($email == false){
    header('Location: login');
}elseif(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: main");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $_SESSION['info'] = "";
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) > 8){
        $password_err = "Password must have atleast 8 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    if(empty($password_err) && empty($confirm_password_err)){
        $code = 0;
        $email = $_SESSION['email']; //getting this email using session
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE `user` SET code = $code, password = '$encpass' WHERE email = '$email'";
        $run_query = mysqli_query($conn, $update_pass);
        if($run_query){
            $info = "Password Changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            header('Location: login');
        }else{
            $password_err = "Failed to change your password!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Dumaguete CDMS</title>
    <meta charset="UTF-8">
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
                <h3>New Password</h3>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                    <center>
                        <?php if(!empty($_SESSION['info'])){ ?>
                        <div class="alert alert-info"> <?php echo $_SESSION['info']; ?></div>
                        <?php } ?>
                    </center>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="Enter new password">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" placeholder="Confirm your password">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div><?php echo "&nbsp&nbsp&nbsp" ?></div>
                    <div class="form-group">
                        <input type="submit" class=" form-control btn btn-primary" value="submit">
                    </div>
                </form>
            </div>
            <div class="col-4">
                <?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br>
            </div>
        </div>
    </div>
</body>
</html>