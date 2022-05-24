<?php
// Check if the user is logged in, if not then redirect him to login page
require("connection.php");
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$user_id=$_SESSION['user_id'];
$first_name=ucfirst($_SESSION['first_name']);
$last_name=ucfirst($_SESSION['last_name']);
$email=$_SESSION['email'];
$position=$_SESSION['position'];
$image_name=$_SESSION['image_name'];

if (!empty($_GET['id'])) {
	$success=$_GET['id'];
}
?>
 
<!doctype html>
<html lang="en" 
<?php if (!empty($_GET['id'])) {?>
	style="padding-top:70px ;">
<?php }
?>
<head>
	<title>USER PROFILE</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="img/icon3.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<?php 
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$result = mysqli_query($conn, "SELECT `image_name` FROM `user` WHERE user_id='$user_id'");
while ($row=mysqli_fetch_array($result))
{
  $image_name=$row['image_name'];
}
mysqli_close($conn);
?>

<?php include("header.php"); ?>
<body>
	<div class="col-md-5" style="margin:auto;">
		<div class="card mb-3 border-light">
			<div class="card-body">
				<?php 
				if(!empty($success)){
					echo '<div class="alert alert-success text-center">' . 'Successful Change' . '</div>';
				}        
				if ($position == "Supervisor" OR $position == "Manager") { ?>
					<a class="btn btn-secondary px-4" style="float: left;" href="approval.php">Approval</a>
					<?php
					if ($position == "Manager"){?>
						<a class="btn btn-secondary px-4" style="float: right;" href="tracker.php">Tracker</a>
					<?php
					}?>
				<?php
				}
				?>
				
            	<div class="d-flex flex-column align-items-center text-center">
					<img src="uploads/<?php echo $image_name; ?>" alt="owner" class="rounded-circle p-1 bg-warning" width="150" height="150" style="margin: 10px; object-fit: cover;">
					<a class="btn btn-primary btn-sm" href="updateimage.php">Update Picture</a>
					<div class="mt-3">
						<h4><?php echo $first_name," ",$last_name; ?></h4>
						<p class="text-muted font-size-sm"><?php echo $position; ?></p>
						<a class="btn btn-primary px-4" href="update_profile.php">Update Info</a>
						<a class="btn btn-primary px-4" href="updatepass.php">Update Password</a>
						</div>
					</div><br>
          			<div class="row">
						<div class="col-sm-3">
							<h6 class="mb-0">User ID</h6>
						</div>
						<div class="col-sm-9 text-secondary">
							<?php echo $user_id; ?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-3">
							<h6 class="mb-0">First Name</h6>
						</div>
						<div class="col-sm-9 text-secondary">
							<?php echo $first_name; ?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-3">
							<h6 class="mb-0">Last Name</h6>
						</div>
						<div class="col-sm-9 text-secondary">
							<?php echo $last_name; ?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-3">
							<h6 class="mb-0">Email</h6>
						</div>
						<div class="col-sm-9 text-secondary">
							<?php echo $email; ?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-3">
							<h6 class="mb-0">Position</h6>
						</div>
						<div class="col-sm-9 text-secondary">
							<?php echo $position; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<?php include("footer.php"); ?>
</html>