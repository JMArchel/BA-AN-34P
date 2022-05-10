<?php
session_start();
include "connection.php";
$user_id =htmlspecialchars($_SESSION["user_id"]);
$image_name =htmlspecialchars($_SESSION["image_name"]);

$res=mysqli_query ($conn,"SELECT * FROM `user` WHERE `user_id`= $user_id");
while ($row=mysqli_fetch_array($res)) 
{
  $first_name=$row['first_name'];
  $last_name=$row['last_name'];
  $email=$row['email'];
  $position=$row['position'];
  $image_name=$row['image_name'];
  $password=$row['password'];
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

	// Check if first name is empty
    if(empty(trim($_POST["update_first_name"]))){
        $update_first_name_err = "Please enter first_name.";
    } else{
        $update_first_name = trim($_POST["update_first_name"]);
    }

	//check if last name is empty
	if(empty(trim($_POST["update_last_name"]))){
        $update_last_name_err = "Please enter your last_name.";
    } else{
        $update_last_name = trim($_POST["update_last_name"]);
    }

	// check if email is empty
	if(empty(trim($_POST["update_email"]))){
        $update_email_err = "Please enter your email.";
    } else{
        $update_email = trim($_POST["update_email"]);
    }

	// Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password for confirmation.";
    } else{
        $password = trim($_POST["password"]);
    }

	if(empty($update_first_name_err) && empty($update_last_name_err) && empty($update_email_err) && empty($password_err)){
        
		$sql = "SELECT `user_id`, `password` FROM `user` WHERE `user_id`= ?";

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
                    mysqli_stmt_bind_result($stmt, $user_id, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){

							$check_user_id = $_POST["check_user_id"]
							$sql1 = "UPDATE `user` SET `email`= $update_email ,`first_name`= $update_first_name ,`last_name`= update_last_name, WHERE `user_id`= $check_user_id ";
							echo "WELL DONE!";

							
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
}
?>
<!DOCTYPE html>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <link rel="icon" type="image/png" href="img/icon3.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <title>update profile</title>
</head>
<?php include("header.php"); ?>
<body>
	<div class="col-md-5" style="margin:auto;">
		<div class="card mb-3 border-light">
			<div class="card-body">
				<div class="form-container">
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">ID</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="text" class="form-control" value="<?php echo $user_id; ?>" disabled>
								<input type="text" class="form-control" name="check_user_id" value="<?php echo $user_id; ?>" hidden>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">First Name</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="text" class="form-control" name="update_first_name" value="<?php echo $first_name; ?>">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Last Name</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="text" class="form-control" name="update_last_name" value="<?php echo $last_name; ?>">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Email</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="text" class="form-control" name="update_email" value="<?php echo $email; ?>">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Position</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="text" class="form-control" value="<?php echo $position; ?>" disabled>
							</div>
						</div><br><br>
						<div class="row mb-3">
							<p>To confirm your changes, please input your password</p>
							<div class="col-sm-3">
								<h6 class="mb-0">Password</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<input type="password" class="form-control" name="password" placeholder="Enter Password">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3"></div>
							<div class="col-sm-9 text-secondary">
								<input type="submit" class="btn btn-primary" value="Update">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
    </div>
</body>
<?php include("footer.php"); ?>
</html>