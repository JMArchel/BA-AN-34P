#db3a34; red
#084c61 blue
#ffc857 yellow-orange
#177e89; light-blue
#323031 grey-black
<a href="profile.php" class="profile-t"><img class="logo" src="profile.png" alt="profile" style="width: 40px; padding-bottom: 8px;"><b><?php echo htmlspecialchars($_SESSION["user_id"]); ?>, Nikka</a>
	

<div class="row">
      <?php
        $res=mysqli_query($conn,"SELECT cases.barangay_name, barangay.barangay_map, COUNT(barangay.barangay_name) AS numbers FROM cases INNER JOIN barangay ON barangay.barangay_name=cases.barangay_name GROUP BY cases.barangay_name;");
        while ($row=mysqli_fetch_array($res))
        {?>
        <div class='card' style='width: 18rem;'>
          <img src='brng/<?php echo $row['barangay_name']; ?>' class='card-img-top' alt='<?php echo $row['barangay_name']; ?>' style='width: 300px;'>
          <div class='card-body'>
            <h5 class='card-title'> <?php echo $row['barangay_name']; ?></h5>
            <p class='badge bg-danger rounded-pill'> <?php echo $row['numbers']; ?></p>
          </div>
        </div>
        <?php }
      ?>
    </div>