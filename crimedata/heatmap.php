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
<button class="btn btn-primary active col-2" type="button" style="margin-left: 0.5em;">Barangay Heatmap</button>
<button class="btn btn-primary col-2" type="button" style="margin-left: 0.5em;" onclick="location.href ='monthly-crime-heatmap';">Monthly Crime Heatmap</button>
<div id= "container">
    <canvas id="Heatmap"></canvas>
</div><br><br><br><br><br><br><br><br><br><br>
<script>
   anychart.onDocumentReady(function () {

    var data= [
      {x:2017, y: "Bagacay", heat: 144},
      {x:2018, y: "Bagacay", heat: 124},
      {x:2019, y: "Bagacay", heat: 136},
      {x:2020, y: "Bagacay", heat: 68},
      {x:2021, y: "Bagacay", heat: 64},
      {x:"Grand Total", y: "Bagacay", heat: 536},
      {x:2017, y: "Bajumpandan", heat: 29},
      {x:2018, y: "Bajumpandan", heat: 30},
      {x:2019, y: "Bajumpandan", heat: 36},
      {x:2020, y: "Bajumpandan", heat: 23},
      {x:2021, y: "Bajumpandan", heat: 13},
      {x:"Grand Total", y: "Bajumpandan", heat: 131},
      {x:2017, y: "Balugo", heat: 17},
      {x:2018, y: "Balugo", heat: 8},
      {x:2019, y: "Balugo", heat: 19},
      {x:2020, y: "Balugo", heat: 19},
      {x:2021, y: "Balugo", heat: 6},
      {x:"Grand Total", y: "Balugo", heat: 69},
      {x:2017, y: "Banilad", heat: 78},
      {x:2018, y: "Banilad", heat: 60},
      {x:2019, y: "Banilad", heat: 86},
      {x:2020, y: "Banilad", heat: 61},
      {x:2021, y: "Banilad", heat: 21},
      {x:"Grand Total", y: "Banilad", heat: 306},
      {x:2017, y: "Bantayan", heat: 78},
      {x:2018, y: "Bantayan", heat: 48},
      {x:2019, y: "Bantayan", heat: 65},
      {x:2020, y: "Bantayan", heat: 22},
      {x:2021, y: "Bantayan", heat: 9},
      {x:"Grand Total", y: "Bantayan", heat: 212},
      {x:2017, y: "Batinguel", heat: 90},
      {x:2018, y: "Batinguel", heat: 68},
      {x:2019, y: "Batinguel", heat: 101},
      {x:2020, y: "Batinguel", heat: 58},
      {x:2021, y: "Batinguel", heat: 31},
      {x:"Grand Total", y: "Batinguel", heat: 348},
      {x:2017, y: "Buñao", heat: 31},
      {x:2018, y: "Buñao", heat: 29},
      {x:2019, y: "Buñao", heat: 34},
      {x:2020, y: "Buñao", heat: 13},
      {x:2021, y: "Buñao", heat: 2},
      {x:"Grand Total", y: "Buñao", heat: 109},
      {x:2017, y: "Cadawinonan", heat: 20},
      {x:2018, y: "Cadawinonan", heat: 15},
      {x:2019, y: "Cadawinonan", heat: 56},
      {x:2020, y: "Cadawinonan", heat: 48},
      {x:2021, y: "Cadawinonan", heat: 20},
      {x:"Grand Total", y: "Cadawinonan", heat: 159},
      {x:2017, y: "Calindagan", heat: 248},
      {x:2018, y: "Calindagan", heat: 174},
      {x:2019, y: "Calindagan", heat: 163},
      {x:2020, y: "Calindagan", heat: 105},
      {x:2021, y: "Calindagan", heat: 46},
      {x:"Grand Total", y: "Calindagan", heat: 736},
      {x:2017, y: "Camanjac", heat: 29},
      {x:2018, y: "Camanjac", heat: 28},
      {x:2019, y: "Camanjac", heat: 45},
      {x:2020, y: "Camanjac", heat: 36},
      {x:2021, y: "Camanjac", heat: 24},
      {x:"Grand Total", y: "Camanjac", heat: 162},
      {x:2017, y: "Candau-ay", heat: 29},
      {x:2018, y: "Candau-ay", heat: 24},
      {x:2019, y: "Candau-ay", heat: 50},
      {x:2020, y: "Candau-ay", heat: 46},
      {x:2021, y: "Candau-ay", heat: 20},
      {x:"Grand Total", y: "Candau-ay", heat: 169},
      {x:2017, y: "Cantil-e", heat: 15},
      {x:2018, y: "Cantil-e", heat: 12},
      {x:2019, y: "Cantil-e", heat: 14},
      {x:2020, y: "Cantil-e", heat: 16},
      {x:2021, y: "Cantil-e", heat: 7},
      {x:"Grand Total", y: "Cantil-e", heat: 64},
      {x:2017, y: "Daro", heat: 304},
      {x:2018, y: "Daro", heat: 200},
      {x:2019, y: "Daro", heat: 247},
      {x:2020, y: "Daro", heat: 67},
      {x:2021, y: "Daro", heat: 42},
      {x:"Grand Total", y: "Daro", heat: 860},
      {x:2017, y: "Junob", heat: 35},
      {x:2018, y: "Junob", heat: 31},
      {x:2019, y: "Junob", heat: 49},
      {x:2020, y: "Junob", heat: 30},
      {x:2021, y: "Junob", heat: 17},
      {x:"Grand Total", y: "Junob", heat: 162},
      {x:2017, y: "Looc", heat: 119},
      {x:2018, y: "Looc", heat: 86},
      {x:2019, y: "Looc", heat: 111},
      {x:2020, y: "Looc", heat: 101},
      {x:2021, y: "Looc", heat: 81},
      {x:"Grand Total", y: "Looc", heat: 498},
      {x:2017, y: "Mangnao-Canal", heat: 58},
      {x:2018, y: "Mangnao-Canal", heat: 20},
      {x:2019, y: "Mangnao-Canal", heat: 43},
      {x:2020, y: "Mangnao-Canal", heat: 23},
      {x:2021, y: "Mangnao-Canal", heat: 12},
      {x:"Grand Total", y: "Mangnao-Canal", heat: 156},
      {x:2017, y: "Motong", heat: 40},
      {x:2018, y: "Motong", heat: 30},
      {x:2019, y: "Motong", heat: 29},
      {x:2020, y: "Motong", heat: 14},
      {x:2021, y: "Motong", heat: 4},
      {x:"Grand Total", y: "Motong", heat: 117},
      {x:2017, y: "Piapi", heat: 116},
      {x:2018, y: "Piapi", heat: 68},
      {x:2019, y: "Piapi", heat: 96},
      {x:2020, y: "Piapi", heat: 51},
      {x:2021, y: "Piapi", heat: 18},
      {x:"Grand Total", y: "Piapi", heat: 349},
      {x:2017, y: "Poblacion No.1 (Barangay 1)", heat: 2},
      {x:2018, y: "Poblacion No.1 (Barangay 1)", heat: 13},
      {x:2019, y: "Poblacion No.1 (Barangay 1)", heat: 28},
      {x:2020, y: "Poblacion No.1 (Barangay 1)", heat: 21},
      {x:2021, y: "Poblacion No.1 (Barangay 1)", heat: 13},
      {x:"Grand Total", y: "Poblacion No.1 (Barangay 1)", heat: 77},
      {x:2017, y: "Poblacion No.2 (Barangay 2)", heat: 36},
      {x:2018, y: "Poblacion No.2 (Barangay 2)", heat: 29},
      {x:2019, y: "Poblacion No.2 (Barangay 2)", heat: 47},
      {x:2020, y: "Poblacion No.2 (Barangay 2)", heat: 16},
      {x:2021, y: "Poblacion No.2 (Barangay 2)", heat: 4},
      {x:"Grand Total", y: "Poblacion No.2 (Barangay 2)", heat: 132},
      {x:2017, y: "Poblacion No.3 (Barangay 3)", heat: 339},
      {x:2018, y: "Poblacion No.3 (Barangay 3)", heat: 248},
      {x:2019, y: "Poblacion No.3 (Barangay 3)", heat: 326},
      {x:2020, y: "Poblacion No.3 (Barangay 3)", heat: 74},
      {x:2021, y: "Poblacion No.3 (Barangay 3)", heat: 48},
      {x:"Grand Total", y: "Poblacion No.3 (Barangay 3)", heat: 1035},
      {x:2017, y: "Poblacion No.4 (Barangay 4)", heat: 105},
      {x:2018, y: "Poblacion No.4 (Barangay 4)", heat: 51},
      {x:2019, y: "Poblacion No.4 (Barangay 4)", heat: 68},
      {x:2020, y: "Poblacion No.4 (Barangay 4)", heat: 8},
      {x:2021, y: "Poblacion No.4 (Barangay 4)", heat: 8},
      {x:"Grand Total", y: "Poblacion No.4 (Barangay 4)", heat: 240},
      {x:2017, y: "Poblacion No.5 (Barangay 5)", heat: 65},
      {x:2018, y: "Poblacion No.5 (Barangay 5)", heat: 55},
      {x:2019, y: "Poblacion No.5 (Barangay 5)", heat: 47},
      {x:2020, y: "Poblacion No.5 (Barangay 5)", heat: 4},
      {x:2021, y: "Poblacion No.5 (Barangay 5)", heat: 2},
      {x:"Grand Total", y: "Poblacion No.5 (Barangay 5)", heat: 173},
      {x:2017, y: "Poblacion No.6 (Barangay 6)", heat: 59},
      {x:2018, y: "Poblacion No.6 (Barangay 6)", heat: 32},
      {x:2019, y: "Poblacion No.6 (Barangay 6)", heat: 25},
      {x:2020, y: "Poblacion No.6 (Barangay 6)", heat: ""},
      {x:2021, y: "Poblacion No.6 (Barangay 6)", heat: 2},
      {x:"Grand Total", y: "Poblacion No.6 (Barangay 6)", heat: 118},
      {x:2017, y: "Poblacion No.7 (Barangay 7)", heat: 55},
      {x:2018, y: "Poblacion No.7 (Barangay 7)", heat: 29},
      {x:2019, y: "Poblacion No.7 (Barangay 7)", heat: 25},
      {x:2020, y: "Poblacion No.7 (Barangay 7)", heat: 8},
      {x:2021, y: "Poblacion No.7 (Barangay 7)", heat: 7},
      {x:"Grand Total", y: "Poblacion No.7 (Barangay 7)", heat: 124},
      {x:2017, y: "Poblacion No.8 (Barangay 8)", heat: 70},
      {x:2018, y: "Poblacion No.8 (Barangay 8)", heat: 38},
      {x:2019, y: "Poblacion No.8 (Barangay 8)", heat: 71},
      {x:2020, y: "Poblacion No.8 (Barangay 8)", heat: 25},
      {x:2021, y: "Poblacion No.8 (Barangay 8)", heat: 13},
      {x:"Grand Total", y: "Poblacion No.8 (Barangay 8)", heat: 217},
      {x:2017, y: "Pulantubig", heat: 47},
      {x:2018, y: "Pulantubig", heat: 31},
      {x:2019, y: "Pulantubig", heat: 53},
      {x:2020, y: "Pulantubig", heat: 17},
      {x:2021, y: "Pulantubig", heat: 7},
      {x:"Grand Total", y: "Pulantubig", heat: 155},
      {x:2017, y: "Tabuctubig", heat: 55},
      {x:2018, y: "Tabuctubig", heat: 23},
      {x:2019, y: "Tabuctubig", heat: 28},
      {x:2020, y: "Tabuctubig", heat: 9},
      {x:2021, y: "Tabuctubig", heat: 5},
      {x:"Grand Total", y: "Tabuctubig", heat: 120},
      {x:2017, y: "Taclobo", heat: 181},
      {x:2018, y: "Taclobo", heat: 123},
      {x:2019, y: "Taclobo", heat: 159},
      {x:2020, y: "Taclobo", heat: 79},
      {x:2021, y: "Taclobo", heat: 38},
      {x:"Grand Total", y: "Taclobo", heat: 580},
      {x:2017, y: "Talay", heat: 18},
      {x:2018, y: "Talay", heat: 22},
      {x:2019, y: "Talay", heat: 52},
      {x:2020, y: "Talay", heat: 27},
      {x:2021, y: "Talay", heat: 8},
      {x:"Grand Total", y: "Talay", heat: 127},
      {x:2017, y: "Grand Total", heat: 2536},
      {x:2018, y: "Grand Total", heat: 1757},
      {x:2019, y: "Grand Total", heat: 2309},
      {x:2020, y: "Grand Total", heat: 1089},
      {x:2021, y: "Grand Total", heat: 593},
      {x:"Grand Total", y: "Grand Total", heat: 8284},
    ]

      // create the chart and set the data
      chart = anychart.heatMap(data);
    
      chart.legend(true);

      // set the chart title
      chart.title("Dumaguete City Crime Cases Barangay Heat Map");
        
      // create and configure the color scale.
      var customColorScale = anychart.scales.ordinalColor();
      customColorScale.ranges([
        //green
        { less: 0 },
        { from: 1, to: 10 },
        { from: 11, to: 20 },
        //yellow
        { from: 21, to: 50 },
        { from: 51, to: 70 },
        { from: 71, to: 90 },
        { from: 91, to: 110 },
        //orange
        { from: 111, to: 130 },
        { from: 131, to: 150 },
        { from: 151, to: 170 },
        { from: 171, to: 190 },
        //red
        { from: 191, to: 210 },
        { from: 211, to: 230 },
        { from: 231, to: 250 },
        { from: 251, to: 270 },
        { from: 271, to: 290 },
        { from: 291, to: 310 },
        { from: 311, to: 8500 },
        {greater: 8501}
      ]);

      customColorScale.colors([
        //green
        "rgba(57, 53, 53, 1)",
        "rgba(52, 242, 58, 1)",
        "rgba(109, 255, 0, 1)",
        //yellow
        "rgba(205, 255, 0, 0.65)",
        "rgba(255, 236, 0, 0.65)",
        "rgba(242, 216, 51, 0.91)",
        "rgba(242, 200, 51, 1)",
        //orange
        "rgba(242, 196, 51, 1)",
        "rgba(242, 176, 51, 1)",
        "rgba(242, 165, 51, 1)",
        "rgba(242, 153, 51, 1)",
        //red
        "rgba(242, 129, 51, 1)",
        "rgba(242, 113, 51, 1)",
        "rgba(242, 97, 51, 1)",
        "rgba(242, 73, 51, 1)",
        "rgba(245, 0, 0, 1)",
        "rgba(240, 48, 37, 1)",
        "rgba(255, 13, 0, 1)",
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