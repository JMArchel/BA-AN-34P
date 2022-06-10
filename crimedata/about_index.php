<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email= $_SESSION['email'];
    $name=$_SESSION['first_name'];
    $txt =$_POST['message'];

    
$subject="Inquiry";
$to = "inquiry@crimedata.mydatamarker.com, josemariagfelisilda@su.edu.ph, danielaugeslani@su.edu.ph, shekinahtandres@su.edu.ph, derrickamil@su.edu.ph, nikkavserilo@su.edu.ph, euniceglituanas@su.edu.ph ";
$header= "From:".$name."<".$email.">\r\n";


mail($to,$subject,$txt,$header)
or die("Error");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>ABOUT • Dumaguete CDMS</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/icon3.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
            <p style="font-family: 'Vollkorn', serif; font-weight:600; margin-bottom:-.75em; color:#ED3030; font-size: 2em;">About Page</p>
            <b><h1>CRIME DATA MANAGEMENT</b><br>
            <b>FOR THE OFFICE OF THE VICE MAYOR</h1></b><br>
            <p>
                The <b>Crime Data Management System</b> will enhance the crime recording operations and will be the basis for all actions in the system 
                and can be easily updated and used to aid in all the system’s processes, that is, all the required information is stored. 
                This will also assist our government leaders and law enforcement officers, especially in Dumaguete City in identifying patterns of criminal cases 
                and raising awareness on the given types of criminal acts that most frequently occur in typologically similar parts of the community 
                and to identifying the number of criminal cases in each community of Dumaguete City using an interactive webpage that contains data visualizations and crime analysis.                 
            </p>
		</div></center>
        <br><br><br>
    </div>
    <div class="container">
        <h3 class="text-center">FREQUENTLY ASKED QUESTIONS</h3>
        <div class="row d-flex justify-content-center">
            <div class="accordion col-lg-9" id="accordionExample">

                <div class="accordion-item shadow" style="padding:0em;">
                    <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        What are the contents of this system?
                    </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                                The <strong>crime interactive website</strong> or <strong>management system</strong> will consist mainly of data and records that
                                Dumaguete City Police Station has provided; the data will be placed in a database.
                                This website will also be customized based on the office's suggestions.
                                For security purposes, the employees or people of the vice mayor can access the website after registering their name and password.
                                Data visualization outputs will also be shown in the system, such as heat maps, bar charts, and line graphs
                                since these are convenient to view and understand the trends or patterns of information.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item shadow" style="padding:0px;">
                    <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Steps in Importing Data
                    </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                                <b>Step 1:</b> Collect data from Dumaguete City Police Station. Preferably in excel form.<br>
                                <b>Step 2:</b> Change columns date and time to same format.<br><br>
                                <b><i>How to change format</i></b>:<br>
                                Left click on column "DateComtd" and select format cells.<br>
                                <img src="img/steps/1.png" class="card-img-top" style="max-width:100em;"><br><br>
                                For the date column, category is Date with type (year-month-day) or (e.g. 2012-03-14) and press "OK".<br>
                                <img src="img/steps/2.png" class="card-img-top" style="max-width:100em;"><br><br>
                                Left click on column "TimeComtd" and select format cells.<br>
                                <img src="img/steps/3.png" class="card-img-top" style="max-width:100em;"><br><br>
                                For the time column, category is Time with type (hour-minute-second) or (e.g. 13:30:55) and press "OK".<br>
                                <img src="img/steps/4.png" class="card-img-top" style="max-width:100em;"><br><br>
                                <b>Step 3:</b> Convert excel file to csv.<br>
                                <img src="img/steps/5.png" class="card-img-top" style="max-width:100em;"><br><br>
                                <b>Step 4:</b> Lastly, import data from the csv file to the database.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item shadow" style="padding:0em;">
                    <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Who Made this System?
                    </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                                As part of the <strong>Business Analytics Students' Society</strong> of Silliman  University's course requirement, 
                                the students made this for the Office of the Vice Mayor. 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-9" style="margin: auto;">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100">
                    <img src="img/about-1.jpg" class="card-img-top" alt="scopelimitation" style="height: 8em; object-fit: cover;">
                    <div class="card-body">
                        <h3 class="card-title text-center">Scope & Limitation</h3>
                        <p class="card-text" style="text-align: justify;">The main scope of the project is to develop a web-based crime data system that is easily accessible to users The scope of the project also includes crime data records for the last 3 years up to the recent. Through the system, proper safekeeping of data is provided and ensures data accuracy to generate crime data reports through the form of data visualization. Even though this project focuses on a crime data system, it doesn’t include confidential information such as the name, age, and gender of the perpetrators and victims. It also doesn’t include real-time data but near real-time data due to the main source being secondary. As a web-based system, it cannot be accessed without an internet connection.</p>                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                    <img src="img/about-2.png" class="card-img-top" alt="objectives" style="height: 8em; object-fit: cover;">
                    <div class="card-body">
                        <h3 class="card-title text-center">Objectives</h3>
                        <p class="card-text" style="text-align: justify;">The Data Crime Management System will enhance the crime recording operations and will be the basis for all actions in the sysem and can be easily updated and used to aid in all the system’s processes, that is, all the required information is stored. This will also assist our government leaders and law enforcement officers, especially in Dumaguete City in identifying patterns of criminal cases and raising awareness on the given types of criminal acts that most frequently occur in typologically similar parts of the community and to identifying the number of criminal cases in each community of Dumaguete City using an interactive webpage that contains data visualizations and crime analysis.  Another objective of the project is to establish a baseline analysis and formulate models that are suited to the system’s structure. Furthermore, the correctness of the centralized  database will allow functionssuch as crime report generation and statistical analysis of crime data.</p>
                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                    <img src="img/about-3.jpg" class="card-img-top" alt="acknowledgement" style="height: 8em; object-fit: cover;">
                    <div class="card-body">
                        <h3 class="card-title text-center">Acknowledgement</h3>
                        <p class="card-text" style="text-align: justify;">The Business Analytics Students' Society would like to acknowledge and thank Attorney Karissa Faye R. Tolentino-Maxino and her office for allowing them to create a Dumaguete Crime Data Management System during their third year at Silliman University. She welcomed the students' thoughts and listened to their plans. Attorney Karissa's time and effort contributed to their course requirement's success.</p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card mb-3 col-lg-5 border-light" style="margin: 0 auto;">
            <div class="row g-0">
                <div class="card-header text-center"><h4 style="color:#ED3030; margin-bottom:0em;"><i class="bi bi-people-fill"></i> Creators of the Project</h4></div>
                <div class="col-md-5">
                    <img src="img/friends.png" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <p class="card-text">

                            · <b>LITUANAS</b>, Eunice Mel<br>
                            · <b>ANDRES</b>, Shekinah<br>
                            · <b>FELISILDA</b>, Josemaria Archel<br>
                            · <b>AMIL</b>, Derrick Thomas<br>
                            · <b>GESLANI</b>, Daniela<br>
                            · <b>SERILO</b>, Nikka Marae Leonore</p>
                            <p>from left to right</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row foot" style="padding:20px 50px 0px 30px; height: 18em;">
        <div class="col-lg-8">
			<h3><img src='img/logo5.svg' alt="logo" style="width: 300px;"></h3>
			<h5 style="padding-top:10px; font-size: 15px;">· Time · Day · Barangay · Crime · Occurence · Contact ·</h5>
		</div>
        <div class="col-lg-1"><p>Have more questions?</p><h4 style="padding-top:8px; font-size:20px">Contact Us</h4></div>
		<div class="col-lg-2">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="mb-3">
                    <input type="email" class="form-control input-sm" placeholder="<?php echo htmlspecialchars($_SESSION["email"]); ?>" disabled style="width:25em;">
                    <input type="email" class="form-control input-sm" placeholder="<?php echo htmlspecialchars($_SESSION["email"]); ?>" hidden>
                    <input type="name" class="form-control input-sm" placeholder="<?php echo ($_SESSION["first_name"])," ", ($_SESSION["last_name"]); ?>" hidden>
                </div>
                <div class="mb-4">
                    <textarea name="message" class="form-control input-sm" placeholder="Message" rows="2" style="width:25em;"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
	</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php include("footer.php"); ?>
</html>