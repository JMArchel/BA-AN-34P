<?php require_once 'connection.php' ?>
<?php 

  $query = "SELECT classification_name, COUNT(crime_type_name) as totalnumber FROM cases WHERE crime_type_name = 'INDEX CRIME' GROUP BY classification_name ORDER BY COUNT(crime_type_name) DESC LIMIT 10;";
  $result = mysqli_query($conn,$query);

  $query1 = "SELECT classification_name, COUNT(crime_type_name) as totalnumber FROM cases WHERE crime_type_name = 'INDEX CRIME' GROUP BY classification_name ORDER BY COUNT(crime_type_name) DESC LIMIT 10;";
  $result1 = mysqli_query($conn,$query1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-widht, user-scalable=no, initial-scale=1.0, maxiumum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Dashboard</title>
</head>
<body>
  <div class="row">
      <div class="col-lg-6">
          <?php include("bargraph1.php"); ?>
      </div>
      <div class="col-lg-6">
          <?php include("piechart1.php"); ?>
      </div>
      <div class="col-lg-6">
          <?php include("linegraph1.php"); ?>
      </div>
      <div class="col-lg-6">
          <?php include("linegraph2.php"); ?>
      </div>
      <div class="col-lg-6">
          <?php include("bargraph2.php"); ?>
      </div>
      <div class="col-lg-6">
          <?php include("bargraph3.php"); ?>
      </div>
</div>
</body>
</html>
