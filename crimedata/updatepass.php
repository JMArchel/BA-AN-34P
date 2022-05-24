<?php
include 'connection.php';

error_reporting(0);

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}
$image_names= $_SESSION["image_name"];
$first_names= $_SESSION["first_name"];
$last_names= $_SESSION["last_name"];
$user_id= $_SESSION["user_id"];

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

  // Validate password
  if(empty(trim($_POST["old_password"]))){
    $oldpassword_err = "Please enter a password.";     
  } elseif(strlen(trim($_POST["old_password"])) < 8){
    $oldpassword_err = "Password must have atleast 8 characters.";
  } else{
    $oldpassword = trim($_POST["old_password"]);
  }

  if(empty(trim($_POST["new_password"]))){
    $password_err = "Please enter a password.";     
  } elseif(strlen(trim($_POST["new_password"])) < 8){
    $password_err = "Password must have atleast 8 characters.";
  } else{
    $password = trim($_POST["new_password"]);
  }

  // Validate confirm password
  if(empty(trim($_POST["confirm_new_password"]))){
    $confirm_password_err = "Please confirm password.";     
  } else{
    $confirm_password = trim($_POST["confirm_new_password"]);
    if(empty($password_err) && ($password != $confirm_password)){
        $confirm_password_err = "Password did not match.";
    }
  }

  if(empty($oldpassword_err) && empty($password_err) && empty($confirm_password_err)){
    $sql = "SELECT `password` FROM `user` WHERE `user_id`= ? ";
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
            mysqli_stmt_bind_result($stmt, $hashed_password);
              if(mysqli_stmt_fetch($stmt)){
                if(password_verify($oldpassword, $hashed_password)){
                  // Password is correct, so start a new session

                  $sql1 = "UPDATE `user` SET `password`= ? ,`update_timestamp`= CURRENT_TIMESTAMP WHERE `user_id`= $user_id ";

                  if($stmt = mysqli_prepare($conn, $sql1)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_password);

                    $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                                  
                      $sql2 = "SELECT `user_id`,`first_name`, `last_name`, `email`, `password`,`position` ,`image_name` FROM `user` WHERE `user_id`= ?";
          
                      if($stmt = mysqli_prepare($conn, $sql2)){
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
                                                  
                              // Redirect user to welcome page
                              header("location: profile.php?id=success");
                            }
                          } else{
                            echo "Oops! Something went wrong. Please try again later.";
                          }
                
                        }
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
                  $login_err = "Invalid Old Password.";
                }
              }
              // Close statement
              mysqli_stmt_close($stmt);
          }
        }
      }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <link rel="icon" type="image/png" href="img/icon3.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <title>UPDATE PASSWORD</title>
</head>
<?php include("header.php"); ?>

<?php include("footer.php"); ?>
</html>
<body>
  <div class="col-md-5" style="margin:auto;">
		<div class="card mb-3 border-light">
			<div class="card-body">
				<div class="form-container">
          <h3>Update Password</h3><br>
          <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
              <div class="row mb-3">
                <div class="col-sm-4">
                  <h6 class="mb-0">New Password</h6>
                </div>
                <div class="col-sm-8 text-secondary">
                  <input class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" type="password" placeholder="Enter New Password" name="new_password" value="<?php echo $password; ?>"/>
                  <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-4">
                  <h6 class="mb-0">Confirm New Password</h6>
                </div>
                <div class="col-sm-8 text-secondary">
                  <input class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" type="password" placeholder="Enter Confirm New Password" name="confirm_new_password" value="<?php echo $confirm_password; ?>"/>
                  <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div>
              </div><br><br>
              <div class="row mb-3">
                <p>To confirm your changes, please input your old password</p>
                <div class="col-sm-4">
                  <h6 class="mb-0">Old Password</h6>
                </div>
                <div class="col-sm-8 text-secondary">
                  <input class="form-control <?php echo (!empty($oldpassword_err)) ? 'is-invalid' : ''; ?>" type="password" placeholder="Old Password" name="old_password" value="<?php echo $oldpassword; ?>"/>
                  <span class="invalid-feedback"><?php echo $oldpassword_err; ?></span>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-2">
                  <input class="btn btn-primary" type="submit" value="Change Password" name="submit">
                </div>
              </div>
              <br>
              <div class="row">
						    <?php 
                  if(!empty($login_err)){
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                  }        
                ?>
						  </div>
            </form>
          </div>
				</div>
			</div>
		</div>
  </div>
</body>

</html>