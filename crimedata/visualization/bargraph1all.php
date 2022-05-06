<?php require_once 'connection.php' ?>
<?php
     $query = "SELECT barangay_name, COUNT(case_id) as totalnumber FROM cases WHERE DELETE_TIMESTAMP IS NULL GROUP BY barangay_name ORDER BY COUNT(case_id) DESC LIMIT 5";
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
    <title>Bar Graph</title>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Barangay', 'Number of Cases'],
          <?php
                while($crimedata = mysqli_fetch_assoc($result))
            {
                    echo "['".$crimedata['barangay_name']."',".$crimedata['totalnumber']."],";
            }
            
    ?>
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body class="bg-dark">

    
      <div class="row">
        <div class="col-lg-6 m-auto">
          <div class="card">
            <div class="card-header">
              <h3>Top 5 Barangays with the Most Cases</h3>
            <div class="card-body">
              <div id="barchart_material" style="width: 700px; height: 500px">
            <div class="card-footer">
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </body>
</html>