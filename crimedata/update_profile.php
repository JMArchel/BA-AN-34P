<?php
session_start();
include "connection.php";
$user_id =htmlspecialchars($_SESSION["user_id"]);
$image_name =htmlspecialchars($_SESSION["image_name"]);
if(isset($_POST['update_profile'])){

   $update_first_name = mysqli_real_escape_string($conn, $_POST['update_first_name']);
   $update_last_name = mysqli_real_escape_string($conn, $_POST['update_last_name']);
   $update_position = mysqli_real_escape_string($conn, $_POST['update_position']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $update_image = mysqli_real_escape_string($conn, $_POST['update_image']);

   $chos= "UPDATE `user` SET first_name = '$update_first_name', last_name = '$update_last_name', position = '$update_position', email = '$update_email', image_name = '$update_image' WHERE user_id = '$user_id'";
   mysqli_query($conn, $chos) or die('query failed');

   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `user` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if (isset($_POST['submit'])) {
      $file = $_FILES['file'];
  
      $fileName = $_FILES['file'] ['name'];
      $fileTmpName = $_FILES['file'] ['tmp_name'];
      $fileSize = $_FILES['file'] ['size'];
      $fileError = $_FILES['file'] ['error'];
      $fileType = $_FILES['file'] ['type'];
  
  
      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));
  
      $allowed = array('jpg', 'jpeg', 'png', 'pdf');
   }
      if (!empty($update_image)){
         if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
               if ($fileSize < 1000000) {
                     $fileNameNew = $user_id.".".$fileActualExt;
                     $fileDestination = 'uploads/'.$fileNameNew;
                     move_uploaded_file($fileTmpName, $fileDestination);
                     header("Location: index.php?uploadsucces");
         
               } else {
                     echo "Your file is too big!";
               }
               
            } else {
               echo "There was an error uploading your file!";
            }
   
         } else {
            echo "You cannot upload files of this type!";
         }
      }
  }
?>
<!DOCTYPE html>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <link rel="icon" type="image/png" href="img/icon3.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <title>update profile</title>
</head>
<?php include("header.php"); ?>
<body>
   
   <div class="update-profile">

      <?php
         $select = mysqli_query($conn, "SELECT * FROM `user` WHERE user_id =$user_id") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
      ?>

      <form action="" method="post" enctype="multipart/form-data">
         <div class="flex">
            <div class="inputBox">
               <span>Firstname :</span>
               <input type="text" name="update_first_name" value="<?php echo $fetch['first_name']; ?>" class="box">
               <span>Lastname :</span>
               <input type="text" name="update_last_name" value="<?php echo $fetch['last_name']; ?>" class="box">
               <span>your email :</span>
               <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
               <span>position :</span>
               <input type="text" name="update_position" value="<?php echo $fetch['position']; ?>" class="box">
               <span>update your pic :</span>
               <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
            </div>
            <div class="inputBox">
               <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
               <span>old password :</span>
               <input type="password" name="update_pass" placeholder="enter previous password" class="box">
               <span>new password :</span>
               <input type="password" name="new_pass" placeholder="enter new password" class="box">
               <span>confirm password :</span>
               <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
            </div>
         </div>
         <input type="submit" value="update profile" name="update_profile" class="btn">
         <a href="main.php" class="delete-btn">go back</a>
      </form>

   </div>

</body>
<?php include("footer.php"); ?>
</html>