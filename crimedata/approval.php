<?php
include 'connection.php';
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}
$user_id=$_SESSION['user_id'];
if (!empty($_GET['check'])) {
  if ($_GET['check']=='approve') {
    $success=$_GET['check'];
  }elseif($_GET['check']=='reject'){
    $reject=$_GET['check'];
  }
}
?>
<!DOCTYPE html>
<head>
    <title>APPROVAL • Dumaguete CDMS</title>
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
	<div class="col-md-9" style="margin:auto;">
  <?php 
    if(!empty($success)){
      echo '<div class="alert alert-success text-center">' . 'Approved' . '</div>';
    }elseif(!empty($reject)){
      echo '<div class="alert alert-danger text-center">' . 'Rejected' . '</div>';
    }   
  ?>
		<h3 class="text-center">Approval</h3><br>
        <table class="table table-striped" style='text-align: center; background-color: white;'>
          <thead class="thead-dark">
            <tr class='table-dark'>
              <th>User ID</th>
              <th>Full Name</th>
              <th>Position</th>
              <th>Email</th>
              <th colspan="2">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $res=mysqli_query($conn,"SELECT `user_id`, `email`, `first_name`, `last_name`, `position` FROM `user` WHERE `approval`=0");

            while ($row=mysqli_fetch_array($res))
            {
              echo "<tr>";
              echo "<td>"; echo $row["user_id"];  echo "</td>";
              echo "<td>"; echo '<strong>' . ucfirst($row["last_name"]); echo '</strong>, ' .ucfirst($row["first_name"]);  echo "</td>";
              echo "<td>"; echo $row["position"];  echo "</td>";
              echo "<td>"; echo $row["email"];  echo "</td>";
              echo "<td>"; ?> <a href="register_approve.php?id=<?php echo $row["user_id"]; ?>"><button type="button" class="btn btn-success btn-sm">
                Approve
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                  <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                </svg>    
                </button></a> <?php  echo "</td>"; 
              echo "<td>"; ?> <a href="register_reject.php?id=<?php echo $row["user_id"]; ?>" onClick='return confirm("Are you sure you want to Reject?");'><button type="button" class="btn btn-danger btn-sm">
                Reject
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-x-fill" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                </svg>
                </button></a> <?php  echo "</td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
    </div>
</body>
<?php include("footer.php"); ?>
</html>