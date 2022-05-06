<?php require_once 'connection.php' ?>
<?php
     $query = "SELECT day, COUNT(case_id) as totalnumber FROM cases WHERE DELETE_TIMESTAMP IS NULL GROUP BY day ORDER BY COUNT(case_id) ASC";
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
          title: '',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body class="bg-dark">

    
      <div class="row">
        <div class="col-lg-6 m-auto">
          <div class="card">
            <div class="card-header">
              <h3>Number of Crime Cases Each Day</h3>
            <div class="card-body">
              <div id="curve_chart" style="width: 700px; height: 500px">
            <div class="card-footer">
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </body>
</html>
