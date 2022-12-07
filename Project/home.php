<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="./style.css">
    <title>HOME • Project 101</title>
    <link rel = "icon" href ="imgs/house-door-fill.svg">
</head>
<?php include("header.php"); ?>
<body>
	<div class="container">
		<center><h1 style="padding: 7.5rem 0 0 0;">Project</h1>
        <h2 style="padding: 0 0 1rem 0;">101</h2></center>
        
        <div class="row">
            <div class="col-sm-4">
                <div class="wrapper">
                    <div class="card front-face" style="padding: 0;">
                        <img src="./imgs/1.svg" alt="Flip Card">
                    </div>
                    <div class="card back-face">
                        <img src="./imgs/kazuha.jpg" class="card-img-top" alt="..." style="border: 0px;">
                        <div class="card-body">
                        <h5 class="card-title text-center" style="padding-bottom: 0.3rem;">Rock-Paper-Scissors ML</h5>
                        <p class="card-text text-justify" style="text-justify: inter-word">The computer calculates the conditional probabilities of you selecting each of the three things based on the object you chose last. The computer always chooses the thing that it believes you are more likely to choose.</p>
                        <div class="d-grid d-md-flex justify-content-md-end">
                            <a href="./rock-paper-scissor.php" class="btn press below">Go inside</a>
                        </div></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="wrapper">
                <div class="card front-face" style="padding: 0;">
                    <img src="./imgs/2.svg" alt="Flip Card">
                </div>
                <div class="card back-face">
                    <img src="./imgs/yeji.jpg" class="card-img-top" alt="..." style="border: 0px;">
                    <div class="card-body">
                    <h5 class="card-title text-center" style="padding-bottom: 0.3rem;">Reverse Logistics: Bottle Collecting Project</h5>
                    <p class="card-text">Through this project proposal paper, we hope to convince Silliman University, beverage-bottling companies, LGUs, and NGOs to support and partner with the project team in this environmental initiative.</p>
                    <div class="d-grid d-md-flex justify-content-md-end">
                        <a href="https://docs.google.com/document/d/1f5-IDJ4tLzVsrmRSw649VW1cv9bH2_M-MN-QL6C91uY/edit" class="btn press below">Go inside</a>
                    </div></div>
                </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="wrapper">
                <div class="card front-face" style="padding: 0;">
                    <img src="./imgs/3.svg" alt="Flip Card">
                </div>
                <div class="card back-face">
                    <img src="./imgs/bang.jpg" class="card-img-top" alt="..." style="border: 0px;">
                    <div class="card-body">
                    <h5 class="card-title text-center" style="padding-bottom: 0.3rem;">Automated Loan Amortization Scheduler</h5>
                    <p class="card-text">Fixed payment amount to a specified date each calendar month that are used to pay off both interest and the principal amount.</p>
                    <div class="d-grid d-md-flex justify-content-md-end">
                        <a href="./amortization.php" class="btn press below">Go inside</a>
                    </div></div>
                </div>
                </div>
            </div>
        </div>
	</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>