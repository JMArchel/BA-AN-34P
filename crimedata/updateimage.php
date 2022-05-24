<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
   header("location: login.php");
   exit;
 }
include "connection.php";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$image_names= $_SESSION["image_name"];
$first_names= $_SESSION["first_name"];
$last_names= $_SESSION["last_name"];
$user_id= $_SESSION["user_id"];
$msg = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
   
   if (empty($_FILES['choosefile']['type'])) {
      $msg = "No file inputted";
   }else{
      $types=$_FILES[ 'choosefile' ][ 'type' ];     
      $extensions=array( 'image/jpeg', 'image/png', 'image/gif', 'image/jpg' );
      if( in_array( $types, $extensions )){
      
         $type= $_FILES["choosefile"]["type"];
         $type= ltrim($type, 'image/');
         $filename = $user_id.".".$type;

         $tempname = $_FILES["choosefile"]["tmp_name"];  

         $folder = "uploads/".$filename;

         // query to insert the submitted data

         $sql="UPDATE `user` SET `update_timestamp`= CURRENT_TIMESTAMP ,`image_name`='$filename' WHERE `user_id`=$user_id";

         // function to execute above query

         mysqli_query($conn, $sql);       

         // Add the image to the "image" folder"

         if (move_uploaded_file($tempname, $folder)) {

            $sql1 = "SELECT `user_id`,`first_name`, `last_name`, `email`, `password`,`position` ,`image_name` FROM `user` WHERE `user_id`= ?";
            echo $sql;
            
            if($stmt = mysqli_prepare($conn, $sql1)){
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

                        session_start();
                                             
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["image_name"] = $image_name;
                                    
                        // Redirect user to welcome page
                        header("location: profile.php?id=success");
                     }
                  }
               }
            }
         }
      }else {
         $msg = "Only jpeg, jpg, png, and gif are Accepted.";
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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
   <title>UPDATE PROFILE PICTURE</title>
</head>
<?php include("header.php"); ?>
<body>
	<div class="col-md-5" style="margin:auto;">
		<div class="card mb-3 border-light">
			<div class="card-body">
				<div class="form-container">
               <div class="row">
                  <div class="col-lg-4">
                     <img src="uploads/<?php echo $image_names; ?>" alt="Admin" class="rounded-circle p-1 bg-warning" width="200" height="200" style="margin: 10px; object-fit: cover;">
                     <h5 class="text-center"><?php echo $first_names," ", $last_names; ?></h5>
                  </div>
                  <div class="col-lg-8" style="margin: auto;">
                  <h3>Update Profile Picture</h3><br>
                     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data"> 
                        <input class="form-control" type="file" name="choosefile"><br>
                        <input class="btn btn-primary" type="submit" value="Change Profile" name="submit"><br>
                     </form>
                  </div>
               </div>
               <center><div class="col-lg-7">
                  <?php 
                     if(!empty($msg)){
                         echo '<div class="alert alert-danger">' . $msg . '</div>';
                     }        
                  ?>
               </div></center>
				</div>
			</div>
		</div>
    </div>
</body>
<?php include("footer.php"); ?>
</html>