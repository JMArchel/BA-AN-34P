<?php
	/* Database connection settings */
  include 'connection.php';
  session_start();

  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
  }
  $year="";

  $checkyear = $conn->query("SELECT year(date) from cases WHERE year(date)>=2018 group by year(date)");
  if(isset($_POST['Submit'])){
    $year =$_POST['Year']; 
  }
    //Chart 1
  $query1 = $conn->query("SELECT day, COUNT(case_id) as totalnumber FROM cases $year GROUP BY day ORDER BY dayofweek(date)");

  foreach($query1 as $data)
  {
    $day[] = $data['day'];
    $totalnumber[] = $data['totalnumber'];
  }

  //Chart2
  $query2 = $conn->query("SELECT MONTHNAME(date) as monthname, COUNT(case_id) as totalnumber2 FROM cases $year GROUP BY MONTH(date)");

  foreach($query2 as $data2)
  {
    $month[] = $data2['monthname'];
    $totalnumber2[] = $data2['totalnumber2'];
  }

  //Chart3
  $query3 = $conn->query("SELECT occurence_name, COUNT(case_id) as totalnumber3 FROM cases $year GROUP BY occurence_name ORDER BY COUNT(case_id) DESC LIMIT 5");

  foreach($query3 as $data3)
  {
    $occurence[] = $data3['occurence_name'];
    $totalnumber3[] = $data3['totalnumber3'];
  }

  //Chart4
  $query4 = $conn->query("SELECT barangay_name, COUNT(case_id) as totalnumber4 FROM cases $year GROUP BY barangay_name ORDER BY COUNT(case_id) DESC LIMIT 5");

  foreach($query4 as $data4)
  {
    $barangay[] = $data4['barangay_name'];
    $totalnumber4[] = $data4['totalnumber4'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>DASHBOARD • Dumaguete CDMS</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/icon3.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<?php include("header.php"); ?>
<body>
    <center><form method="POST">
       <label><h4>Select Year<h4></label>
       
        <select class="form-select mb-3" style="width:7em;" name="Year">
            <option value="" selected>All</option>
            <?php 
                while ($crimedata = mysqli_fetch_array($checkyear,MYSQLI_ASSOC)):; 
            ?>
                <option  value="WHERE year(date) like <?php echo $crimedata['year(date)'];?>">
                    <?php echo $crimedata['year(date)'];?>
                </option>
            <?php 
                endwhile; 
                // While loop must be terminated
            ?>
        </select>
        <input class="btn btn-success btn-md" style="width:5em;" type="Submit" value="Submit" name="Submit">
    </form></center>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card h-100" style="padding:0em;">
                    <div class="card-header text-center"><h4>Crime Cases Each Day</h4></div>
                    <div class="card-body" style="padding:0; margin:1em">
                        <canvas id="Linegraph1" style="padding:0.25em;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100" style="padding:0em;">
                    <div class="card-header text-center"><h4>Crime Cases Each Month</h4></div>
                    <div class="card-body" style="padding:0; margin:1em">
                        <canvas id="Linegraph2" style="padding:0.25em;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100" style="padding:0em;">
                    <div class="card-header text-center"><h4>Top 5 Places of Occurence</h4></div>
                    <div class="card-body">
                        <canvas id="Piechart" style="padding:0.25em;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100" style="padding:0em;">
                    <div class="card-header text-center"><h4>Top 5 Barangay with the Most Cases</h4></div>
                    <div class="card-body" style="padding:0; margin:1em">
                        <canvas id="Bargraph1" style="padding:0.25em;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100" style="padding:0em;">
                    <div class="card-header text-center"><h4>Top 5 Places of Occurence</h4></div>
                    <div class="card-body">
                        <canvas id="Bargraph2" style="padding:0.25em;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100" style="padding:0em;">
                    <div class="card-header text-center"><h4>Top 5 Barangay with the Most Cases</h4></div>
                    <div class="card-body" style="padding:0; margin:1em">
                        <canvas id="Bargraph3" style="padding:0.25em;"></canvas>
                    </div>
                </div>
            </div>
        </div><br><br><br>
    </div>
</body>
<body>

        <script>
            const daylabels = <?php echo json_encode($day)?>;
            const data11 = {
                labels: daylabels,
                datasets: [{
                    label: "Number of Crime Cases",
                    data: <?php echo json_encode($totalnumber)?>,
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                    'rgb(255, 99, 132)'
                    ],
                    borderWidth: 1
                }]
                };

            const config11 = {
            type: 'line',
            data: data11,
            options: {
            title: {
                display: true,
            scales: {
                y: {
                }
                }
            }
            },
        };

        const Linegraph1 = new Chart(
                document.getElementById('Linegraph1'),
                config11
            );
        </script>

        <script>
            const monthlabels = <?php echo json_encode($month)?>;
            const data12 = {
                labels: monthlabels,
                datasets: [{
                    label: "Number of Crime Cases",
                    data: <?php echo json_encode($totalnumber2)?>,
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                    'rgb(255, 99, 132)'
                    ],
                    borderWidth: 1
                }]
                };

            const config12 = {
            type: 'line',
            data: data12,
            options: {
            title: {
                display: true,
            scales: {
                y: {
                }
                }
            }
            },
        };

        const Linegraph2 = new Chart(
                document.getElementById('Linegraph2'),
                config12
            );
        </script>

        <script>
            const labels = <?php echo json_encode($occurence)?>;
            const data21 = {
                labels: labels,
                datasets: [{
                    data: <?php echo json_encode($totalnumber3)?>,
                    backgroundColor: [
                    'rgba(255, 80, 80, 0.6)',
                    'rgba(229, 100, 100, 1)',
                    'rgba(192, 55, 55, 1)',
                    'rgba(118, 45, 45, 1)',
                    'rgba(65, 0, 0, 1)'
                    ],
                    borderColor: [
                    'rgba(238, 227, 227, 1)',
                    ],
                    borderWidth: 1
                }]
                };

            const config21 = {
            type: 'pie',
            data: data21,
            maintainAspectRatio: false,
            options: {
            legend: {
                display: true,
                position: 'bottom',
            },
            title: {
                display: true,
            scales: {
                y: {
                }
                }
            }
            },
        };

        const Piechart = new Chart(
                document.getElementById('Piechart'),
                config21
            );
        </script>

        <script>
            const barangaylabels = <?php echo json_encode($barangay)?>;
            const data1 = {
                labels: barangaylabels,
                datasets: [{
                    label: "Number of Crime Cases",
                    data: <?php echo json_encode($totalnumber4)?>,
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 99, 132)',
                    'rgb(255, 99, 132)',
                    'rgb(255, 99, 132)',
                    'rgb(255, 99, 132)'
                    ],
                    borderWidth: 1
                }]
                };

            const config1 = {
            type: 'bar',
            data: data1,
            options: {
            title: {
                display: true,
            scales: {
                y: {
                }
                }
            }
            },
        };

        const Bargraph1 = new Chart(
                document.getElementById('Bargraph1'),
                config1
            );
        </script>

<br><br><br>
</body>
<?php include("footer.php"); ?>
</html>