<?php require_once 'connection.php' ?>
<?php 

  $query = "SELECT classification_name, COUNT(crime_type_name) as totalnumber FROM cases WHERE crime_type_name = 'NON-INDEX CRIME' GROUP BY classification_name ORDER BY COUNT(crime_type_name) DESC LIMIT 10;";
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
    <title>Bar Chart</title>
   
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Non Index Crimes', 'Total'],
          
          <?php

              while($crimedata = mysqli_fetch_assoc($result))
              {
                echo "['".$crimedata['classification_name']."',".$crimedata['totalnumber']."],";
              }
          ?>
        ]);

        var options = {
            colors: ['#a7031e'],
            chart: {
            title: '',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material1'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
</head>
      <div>
              <h3><center> Top 10 Non-Index Crimes </center></h3>
              <div id="barchart_material1" style="width: 600px; height: 300px">
              </div>
      </div>
</html>

