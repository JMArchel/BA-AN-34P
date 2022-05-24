<?php 
include 'connection.php';
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


  $query = "SELECT classification_name, COUNT(crime_type_name) as totalnumber FROM cases WHERE crime_type_name = 'INDEX CRIME' GROUP BY classification_name ORDER BY COUNT(crime_type_name) DESC LIMIT 10;";
  $result = mysqli_query($conn,$query);

  $query1 = "SELECT classification_name, COUNT(crime_type_name) as totalnumber FROM cases WHERE crime_type_name = 'INDEX CRIME' GROUP BY classification_name ORDER BY COUNT(crime_type_name) DESC LIMIT 10;";
  $result1 = mysqli_query($conn,$query1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>VISUALIZATION • Dumaguete CDMS</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="img/icon3.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Dashboard</title>
</head>
<?php include("header.php"); ?>
<body>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card h-100">
                <div class="card-header text-center"><h4>Number of Crime Cases Each Day</h4></div>
                <div class="card-body">
                    <?php include("chart/linegraph1.php"); ?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="card-header text-center"><h4>Number of Crimes Each Month</h4></div>
                <div class="card-body">
                    <?php include("chart/linegraph2.php"); ?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="card-header text-center"><h4>Top 5 Places of Occurence</h4></div>
                <div class="card-body">
                    <?php include("chart/piechart1.php"); ?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="card-header text-center"><h4>Top 5 Barangay with the Most Cases</h4></div>
                <div class="card-body">
                    <?php include("chart/bargraph1.php"); ?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="card-header text-center"><h4>Top 5 Index Crimes</h4></div>
                <div class="card-body">
                    <?php include("chart/bargraph2.php"); ?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="card-header text-center"><h4>Top 5 Non-Index Crimes</h4></div>
                <div class="card-body">
                    <?php include("chart/bargraph3.php"); ?>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include("footer.php"); ?>
</html>
