<?php
include 'connection.php';
session_start();
$user_id=$_SESSION['user_id'];
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
   <title>update profile</title>
</head>
<?php include("header.php"); ?>
<body>
	<div class="col-md-7" style="margin:auto;">
		<h3>Approval</h3><br>
        <table class="table table-bordered">
          <thead class="thead-dark">
            <tr>
              <th scope="col">User ID</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Position</th>
              <th scope="col">Email</th>
              <th scope="col" colspan="2">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $res=mysqli_query($conn,"SELECT `user_id`, `email`, `first_name`, `last_name`, `position` FROM `user` WHERE `approval`=0");

            while ($row=mysqli_fetch_array($res))
            {
              echo "<tr>";
              echo "<td>"; echo $row["user_id"];  echo "</td>";
              echo "<td>"; echo ucfirst($row["first_name"]);  echo "</td>";
              echo "<td>"; echo ucfirst($row["last_name"]);  echo "</td>";
              echo "<td>"; echo $row["position"];  echo "</td>";
              echo "<td>"; echo $row["email"];  echo "</td>";
              echo "<td>"; ?> <a href="register_approve.php?id=<?php echo $row["user_id"]; ?>"><button type="button" class="btn btn-success">Approve</button></a> <?php  echo "</td>"; 
              echo "<td>"; ?> <a href="register_reject.php?id=<?php echo $row["user_id"]; ?>" onClick='return confirm("Are you sure you want to Reject?");'><button type="button" class="btn btn-danger">Reject</button></a> <?php  echo "</td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
    </div>
</body>
<?php include("footer.php"); ?>
</html>