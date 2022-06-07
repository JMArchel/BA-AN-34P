<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login");
    exit;
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title>HOME • Dumaguete CDMS</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="img/icon3.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>     
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&family=Vollkorn:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
</head>
<?php include("header.php"); ?>
<body>
	<div class="container">
		<center><div class="col-lg-9 title">
			<p style="font-family: 'Vollkorn', serif; font-weight:600; margin-bottom:-.75em; color:#ED3030; font-size: 2em;">Welcome to</p><b><h1>DUMAGUETE CRIME DATA</b><br><b>MANAGEMENT SYSTEM</h1></b><br>
			<p>The goal of the <strong>Crime Database Management System</strong> is to automate the existing manual system and convert it into a web-based system with data visualizations,
			thereby meeting the need for convenient tracking for <strong>all users from the Office of the Vice Mayor</strong>. The information gathered from the
			police station is secure and can be kept on hand for an extended period of time. This project makes use of the PHP, HTML, CSS, Bootstrap, and Python programming languages.</b></p><br><br>
			<p style="font-size: 1.5em;"> Hello,<b> <?php echo ucwords(htmlspecialchars($_SESSION["first_name"])); ?> <?php echo ucwords(htmlspecialchars($_SESSION["last_name"])); ?></b> <a href="logout.php" class="btn btn-danger btn-sm">Logout</a></p>
		</div></center>
	</div>
	<div class="container"><center>
		<p style="font-size:1.75em; margin-bottom:-.5em; color:#ED3030; font-family: 'Vollkorn', serif;">City of</p>
		<h2>GENTLE PEOPLE</h2>
		<div class="row align-items-center">
			<div class="col-1">
                <?php echo "&nbsp&nbsp&nbsp" ?>
            </div>
			<div class="col-1">
				<a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">
					<i class="fa fa-arrow-left"></i>
				</a>
			</div>	
			<div class="col-8">
				<div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<div class="row">
								<div class="col-md-4 mb-3">
									<div class="card">
										<img class="img-fluid" src="img/main-01.png">
									</div>
								</div>
								<div class="col-md-4 mb-3">
									<div class="card">
										<img class="img-fluid" src="img/main-02.png">
									</div>
								</div>
								<div class="col-md-4 mb-3">
									<div class="card">
										<img class="img-fluid" src="img/main-03.png">
									</div>
								</div>
							</div>
						</div>
						<div class="carousel-item">
							<div class="row">
								<div class="col-md-4 mb-3">
									<div class="card">
										<img class="img-fluid" src="img/main-04.png">
									</div>
								</div>
								<div class="col-md-4 mb-3">
									<div class="card">
										<img class="img-fluid" src="img/main-05.png">
									</div>
								</div>
								<div class="col-md-4 mb-3">
									<div class="card">
										<img class="img-fluid" src="img/main-06.png">
									</div>
								</div>
							</div>
						</div>
						<div class="carousel-item">
							<div class="row">
								<div class="col-md-4 mb-3">
									<div class="card">
										<img class="img-fluid" src="img/main-07.png">
									</div>
								</div>
								<div class="col-md-4 mb-3">
									<div class="card">
										<img class="img-fluid" src="img/main-08.png">
									</div>
								</div>
								<div class="col-md-4 mb-3">
									<div class="card">
										<img class="img-fluid" src="img/main-09.png">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-1">
				<a class="btn btn-primary mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next">
					<i class="fa fa-arrow-right"></i>
				</a>
			</div>	
			<div class="col-1">
                <?php echo "&nbsp&nbsp&nbsp" ?>
            </div>
			<center>
				<a href="https://dumaguetecity.gov.ph/history/#:~:text=%E2%80%9CDumaguete%E2%80%9D%20was%20coined%20from%20the,visitors%2C%20both%20local%20and%20foreign." class="btn btn-primary btn-sm" target="_blank"  style="color: white;">Source</a>
				<div class="col-lg-8 title">
					<p style="text-align: justify; text-indent: 3em;">“Dumaguete” was coined from the Cebuano word dagit, which means “to snatch”. The word dumaguet, meaning “to swoop”, was coined because of frequent raids by Moro 
						pirates on this coastal community and its power to attract and keep visitors, both local and foreign. In 1572, Diego López Povedano indicated the place as Dananguet, 
						but cartographer Pedro Murillo Velarde in 1734 already used present name of Dumaguete for the settlement.</p><br>

					<p style="text-align: justify; text-indent: 3em;">Dumaguete, officially City of Dumaguete (Cebuano: Dakbayan sa Dumaguete; Hiligaynon: Dakbanwa/Syudad sang Dumaguete; Filipino: Lungsod ng Dumaguete) and often referred
						to as Dumaguete City, is a component city in the Philippines. It is the capital of the province of Negros Oriental. Having a total of 131,377 inhabitants as of 2015 census,
						it is the most populous city in the province. The city is nicknamed The City of Gentle People.</p><br>

					<p style="text-align: justify; text-indent: 3em;">Dumaguete is referred to as a university city because of the presence of four universities and a number of other colleges where students of the province converge to enroll
						for tertiary education. The city is also a popular educational destination for students of surrounding provinces and cities in Visayas and Mindanao. The city is best known for
						Silliman University, the country’s first Protestant university and the first American university in Asia. There are also 18 public elementary schools and 8 public high schools.
						The city’s student population is estimated at 30,000.</p><br>

					<p style="text-align: justify; text-indent: 3em;">Dumaguete attracts a considerable number of foreign tourists, particularly Europeans, because of easy access from Cebu City in Central Visayas, the availability of beach resorts
						and dive sites, the attraction of dolphin and whale watching in nearby Bais City. Dumaguete is listed 5th in Forbes Magazine’s “7 Best Places to Retire Around the World”.</p><br>

					<p style="text-align: justify; text-indent: 3em;">The power source of the city comes from the geothermal power plant in Palinpinon, Valencia. The city has redundant fiber optic lines and is a focal point for telecommunications.
						It is the landing point for fiber optic cables linking it to the whole Visayas, Manila (the capital of the nation) and cities south of Luzon, as well as to other cities north of
						Mindanao.</p><
				</div>
			</center>
		</div></center>
	</div>
</body>
<?php include("footer.php"); ?>
</html>