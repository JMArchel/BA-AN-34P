<?php
	/* Database connection settings */
  include 'connection.php';
  session_start();

  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="https://cdn.anychart.com/releases/8.7.1/js/anychart-core.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.7.1/js/anychart-heatmap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
      html, body, #container {
        width: 100%;
        height: 50em;
        margin: 0;
        padding: -20em 0 0 0;
      }
      </style>
</head>
<?php include("header.php"); ?>
<body>
<button class="btn btn-primary col-1" type="button" style="margin-left: 3em;" onclick="location.href ='visualization';">Charts</button>
<button class="btn btn-primary col-2" type="button" style="margin-left: 0.5em;" onclick="location.href ='barangay-heatmap';">Barangay Heatmap</button>
<button class="btn btn-primary active col-2" type="button" style="margin-left: 0.5em;">Monthly Crime Heatmap</button>
<div id= "container">
    <canvas id="Heatmap"></canvas>
</div><br><br><br><br><br><br><br><br><br><br>
<script>
   anychart.onDocumentReady(function () {

    var data= [
      {x:2017, y: "January", heat: 281},
      {x:2018, y: "January", heat: 141},
      {x:2019, y: "January", heat: 197},
      {x:2020, y: "January", heat: 147},
      {x:2021, y: "January", heat: 83},
      {x:"Grand Total", y: "January", heat: 849},
      {x:2017, y: "February", heat: 209},
      {x:2018, y: "February", heat: 153},
      {x:2019, y: "February", heat: 181},
      {x:2020, y: "February", heat: 148},
      {x:2021, y: "February", heat: 80},
      {x:"Grand Total", y: "February", heat: 771},
      {x:2017, y: "March", heat: 205},
      {x:2018, y: "March", heat: 156},
      {x:2019, y: "March", heat: 176},
      {x:2020, y: "March", heat: 155},
      {x:2021, y: "March", heat: 68},
      {x:"Grand Total", y: "March", heat: 760},
      {x:2017, y: "April", heat: 196},
      {x:2018, y: "April", heat: 124},
      {x:2019, y: "April", heat: 196},
      {x:2020, y: "April", heat: 101},
      {x:2021, y: "April", heat: 85},
      {x:"Grand Total", y: "April", heat: 702},
      {x:2017, y: "May", heat: 255},
      {x:2018, y: "May", heat: 126},
      {x:2019, y: "May", heat: 234},
      {x:2020, y: "May", heat: 69},
      {x:2021, y: "May", heat: 62},
      {x:"Grand Total", y: "May", heat: 746},
      {x:2017, y: "June", heat: 206},
      {x:2018, y: "June", heat: 128},
      {x:2019, y: "June", heat: 216},
      {x:2020, y: "June", heat: 77},
      {x:2021, y: "June", heat: 78},
      {x:"Grand Total", y: "June", heat: 705},
      {x:2017, y: "July", heat: 219},
      {x:2018, y: "July", heat: 123},
      {x:2019, y: "July", heat: 225},
      {x:2020, y: "July", heat: 73},
      {x:2021, y: "July", heat: 45},
      {x:"Grand Total", y: "July", heat: 685},
      {x:2017, y: "August", heat: 247},
      {x:2018, y: "August", heat: 118},
      {x:2019, y: "August", heat: 210},
      {x:2020, y: "August", heat: 76},
      {x:2021, y: "August", heat: 48},
      {x:"Grand Total", y: "August", heat: 699},
      {x:2017, y: "September", heat: 183},
      {x:2018, y: "September", heat: 159},
      {x:2019, y: "September", heat: 226},
      {x:2020, y: "September", heat: 59},
      {x:2021, y: "September", heat: 44},
      {x:"Grand Total", y: "September", heat: 671},
      {x:2017, y: "October", heat: 225},
      {x:2018, y: "October", heat: 149},
      {x:2019, y: "October", heat: 186},
      {x:2020, y: "October", heat: 53},
      {x:2021, y: "October", heat: ""},
      {x:"Grand Total", y: "October", heat: 613},
      {x:2017, y: "November", heat: 167},
      {x:2018, y: "November", heat: 201},
      {x:2019, y: "November", heat: 131},
      {x:2020, y: "November", heat: 80},
      {x:2021, y: "November", heat: ""},
      {x:"Grand Total", y: "November", heat: 579},
      {x:2017, y: "December", heat: 143},
      {x:2018, y: "December", heat: 179},
      {x:2019, y: "December", heat: 131},
      {x:2020, y: "December", heat: 51},
      {x:2021, y: "December", heat: ""},
      {x:"Grand Total", y: "December", heat: 504},
      {x:2017, y: "Grand Total", heat: 2536},
      {x:2018, y: "Grand Total", heat: 1757},
      {x:2019, y: "Grand Total", heat: 2309},
      {x:2020, y: "Grand Total", heat: 1089},
      {x:2021, y: "Grand Total", heat: 593},
      {x:"Grand Total", y: "Grand Total", heat: 8284},
    ]

      // create the chart and set the data
      chart = anychart.heatMap(data);
        
      // set the chart title
      chart.title("Dumaguete City Monthly Crime Cases Heat Map");
        
      // create and configure the color scale.
      var customColorScale = anychart.scales.ordinalColor();
      customColorScale.ranges([
        //green
        { less: 0 },
        { from: 1, to: 30 },
        { from: 31, to: 50 },
        //yellow
        { from: 51, to: 70 },
        { from: 71, to: 90 },
        { from: 91, to: 110},
        //orange
        { from: 111, to: 170 },
        { from: 171, to: 190 },
        //red
        { from: 191, to: 230 },
        { from: 231, to: 250 },
        { from: 251, to: 290 },
        { from: 291, to: 310 },
        { from: 311, to: 9000 },
        {greater: 9001}
      ]);

      customColorScale.colors([
        //green
        "rgba(57, 53, 53, 1)",
        "rgba(52, 242, 58, 1)",
        "rgba(109, 255, 0, 1)",
        //yellow
        "rgba(189, 255, 0, 1)",
        "rgba(255, 255, 0, 0.65)",
        "rgba(226, 255, 0, 1)",
        //orange
        "rgba(242, 196, 51, 1)",
        "rgba(242, 165, 51, 1)",
        //red
        "rgba(237, 104, 28, 1)",
        "rgba(241, 49, 29, 0.8)",
        "rgba(237, 28, 28, 1)",
        "rgba(237, 28, 28, 1)",
        "rgba(237, 28, 28, 1)"
      ]);
        
      // set the color scale as the color scale of the chart
      chart.colorScale(customColorScale);
        
      // set the container id
      chart.container("container");
        
      // initiate drawing the chart
      chart.draw();
   });

</script>
</body>
<?php include("footer.php"); ?>
</html>