<?php
include 'connection.php';
session_start();
$email= $_SESSION['email'];
if($email == false){
    header('Location: login');
}elseif(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: main");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
    $check_code = "SELECT * FROM `user` WHERE code = $otp_code";
    $code_res = mysqli_query($conn, $check_code);
    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $info = "Please create a new password that you don't use on any other site.";
        $_SESSION['info'] = $info;
        header('location: new-password');
        exit();
    }else{
        $code_err = "You've entered an incorrect code!";
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
                <h3>Code Verification</h3>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                    <div class="form-group">
                        <center>
                            <?php if(!empty($_SESSION['info'])){ ?>
                            <div class="alert alert-info"> <?php echo $_SESSION['info']; ?></div>
                            <?php } ?>
                        </center>
                        <input type="number" name="otp" min="1" placeholder="Enter Code" class="form-control <?php echo (!empty($code_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $otp_code; ?>" placeholder="Enter Code">
                        <span class="invalid-feedback"><?php echo $code_err; ?></span>
                    </div>
                    <div><?php echo "&nbsp&nbsp&nbsp" ?></div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary" value="submit">
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