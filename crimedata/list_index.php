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
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/icon3.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&family=Vollkorn:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<?php include("header.php"); ?>
<body>
    <h3 align="center">List Collection</h3>
  <center><button class="btn btn-success btn-lg" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">LIst Tab</button></center>

  <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel" style="background-color:#0F3465;">
    <div class="offcanvas-header">
      <a href="main.php"><img class="logo" src="img/logo5.svg" style="width: 200px;" alt="logo"></a>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <h4 class="offcanvas-title border-bottom" id="offcanvasWithBothOptionsLabel" style="margin:1em 0em 2em 0em;">List Tab</h4>
      <div class="list-group list-group-flush" style="padding: 0px 30px 0px 30px">
        <input type="checkbox" class="btn-check" id="BoxName1" autocomplete="off" onclick="ShowCheckboxDiv('BoxName', 8)"/>
        <label class="btn btn-light" for="BoxName1">Barangay</label><br>

        <input type="checkbox" class="btn-check" id="BoxName2" autocomplete="off" onclick="ShowCheckboxDiv('BoxName', 8)"/>
        <label class="btn btn-light" for="BoxName2">Crime Type</label><br>

        <input type="checkbox" class="btn-check" id="BoxName3" autocomplete="off" onclick="ShowCheckboxDiv('BoxName', 8)"/>
        <label class="btn btn-light" for="BoxName3">Category</label><br>
            
        <input type="checkbox" class="btn-check" id="BoxName4" autocomplete="off" onclick="ShowCheckboxDiv('BoxName', 8)"/>
        <label class="btn btn-light" for="BoxName4">Classification</label><br>

        <input type="checkbox" class="btn-check" id="BoxName5" autocomplete="off" onclick="ShowCheckboxDiv('BoxName', 8)"/>
        <label class="btn btn-light" for="BoxName5">Status</label><br>
            
        <input type="checkbox" class="btn-check" id="BoxName6" autocomplete="off" onclick="ShowCheckboxDiv('BoxName', 8)"/>
        <label class="btn btn-light" for="BoxName6">Solve</label><br>

        <input type="checkbox" class="btn-check" id="BoxName7" autocomplete="off" onclick="ShowCheckboxDiv('BoxName', 8)"/>
        <label class="btn btn-light" for="BoxName7">Clear</label><br>
          
        <input type="checkbox" class="btn-check" id="BoxName8" autocomplete="off" onclick="ShowCheckboxDiv('BoxName', 8)"/>
        <label class="btn btn-light" for="BoxName8">Occurence</label>
      </div>
    </div>
  </div>

  <center><div class="col-lg-7">

      <div ID="BoxName1Div" STYLE="display:block;">
        <ul class="list-group">
          <li class="list-group-item bg-danger d-flex justify-content-between align-items-center" style="color: white;">
            Barangay<span class='badge rounded-pill'>COUNT</span>
          </li>
          <?php
            $res=mysqli_query($conn,"SELECT barangay_name , COUNT(barangay_name) AS numbers FROM cases GROUP BY barangay_name ORDER BY numbers DESC;");
            while ($row=mysqli_fetch_array($res))
            {
              echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
              echo $row['barangay_name'];
              echo "<span class='badge bg-danger rounded-pill'>"; echo $row['numbers']; echo "</span>";
              echo "</li>";
            }
          ?>
        </ul>
      </div>
      <div ID="BoxName2Div" STYLE="display:none;">
        <ul class="list-group">
          <li class="list-group-item bg-danger d-flex justify-content-between align-items-center" style="color: white;">
            Crime Type<span class='badge rounded-pill'>COUNT</span>
          </li>
          <?php
            $res=mysqli_query($conn,"SELECT crime_type_name , COUNT(crime_type_name) AS numbers FROM cases GROUP BY crime_type_name ORDER BY numbers DESC;");
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
      <div id="BoxName3Div" style="display:none;">
        <ul class="list-group">
          <li class="list-group-item bg-danger d-flex justify-content-between align-items-center" style="color: white;">
            Category<span class='badge rounded-pill'>COUNT</span>
          </li>
          <?php
            $res=mysqli_query($conn,"SELECT category_name , COUNT(category_name) AS numbers FROM cases GROUP BY category_name ORDER BY numbers DESC;");
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
      <div id="BoxName4Div" style="display:none;">
        <ul class="list-group">
          <li class="list-group-item bg-danger d-flex justify-content-between align-items-center" style="color: white;">
            CLassification<span class='badge rounded-pill'>COUNT</span>
          </li>
          <?php
            $res=mysqli_query($conn,"SELECT classification_name , COUNT(classification_name) AS numbers FROM cases GROUP BY classification_name ORDER BY numbers DESC;");
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
      <div id="BoxName5Div" style="display:none;">
        <ul class="list-group">
          <li class="list-group-item bg-danger d-flex justify-content-between align-items-center" style="color: white;">
            Status<span class='badge rounded-pill'>COUNT</span>
          </li>
          <?php
            $res=mysqli_query($conn,"SELECT status_name , COUNT(status_name) AS numbers FROM cases GROUP BY status_name ORDER BY numbers DESC;");
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
      <div id="BoxName6Div" style="display:none;">
        <ul class="list-group">
          <li class="list-group-item bg-danger d-flex justify-content-between align-items-center" style="color: white;">
            Solve<span class='badge rounded-pill'>COUNT</span>
          </li>
          <?php
            $res=mysqli_query($conn,"SELECT solve , COUNT(solve) AS numbers FROM cases GROUP BY solve ORDER BY numbers DESC;");
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
      <div id="BoxName7Div" style="display:none;">
        <ul class="list-group">
          <li class="list-group-item bg-danger d-flex justify-content-between align-items-center" style="color: white;">
            Clear<span class='badge rounded-pill'>COUNT</span>
          </li>
          <?php
            $res=mysqli_query($conn,"SELECT `clear` , COUNT(`clear`) AS numbers FROM cases GROUP BY `clear` ORDER BY numbers DESC;");
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
      <div id="BoxName8Div" style="display:none;">
        <ul class="list-group">
          <li class="list-group-item bg-danger d-flex justify-content-between align-items-center" style="color: white;">
            Occurence<span class='badge rounded-pill'>COUNT</span>
          </li>
          <?php
            $res=mysqli_query($conn,"SELECT `occurence_name` , COUNT(`occurence_name`) AS numbers FROM cases GROUP BY `occurence_name` ORDER BY numbers DESC;");
            while ($row=mysqli_fetch_array($res))
            {
              echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
              echo $row['occurence_name'];
              echo "<span class='badge bg-danger rounded-pill'>"; echo $row['numbers']; echo "</span>";
              echo "</li>";
            }
          ?>
        </ul>
      </div><br><br>
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