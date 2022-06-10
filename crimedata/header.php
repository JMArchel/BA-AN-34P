<?php include 'connection.php';
$position=$_SESSION["position"]; ?>
<header>
	<a href="main.php"><img class="logo" src="img/logo5.svg" style="width: 200px;" alt="logo"></a>
	<nav style="padding-right:140px;">
		<ul class="nav__links">
			<li><a href="main">Home</a></li>
			<li><a href="visualization">Data Visualization</a></li>
			<li><a href="data">Data</a></li>
			<li><a href="list">List</a></li>
			<li><a href="about">About</a></li>
		</ul>
	</nav>
    <button onclick="location.href ='profile';" type="button" class="btn btn-primary position-relative btn-sm" id="but">
		Profile <i class="bi bi-person-circle" style="font-size: 1rem; color: white;"></i>
		<?Php if ($position=="Manager" OR $position=="Supervisor")
			{ ?>
				<?php $res=mysqli_query($conn,"SELECT COUNT(user_id) AS numbers FROM `user` WHERE `approval`=0");
				$row=mysqli_fetch_array($res);
				$rows= $row["numbers"];
					if ($rows >= 1) {
						?> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> <?php echo $row["numbers"]; ?> </span> <?php
					}
				} ?>
		</span>
	</button>
</header>