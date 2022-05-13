<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>ABOUT • Dumaguete CDMS</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="img/icon3.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<?php include("header.php"); ?>
<body>
    <div class="container">
		<center><div class="col-lg-9 title">
			<h3 style="padding-top: 100px;">ABOUT PAGE</h3><b><h1>CRIME DATA MANAGEMENT SYSTEM  </b><?php ' \n ' ?><h2>FOR THE OFFICE OF THE VICE-MAYOR</h2></h1><br>
            <p>
                The <b>Crime Data Management System</b> will enhance the crime recording operations and will be the basis for all actions in the system 
                and can be easily updated and used to aid in all the system’s processes, that is, all the required information is stored. 
                This will also assist our government leaders and law enforcement officers, especially in Dumaguete City in identifying patterns of criminal cases 
                and raising awareness on the given types of criminal acts that most frequently occur in typologically similar parts of the community 
                and to identifying the number of criminal cases in each community of Dumaguete City using an interactive webpage that contains data visualizations and crime analysis.                 
            </p>
		</div>
        <br><br><br>
        <H4>FREQUENTLY ASKED QUESTIONS</H4></center>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Steps in Importing Data
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>
                            The crime interactive website or management system will consist mainly of data and records that
                            Dumaguete City Police Station has provided; the data will be placed in a database.
                            This website will also be customized based on the office's suggestions.
                            For security purposes, the employees or people of the vice mayor can access the website after registering their name and password.
                            Data visualization outputs will also be shown in the system, such as heat maps, bar charts, and line graphs
                            since these are convenient to view and understand the trends or patterns of information.
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Steps in Importing Data
                </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>
                            <b>Step 1:</b> Collect data from Dumaguete City Police Station. Preferably in excel form.<br>
                            <b>Step 2:</b> Change columns date and time to same format.<br>
                            How to change format:
                            Left click on selected column and select format cells.
                            For the date column, category is Date with type (year-month-day) or (e.g. 2012-03-14)
                            For the time column, category is Time with type (hour-minute-second) or (e.g. 13:30:55)<br>
                            <b>Step 3:</b> Convert excel file to csv.<br>
                            <b>Step 4:</b> Import data from the csv file to the database.
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Who Made this System?
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>
                            As part of the Business Analytics Students Society of Silliman  University's course requirement, 
                            the students made this for the Office of the Vice Mayor. 
                        </p>
                    </div>
                </div>
            </div>
        </div><br><br>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card h-100">
                <div class="card-header text-center">Objectives</div>
                <div class="card-body">
                    <p class="card-text">The Data Crime Management System will enhance the crime recording operations and will be the basis for all actions in the sysem and can be easily updated and used to aid in all the system’s processes, that is, all the required information is stored. This will also assist our government leaders and law enforcement officers, especially in Dumaguete City in identifying patterns of criminal cases and raising awareness on the given types of criminal acts that most frequently occur in typologically similar parts of the community and to identifying the number of criminal cases in each community of Dumaguete City using an interactive webpage that contains data visualizations and crime analysis.  Another objective of the project is to establish a baseline analysis and formulate models that are suited to the system’s structure. Furthermore, the correctness of the centralized  database will allow functionssuch as crime report generation and statistical analysis of crime data.</p>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                <div class="card-header text-center">Scope and Limitations</div>
                <div class="card-body">
                    <p class="card-text">The main scope of the project is to develop a web-based crime data system that is easily accessible to users The scope of the project also includes crime data records for the last 3 years up to the recent. Through the system, proper safekeeping of data is provided and ensures data accuracy to generate crime data reports through the form of data visualization. Even though this project focuses on a crime data system, it doesn’t include confidential information such as the name, age, and gender of the perpetrators and victims. It also doesn’t include real-time data but near real-time data due to the main source being secondary. As a web-based system, it cannot be accessed without an internet connection.</p>
                </div>
                </div>
            </div>
        </div><br>
        <div class="card mb-3 col-lg-7 border-light" style="margin: 0 auto;">
            <div class="row g-0">
                <div class="card-header text-center">Creators of the Project</div>
                <div class="col-md-5">
                <img src="img/friends.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-7">
                <div class="card-body">
                    <p class="card-text">
                        · ANDRES, Shekinah<br>
                        · AMIL, Derrick Thomas<br>
                        · FELISILDA, Josemaria Archel<br>
                        · GESLANI, Daniela<br>
                        · LITUANAS, Eunice Mel<br>
                        · SERILO, Nikka Marae Leonore</p>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div><br>
    <div class="row foot" style="padding:20px 50px 0px 30px">
        <div class="col-lg-9">
			<h3><img src='img/logo5.svg' alt="logo" style="width: 300px;"></h3>
			<h5 style="padding-top:10px; font-size: 15px;">· Time · Day · Barangay · Crime · Occurence · Contact ·</h5>
		</div>
        <div class="col-lg-1"><p>Have more questions?</p><h4 style="padding-top:8px; font-size:20px">Contact Us</h4></div>
		<div class="col-lg-2">
            <form>
                <div class="mb-3">
                    <input type="email" class="form-control input-sm" placeholder="<?php echo htmlspecialchars($_SESSION["email"]); ?>" disabled>
                </div>
                <div class="mb-3">
                    <textarea name="message" class="form-control input-sm" placeholder="Message" rows="2"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
	</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php include("footer.php"); ?>
</html>