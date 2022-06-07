<?php
include 'connection.php';

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: main");
    exit;
}

$first_name = $last_name = $email = $position = $password = $confirm_password ="";
$first_name_err = $last_name_err = $email_err = $position_err = $password_err = $confirm_password_err ="";
$check = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $select = mysqli_query($conn, "SELECT `first_name`,`last_name`,`email` FROM `user` WHERE `first_name`='$first_name' AND `last_name`='$last_name' AND `email`='$email';") or die('query failed');
    $name_check = mysqli_query($conn, "SELECT `first_name`,`last_name` FROM `user` WHERE `first_name`='$first_name' AND `last_name`='$last_name';") or die('query failed');
    $email_check= mysqli_query($conn, "SELECT `email` FROM `user` WHERE `email`='$email';") or die('query failed');
    
    if(empty($_POST["first_name"])){
        $first_name_err = "Please enter your firstname.";
    }elseif(mysqli_num_rows($select) > 0){
        $first_name_err = 'User already exist.';
    }elseif(mysqli_num_rows($name_check) > 0){
        $last_name_err = 'User already exist.';
    }else{
        $first_name = $_POST['first_name'];
    }

    if(empty($_POST["last_name"])){
        $last_name_err = "Please enter your lastname.";
    }elseif(mysqli_num_rows($select) > 0){
        $last_name_err = 'User already exist.';
    }elseif(mysqli_num_rows($name_check) > 0){
        $last_name_err = 'User already exist.';
    }else{
        $last_name = $_POST['last_name'];
    }

    if(empty($_POST["email"])){
        $email_err = "Please enter your email.";
    }elseif(mysqli_num_rows($select) > 0){
        $email_err = 'Email already exist.';
    }elseif(mysqli_num_rows($email_check) > 0){
        $email_err = 'Email already exist.';
    }else{
        $email = $_POST['email'];
    }

    if(empty($_POST["position"])){
        $position_err = "Enter position.";
    }else{
        $position = $_POST['position'];
    }

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

    // Check input errors before inserting in database
    if(empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($position_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO user (email, password, first_name, last_name, position) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_email, $param_password, $param_first_name, $param_last_name, $param_position);
            
            // Set parameters
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_position = $position;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: waiting");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>REGISTER • Dumaguete CDMS</title>
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
                <h3>Sign Up</h3>
                <p>Please fill this form to create an account.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Firstname</label>
                            <input type="text" name="first_name" class="form-control <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $first_name; ?>" placeholder="Enter firstname">
                            <span class="invalid-feedback"><?php echo $first_name_err; ?></span>
                        </div>    
                        <div class="form-group col-md-6">
                            <label>Lastname</label>
                            <input type="text" name="last_name" class="form-control <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $last_name; ?>" placeholder="Enter lastname">
                            <span class="invalid-feedback"><?php echo $last_name_err; ?></span>
                        </div>
                        <div class="form-group col-8">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" placeholder="Enter email address">
                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                        </div>
                        <div class="col-4">
                            <label>Position</label>
                            <select name="position" class="form-group form-control <?php echo (!empty($position_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $position; ?>">
                                <option selected disabled value=" ">Choose Position</option>
                                <option value="Member">Member</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Manager">Manager</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid state.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="Enter password">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>" placeholder="Confirm password">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                        </div>
                    </div>
                    <div><?php echo "&nbsp&nbsp&nbsp" ?></div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary" value="submit">
                    </div>
                    <p class="sl">Already have an account? <a href="login">Login here</a>.</p>
                </form>
            </div>
            <div class="col-4">
                <?php echo "&nbsp&nbsp&nbsp" ?><br><?php echo "&nbsp&nbsp&nbsp" ?><br>
            </div>
        </div>
    </div>
</body>
</html>