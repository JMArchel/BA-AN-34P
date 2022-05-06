<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include_once("connection.php");
	 
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title>LIST • Dumaguete CDMS</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="img/icon3.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<?php include("header.php"); ?>
<body>
  <div class="border-end sidebar col-lg-2" style="background-color:#1b1e2a;">
    <div class="border-bottom" style="color:white;padding-top:20px;"><h4>Start Bootstrap</4></div><br>
      <div class="list-group list-group-flush" style="padding: 0px 30px 0px 30px">
        <input type="checkbox" class="btn-check active" id="BoxName1" autocomplete="off" onclick="ShowCheckboxDiv('BoxName', 7)" aria-pressed="true"/>
        <label class="btn btn-primary" for="BoxName1">Crime Type</label><br>

        <input type="checkbox" class="btn-check" id="BoxName2" autocomplete="off" onclick="ShowCheckboxDiv('BoxName', 7)"/>
        <label class="btn btn-primary" for="BoxName2">Category</label><br>
          
        <input type="checkbox" class="btn-check" id="BoxName3" autocomplete="off" onclick="ShowCheckboxDiv('BoxName', 7)"/>
        <label class="btn btn-primary" for="BoxName3">Classification</label><br>

        <input type="checkbox" class="btn-check" id="BoxName4" autocomplete="off" onclick="ShowCheckboxDiv('BoxName', 7)"/>
        <label class="btn btn-primary" for="BoxName4">Status</label><br>
          
        <input type="checkbox" class="btn-check" id="BoxName5" autocomplete="off" onclick="ShowCheckboxDiv('BoxName', 7)"/>
        <label class="btn btn-primary" for="BoxName5">Solve</label><br>

        <input type="checkbox" class="btn-check" id="BoxName6" autocomplete="off" onclick="ShowCheckboxDiv('BoxName', 7)"/>
        <label class="btn btn-primary" for="BoxName6">Clear</label><br>
          
        <input type="checkbox" class="btn-check" id="BoxName7" autocomplete="off" onclick="ShowCheckboxDiv('BoxName', 7)"/>
        <label class="btn btn-primary" for="BoxName7">Occurence</label>
      </div>
    </div>
    <!-- Page content-->
    <center><div class="col-lg-7">
      <div ID="BoxName1Div" STYLE="display:none;">
        <ul class="list-group">
          <li class="list-group-item bg-danger d-flex justify-content-between align-items-center" style="color: white;">
            Crime Type<span class='badge rounded-pill'>COUNT</span>
          </li>
          <?php
            $res=mysqli_query($conn,"SELECT crime_type_name , COUNT(crime_type_name) AS numbers FROM cases GROUP BY crime_type_name;");
            while ($row=mysqli_fetch_array($res))
            {
              echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
              echo $row['crime_type_name'];
              echo "<span class='badge bg-danger rounded-pill'>"; echo $row['numbers']; echo "</span>";
              echo "</li>";
            }
          ?>
        </ul>
      </div>
      <div id="BoxName2Div" style="display:none;">
        <ul class="list-group">
          <li class="list-group-item bg-danger d-flex justify-content-between align-items-center" style="color: white;">
            Category<span class='badge rounded-pill'>COUNT</span>
          </li>
          <?php
            $res=mysqli_query($conn,"SELECT category_name , COUNT(category_name) AS numbers FROM cases GROUP BY category_name;");
            while ($row=mysqli_fetch_array($res))
            {
              echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
              echo $row['category_name'];
              echo "<span class='badge bg-danger rounded-pill'>"; echo $row['numbers']; echo "</span>";
              echo "</li>";
            }
          ?>
        </ul>
      </div>
      <div id="BoxName3Div" style="display:none;">
        <ul class="list-group">
          <li class="list-group-item bg-danger d-flex justify-content-between align-items-center" style="color: white;">
            CLassification<span class='badge rounded-pill'>COUNT</span>
          </li>
          <?php
            $res=mysqli_query($conn,"SELECT classification_name , COUNT(classification_name) AS numbers FROM cases GROUP BY classification_name;");
            while ($row=mysqli_fetch_array($res))
            {
              echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
              echo $row['classification_name'];
              echo "<span class='badge bg-danger rounded-pill'>"; echo $row['numbers']; echo "</span>";
              echo "</li>";
            }
          ?>
        </ul>
      </div>
      <div id="BoxName4Div" style="display:none;">
        <ul class="list-group">
          <li class="list-group-item bg-danger d-flex justify-content-between align-items-center" style="color: white;">
            Status<span class='badge rounded-pill'>COUNT</span>
          </li>
          <?php
            $res=mysqli_query($conn,"SELECT status_name , COUNT(status_name) AS numbers FROM cases GROUP BY status_name;");
            while ($row=mysqli_fetch_array($res))
            {
              echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
              echo $row['status_name'];
              echo "<span class='badge bg-danger rounded-pill'>"; echo $row['numbers']; echo "</span>";
              echo "</li>";
            }
          ?>
        </ul>
      </div>
      <div id="BoxName5Div" style="display:none;">
        <ul class="list-group">
          <li class="list-group-item bg-danger d-flex justify-content-between align-items-center" style="color: white;">
            Solve<span class='badge rounded-pill'>COUNT</span>
          </li>
          <?php
            $res=mysqli_query($conn,"SELECT solve , COUNT(solve) AS numbers FROM cases GROUP BY solve;");
            while ($row=mysqli_fetch_array($res))
            {
              echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
              echo $row['solve'];
              echo "<span class='badge bg-danger rounded-pill'>"; echo $row['numbers']; echo "</span>";
              echo "</li>";
            }
          ?>
        </ul>
      </div>
      <div id="BoxName6Div" style="display:none;">
        <ul class="list-group">
          <li class="list-group-item bg-danger d-flex justify-content-between align-items-center" style="color: white;">
            Clear<span class='badge rounded-pill'>COUNT</span>
          </li>
          <?php
            $res=mysqli_query($conn,"SELECT `clear` , COUNT(`clear`) AS numbers FROM cases GROUP BY `clear`;");
            while ($row=mysqli_fetch_array($res))
            {
              echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
              echo $row['clear'];
              echo "<span class='badge bg-danger rounded-pill'>"; echo $row['numbers']; echo "</span>";
              echo "</li>";
            }
          ?>
        </ul>
      </div>
      <div id="BoxName7Div" style="display:none;">
        <ul class="list-group">
          <li class="list-group-item bg-danger d-flex justify-content-between align-items-center" style="color: white;">
            Occurence<span class='badge rounded-pill'>COUNT</span>
          </li>
          <?php
            $res=mysqli_query($conn,"SELECT `occurence_name` , COUNT(`occurence_name`) AS numbers FROM cases GROUP BY `occurence_name`;");
            while ($row=mysqli_fetch_array($res))
            {
              echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
              echo $row['occurence_name'];
              echo "<span class='badge bg-danger rounded-pill'>"; echo $row['numbers']; echo "</span>";
              echo "</li>";
            }
          ?>
        </ul>
      </div>
    </div></center>
  </div>
        </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
<?php include("footer.php"); ?>
</html>

<script>
var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})
function ShowCheckboxDiv (IdBaseName, NumberOfBoxes) {
    for (x=1;x<=NumberOfBoxes;x++) {
        CheckThisBox = IdBaseName + x;
        BoxDiv = IdBaseName + x +'Div';
    if (document.getElementById(CheckThisBox).checked) {
        document.getElementById(BoxDiv).style.display = "block";
        }
    else {
        document.getElementById(BoxDiv).style.display = "none";
        }
    }
    return false;
}
</script>