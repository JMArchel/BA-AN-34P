<?php require_once 'connection.php' ?>
<?php
     $query = "SELECT c.classification_name as classification,  COUNT(c.case_id) AS totalnumber FROM cases c INNER JOIN crime_category b ON c.category_name = b.category_name INNER JOIN crime_type i ON b.crime_type_id = i.crime_type_id and i.crime_type_name='NON-INDEX CRIME' WHERE DELETE_TIMESTAMP IS NULL GROUP BY c.classification_name ORDER BY COUNT(c.case_id) DESC LIMIT 10";
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
          ['Classification', 'Number of Cases'],
          <?php
                while($crimedata = mysqli_fetch_assoc($result))
            {
                    echo "['".$crimedata['classification']."',".$crimedata['totalnumber']."],";
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
              <h3>Top 10 Non-Index Crimes</h3>
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