<?php 

include "connection.php";
$id=$_GET["id"];

session_start();
$user_id= $_SESSION["user_id"];

mysqli_query($conn, "UPDATE `user` SET `approve_reject_timestamp`=CURRENT_TIMESTAMP,`supervisor_accept_reject`='$user_id',`approval`='2' WHERE `user_id`= $id ");

$res=mysqli_query($conn,"SELECT `user_id`, `email`, `first_name`, `last_name`, `position` FROM `user` WHERE `user_id`=$id");

while ($row=mysqli_fetch_array($res))
{
    $user_idd=$row["user_id"];
    $recipient=$row["email"];
    $fname=$row["first_name"];
    $lname=$row["last_name"];
}
$name= $fname. " " .$lname;
$mailheader = "From:".$name;
$denied_text="Denied";
$message="Your Registration has been Rejected," .$name;

mail($recipient, $denied_text, $message) or die("Error");
?>
<script type="text/javascript">
window.location="approval.php?check=reject";
</script>