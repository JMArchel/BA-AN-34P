<?php require_once 'connection.php' ?>
<?php
     $query = "SELECT day, COUNT(case_id) as totalnumber FROM cases GROUP BY day ORDER BY COUNT(case_id) ASC";
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
    <title>Line Graph</title>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Day', 'Number of Cases'],
        <?php
        
           
            while($crimedata = mysqli_fetch_assoc($result))
            {
                echo "['".$crimedata['day']."',".$crimedata['totalnumber']."],";
            }
                
        ?>
        
        ]);

        var options = {
          colors: ['#a7031e'],
          title: '',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart1'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <h3><center> Number of Crime Cases Each Day </center></h3>
    <div id="curve_chart1" style="width: 600px; height: 300px">
    </div>
  </body>
</html>