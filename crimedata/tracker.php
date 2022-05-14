<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}
include 'connection.php';
?>
<!DOCTYPE html>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <link rel="icon" type="image/png" href="img/icon3.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
   <title>TRACKER • Dumaguete CDMS</title>
</head>
<?php include("header.php"); ?>
<body>
	<div class="col-md-7" style="margin:auto;">
		<h3>Tracker</h3><br>
        <table class="table" style="text-align: center;">
          <thead class="thead-dark">
            <tr class="table-dark">
              <th>Supervisor / Manager</th>
              <th>Approved User</th>
              <th>Accepted or Rejected</th>
              <th>Timestamp</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $res=mysqli_query($conn,'SELECT CONCAT(s.first_name," ", s.last_name) AS supervisor, CONCAT(u.first_name," ", u.last_name) AS username, a.approval_name ,u.approve_reject_timestamp
            FROM user u JOIN user s ON s.user_id=u.supervisor_accept_reject JOIN approval_table a ON a.approval_id=u.approval;');

            while ($row=mysqli_fetch_array($res))
            {
              echo "<tr>";
              echo "<td>"; echo ucwords($row["supervisor"]);  echo "</td>";
              echo "<td>"; echo ucwords($row["username"]);  echo "</td>";
              echo "<td>"; echo $row["approval_name"];  echo "</td>";
              echo "<td>"; echo $row["approve_reject_timestamp"];  echo "</td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
    </div>
</body>
<?php include("footer.php"); ?>
</html>