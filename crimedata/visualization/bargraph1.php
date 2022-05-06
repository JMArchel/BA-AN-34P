<?php   require_once 'connection.php';
      $query1 = "SELECT year(date) from cases group by year(date)";
      $result1 = mysqli_query($conn,$query1);     
?>
<html> 
<body>
<center>
    <form method="POST">
        <label><h4>Select Year<h4></label>
        
        <select name="Year">
            <?php 
                while ($crimedata = mysqli_fetch_array(
                        $result1,MYSQLI_ASSOC)):; 
            ?>
                <option  value="<?php echo $crimedata['year(date)'];""
                    
                ?>">
                    <?php echo $crimedata['year(date)'];
                        
                    ?>
                </option>
            <?php 
                endwhile; 
                // While loop must be terminated
            ?>
        </select>
        
        
        <br><br>
        <input type="Submit" value="Submit" name="Submit">
        
    </form>
    <br>
</center>
</body>
</html>

<?php 
  if(isset($_POST['Submit'])){
     $year =$_POST['Year'];  
     $query = "SELECT barangay_name, COUNT(case_id) as totalnumber FROM cases WHERE year(date) like '%{$year}%' AND DELETE_TIMESTAMP IS NULL GROUP BY barangay_name ORDER BY COUNT(case_id) DESC LIMIT 5";
     $result = mysqli_query($conn,$query);
    }
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
  <body class>
    
      <div class="row">
        <div class="col-lg-6 m-auto">
          <div class="card">
            <div class="card-header">
              <h3>Top 5 Barangays with the Most Cases Each Year</h3>
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