<?php 

include "connection.php";
$id=$_GET["id"];

session_start();
$user_id= $_SESSION["user_id"];

mysqli_query($conn, "UPDATE `user` SET `approve_reject_timestamp`=CONVERT_TZ(CURRENT_TIMESTAMP,'+00:00','+08:00'),`supervisor_accept_reject`='$user_id',`approval`='1' WHERE `user_id`= $id ");

$res=mysqli_query($conn,"SELECT `user_id`, `email`, `first_name`, `last_name`, `position` FROM `user` WHERE `user_id`=$id");

while ($row=mysqli_fetch_array($res))
{
    $user_idd=$row["user_id"];
    $to=$row["email"];
    $fname=$row["first_name"];
    $lname=$row["last_name"];
}
$name= $fname. " " .$lname;
$mailheader = "From:".$name;
$subject="Approval";
$message="Your Registration has been Approved. \nWelcome " .$name." \n \nYour User ID: ".$user_idd. "\n \n \n \nYou can now Login";
$header= "From:crimedata <confirmation@crimedata.mydatamarker.com>\r\n";
mail($to,$subject,$message,$header) or die("Error");
?>
<script type="text/javascript">
window.location="approval.php?check=approve";
</script>