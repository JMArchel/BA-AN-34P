<?php 

include "connection.php";
$id=$_GET["id"];

session_start();
$user_id= $_SESSION["user_id"];

mysqli_query($conn, "UPDATE `user` SET `approve_reject_timestamp`=CURRENT_TIMESTAMP,`supervisor_accept_reject`='$user_id',`approval`='1' WHERE `user_id`= $id ");
?>
<script type="text/javascript">
window.location="approval.php?check=approve";
</script>