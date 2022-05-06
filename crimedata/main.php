<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title>HOME • Dumaguete CDMS</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="img/icon3.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<?php include("header.php"); ?>
<body>
	<div class="container">
		<center><div class="col-lg-9 title">
			<h3 style="padding-top: 100px;">WELCOME TO</h3><b><h1>DUMAGUETE CRIME DATA</b><br><b>MANAGEMENT SYSTEM</h1></b><br>
			<p>The goal of the <strong>Crime Database Management System</strong> is to automate the existing manual system and convert it into a web-based system with data visualizations,
			thereby meeting the need for convenient tracking for <strong>all users from the Office of the Vice Mayor</strong>. The information gathered from the
			police station is secure and can be kept on hand for an extended period of time. This project makes use of the PHP, HTML, CSS, Bootstrap, and Python programming languages.</b></p><br><br>
			<h5> Hello,<b> <?php echo ucwords(htmlspecialchars($_SESSION["first_name"])); ?> <?php echo ucwords(htmlspecialchars($_SESSION["last_name"])); ?></b>
			<a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
		</div></center>
	</div>
</body>
<?php include("footer.php"); ?>
</html>