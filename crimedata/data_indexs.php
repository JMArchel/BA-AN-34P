<br><?php
            if ($position == 'Supervisor' OR 'Manager' ){?>
                <input type="submit" class="btn btn-primary" value="Update">
				<?php if ($position =="Manager"){ ?>
					<input type="submit" class="btn btn-primary" value="Update2">
            <?php }?>



<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php 
include "connection.php";
mysqli_select_db($conn, 'pagination');
$results_per_page = 100;
$sql="SELECT * FROM `cases`";
$result = mysqli_query($conn, $sql);
$number_of_results = mysqli_num_rows($result);
$number_of_pages = ceil($number_of_results/$results_per_page);
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}
$this_page_first_result = ($page-1)*$results_per_page;
 ?>

<html lang="en">
<head>
	<title>Data</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
  <script type="text/javascript" src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> 

</head>
<?php include("header.php"); ?>
<body>
  <div>
    <?php
      for ($page=1;$page<=$number_of_pages;$page++)
      {?>
        <a href="data_index.php?page=<?php echo $page; ?>"><button type="button" class="btn btn-info"><?php echo $page; ?></button></a>
      <?php } ?>
  </div>
  <div class="row">
    <div class="col-lg-12"><h3>Case List</h3></div>
  </div>
  <div>
    <div class="col-lg-12">
      <div class="col-lg-12" >
        <table class="table table-striped table-bordered display" id="myTable">
          <thead class="thead-dark">
            <tr>
              <th>#</th>  
              <th>Date</th>
              <th>Day</th>
              <th>time</th>
              <th>Barangay</th>
              <th>X</th>
              <th>Y</th>
              <th>Crime_type</th>
              <th>Category</th>
              <th>Classification</th>
              <th>Status</th>
              <th>Solve</th>
              <th>Clear</th>
              <th>Occurence</th>
              <th>User</th>
              <th>Created</th>
              <th>Updated</th>
              <th colspan="2">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $res=mysqli_query($conn,"SELECT `case_id`,`date`,`day`,`time`,`barangay_name`,`coordinate_x`,`coordinate_y`,`crime_type_name`,`category_name`,`classification_name`,`status_name`,`solve`,`clear`,`occurence_name`, user.first_name, user.last_name ,cases.create_timestamp, cases.update_timestamp FROM cases INNER JOIN user ON user.user_id= cases.user_id ORDER BY case_id LIMIT $this_page_first_result ,$results_per_page;");
            while ($row=mysqli_fetch_array($res))
            {
              echo "<tr>";
              echo "<td>"; echo $row["case_id"];  echo "</td>";
              echo "<td>"; echo $row["date"];  echo "</td>";
              echo "<td>"; echo $row["day"];  echo "</td>";
              echo "<td>"; echo $row["time"];  echo "</td>";
              echo "<td>"; echo $row["barangay_name"];  echo "</td>";
              echo "<td>"; echo $row["coordinate_x"];  echo "</td>";
              echo "<td>"; echo $row["coordinate_x"];  echo "</td>";
              echo "<td>"; echo $row["crime_type_name"];  echo "</td>";
              echo "<td>"; echo $row["category_name"];  echo "</td>";
              echo "<td>"; echo $row["classification_name"];  echo "</td>";
              echo "<td>"; echo $row["status_name"];  echo "</td>";
              echo "<td>"; echo $row["solve"];  echo "</td>";
              echo "<td>"; echo $row["clear"];  echo "</td>";
              echo "<td>"; echo $row["occurence_name"];  echo "</td>";
              echo "<td>"; echo $row["first_name"]; echo " "; echo $row["last_name"]; echo "</td>";
              echo "<td>"; echo $row["create_timestamp"];  echo "</td>";
              echo "<td>"; echo $row["update_timestamp"];  echo "</td>";
              echo "<td>"; ?> <a href="data_edit.php?id=<?php echo $row["case_id"]; ?>"><button type="button" class="btn btn-success">Edit</button></a> <?php  echo "</td>"; 
              echo "<td>"; ?> <a href="data_delete.php?id=<?php echo $row["case_id"]; ?>" onClick='return confirm("Are you sure you want to delete?");'><button type="button" class="btn btn-danger">Delete</button></a> <?php  echo "</td>"; echo "</tr>";
            }
            ?>
          </tbody>
          <tfoot class="thead-dark">
            <tr>
              <th>#</th>  
              <th>Date</th>
              <th>Day</th>
              <th>time</th>
              <th>Barangay</th>
              <th>X</th>
              <th>Y</th>
              <th>Crime_type</th>
              <th>Category</th>
              <th>Classification</th>
              <th>Status</th>
              <th>Solve</th>
              <th>Clear</th>
              <th>Occurence</th>
              <th>User</th>
              <th>Created</th>
              <th>Updated</th>
              <th colspan="2">Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</body>
<?php include("footer.php"); ?>
  <script>
    $(document).ready( function () {
      $('#myTable').DataTable();
    } );
  </script>
</html>
