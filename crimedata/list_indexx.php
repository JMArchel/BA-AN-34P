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
  <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Check for Lists</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <input type="checkbox" id="BoxName1" onclick="ShowCheckboxDiv('BoxName', 7)"/>Crime Type<br>
      <input type="checkbox" id="BoxName2" onclick="ShowCheckboxDiv('BoxName', 7)"/>Categoru<br>
      <input type="checkbox" id="BoxName3" onclick="ShowCheckboxDiv('BoxName', 7)"/>Classification<br>
      <input type="checkbox" id="BoxName4" onclick="ShowCheckboxDiv('BoxName', 7)"/>Status<br>
      <input type="checkbox" id="BoxName5" onclick="ShowCheckboxDiv('BoxName', 7)"/>Solve<br>
      <input type="checkbox" id="BoxName6" onclick="ShowCheckboxDiv('BoxName', 7)"/>Clear<br>
      <input type="checkbox" id="BoxName7" onclick="ShowCheckboxDiv('BoxName', 7)"/>Occurence<br>
    </div>
  </div>
	<div class="container">
    <center><button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">OPEN</button></center><br>
    <center><div class="col-lg-9">
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel">
        <?php
            $barangay1=mysqli_query($conn,"SELECT cases.barangay_name, barangay.barangay_map, COUNT(cases.barangay_name) AS numbers FROM cases INNER JOIN barangay ON cases.barangay_name=barangay.barangay_name GROUP BY barangay_name LIMIT 1;");
            while ($row1=mysqli_fetch_array($barangay1)){?>
              <div class="carousel-item active">
                  <img src="brng/<?php echo $row1['barangay_map'];?>" class="d-block w-50" alt="<?php echo $row1['barangay_name'];?>">
                </div>
            <?php }
          ?>
          <?php
            $barangay=mysqli_query($conn,"SELECT cases.barangay_name, barangay.barangay_map, COUNT(cases.barangay_name) AS numbers FROM cases INNER JOIN barangay ON cases.barangay_name=barangay.barangay_name GROUP BY barangay_name LIMIT 40 OFFSET 1;");
            while ($row=mysqli_fetch_array($barangay)){?>
              <div class="carousel-item">
                <img src="brng/<?php echo $row['barangay_map'];?>" class="d-block w-50" alt="<?php echo $row['barangay_name'];?>">
              </div>
            <?php }
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div><center>
    <center><div class="col-lg-9">
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