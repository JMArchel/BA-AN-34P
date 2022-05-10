<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require("connection.php");
session_start();
$user_id=$_SESSION['user_id'];
$first_name=ucfirst($_SESSION['first_name']);
$last_name=ucfirst($_SESSION['last_name']);
$email=$_SESSION['email'];
$position=$_SESSION['position'];
$image_name=$_SESSION['image_name'];
?>
 
<!doctype html>
<html lang="en">
<head>
	<title>USER PROFILE</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="img/icon3.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<?php 
$conn = mysqli_connect('localhost','root','','crimedata') or die('connection failed');
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
				<a class="btn btn-secondary px-4" style="margin-right:100px" href="approval.php">Approval</a>
            	<div class="d-flex flex-column align-items-center text-center">
					<img src="uploads/<?php echo $image_name; ?>" alt="Admin" class="rounded-circle p-1 bg-warning" width="150" style="margin: 10px;">
					<a class="btn btn-primary btn-sm" href="updateimage.php">Update Picture</a>
					<div class="mt-3">
						<h4><?php echo $first_name," ",$last_name; ?></h4>
						<p class="text-muted font-size-sm"><?php echo $position; ?></p>
						<a class="btn btn-primary px-4" href="update_profile.php">Update Info</a>
						<a class="btn btn-primary px-4" href="updatepass.php">Update Password</a>
						</div>
					</div>
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