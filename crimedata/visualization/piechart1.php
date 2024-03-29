<?php require_once 'connection.php' ?>
<?php 

  $query = "SELECT occurence_name, COUNT(case_id) as totalnumber FROM cases WHERE DELETE_TIMESTAMP IS NULL  GROUP BY occurence_name ORDER BY COUNT(case_id) DESC LIMIT 5";
  $result = mysqli_query($conn,$query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-widht, user-scalable=no, initial-scale=1.0, maxiumum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Pie Chart</title>
   
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Place of Occurence', 'Number of Cases'],
          
          <?php

              while($crimedata = mysqli_fetch_assoc($result))
              {
                echo "['".$crimedata['occurence_name']."',".$crimedata['totalnumber']."],";
              }
          ?>
        ]);

        var options = {
          title: ''
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
</head>
<body class="bg-dark">

    
      <div class="row">
        <div class="col-lg-6 m-auto">
          <div class="card">
            <div class="card-header">
              <h3> Top 5 Places of Occurence</h3>
            <div class="card-body">
              <div id="piechart" style="width: 700px; height: 500px">
            <div class="card-footer">
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
</body>
</html>

