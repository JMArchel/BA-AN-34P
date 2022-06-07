<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
   header("location: login.php");
   exit;
 }
include "connection.php";

$image_name= $_SESSION["image_name"];
$first_name= $_SESSION["first_name"];
$last_name= $_SESSION["last_name"];
$user_id= $_SESSION["user_id"];
$msg = "";

if (!empty($_GET['id'])) {
	$success=$_GET['id'];
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
   
   if (empty($_FILES['choosefile']['type'])) {
      $msg = "Please insert an image.";
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
                        header("location: profile?id=success");
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
   <title>UPDATE PROFILE PICTURE</title>
   <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/icon3.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&family=Vollkorn:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
</head>
<?php include("header.php"); ?>
<body>
   <div class="col-lg-9" style="margin:auto;">
		<div class="row row-cols-1 row-cols-md-3 g-4">
			<div class="col-4">
         <div class="shadow card h-100 text-center">
					<div class="card-header card-title" style="background-color: #ED3030; padding-bottom:0em;"><h5>User Profile</h5></div>
						<?php if ($position == "Manager") { ?>
							<div style="padding:1em 1em 0em 1em">
								<div class="btn-group col-12">
                           <a class="btn btn-secondary" href="approval">
										Approval 
										<?Php if ($position=="Manager" OR $position=="Supervisor")
										{ ?>
											<?php $res=mysqli_query($conn,"SELECT COUNT(user_id) AS numbers FROM `user` WHERE `approval`=0");
											$row=mysqli_fetch_array($res);
											$rows= $row["numbers"];
												if ($rows >= 1) {
													?> <span class="badge rounded-pill bg-danger"> <?php echo $row["numbers"]; ?> </span> <?php
											}
										} ?>
									</a>
									<a class="btn btn-white" disabled></a>
									<a class="btn btn-secondary" href="tracker">Tracker</a>
								</div>
							</div>
						<?php }elseif ($position == "Supervisor"){ ?>
							<div style="padding:1em 1em 0em 1em">
								<div class="btn-group col-12">
									<a class="btn btn-secondary" href="approval">Approval</a>
									<a class="btn btn-white" disabled></a>
									<a class="btn btn-white" disabled></a>
								</div>
							</div>
						<?php } ?>
					<div class="align-items-center"><img src="uploads/<?php echo $image_name; ?>" alt="owner" class="rounded-circle p-1 center" width="180em" height="180em" style="margin: 2em; object-fit: cover;"></div>
					<div class="card-body">
						<h4 class="card-title" style="margin-bottom: -.3em;">
						<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
  						<path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
						<path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z"/>
						</svg>
						<?php echo $first_name," ",$last_name; ?></h4>
						<p class="text-muted font-size-sm" style="margin-bottom: 1em;"><?php echo $position; ?></p>
						<div class="btn-group col-12">
							<a class="btn btn-light" href="profile">Info</a>
							<a class="btn btn-primary active" href="update-image">Picture</a>
							<a class="btn btn-light" href="update-password">Password</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-8">
				<div class="shadow card h-100">
            <div class="card-header card-title" style="background-color: #ED3030; padding-bottom:0em;"><h5>Profile Picture</h5></div>
               <div class="card-body">
                  <p>jpeg, jpg, gif and png are accepted.</p>
                  <div class="form-container">
                     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data"> 
                        <input class="form-control" type="file" name="choosefile"><br>
                        <input class="btn btn-primary" type="submit" value="Change Profile" name="submit"><br>
                     </form>
                  </div>
               </div>
               <center>
                  <div class="col-lg-11">
                     <?php 
                        if(!empty($msg)){
                           echo '<div class="alert alert-danger">' . $msg . '</div>';
                        }        
                     ?>
                  </div>
               </center>
            </div>
			</div>
		</div>
   <?php
	if(!empty($success)){
                  echo '<div class="alert alert-success text-center" style="margin-top:1em;">' ?> <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
               </svg> <?php echo 'Successful Change' . '</div>';
				} ?>   
	</div>
</body>
<?php include("footer.php"); ?>
</html>