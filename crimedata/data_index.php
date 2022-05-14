<?php
// Initialize the session
session_start();
include 'connection.php';
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$position= ($_SESSION["position"]);
$user_id= ($_SESSION["user_id"]);

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$filename = $_FILES["choosefile"]["name"];
	$tempname = $_FILES["choosefile"]["tmp_name"];  
	$folder = "datafile/".$filename;
	if (move_uploaded_file($tempname, $folder)) {
		echo "placed. thanks";
	}
	$input = $folder;
	$output = 'import.csv';

	if (false !== ($ih = fopen($input, 'r'))) {
		$oh = fopen($output, 'w');

		while (false !== ($data = fgetcsv($ih))) {
			$outputData = array($data[0], $data[1], $data[2], $data[7], $data[9], $data[10], $data[11], $data[13], $data[14], $data[41], $data[42], $data[43], $data[47]);
			fputcsv($oh, $outputData);

		}

		$lines = file("import.csv", FILE_SKIP_EMPTY_LINES );
		$num_rows = count($lines);
		foreach ($lines as $lineNo => $line) {
			$csv = str_getcsv($line);
			if (empty($csv[0] && $csv[1] && $csv[2] && $csv[3] && $csv[4] && $csv[5] && $csv[6] && $csv[7] && $csv[8] && $csv[9] && $csv[10] && $csv[11] && $csv[12])) {
				unset($lines[$lineNo]);
			}
		}
		file_put_contents("import.csv", $lines);
	}
	
	$file = fopen("import.csv", "r");
	while (($row = fgetcsv($file)) !== FALSE) {
		$stmt = $conn->prepare("INSERT INTO `cases`(`case_id`, `date`, `day`, `time`, `barangay_name`, `coordinate_x`, `coordinate_y`, `crime_type_name`, `category_name`, `classification_name`, `status_name`, `solve`, `clear`, `occurence_name`, `user_id`, `create_timestamp`) VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,?,?,$user_id,CURRENT_TIMESTAMP)");
		$stmt->bind_param("sssssssssssss", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[12]);
		$stmt->execute();
	}
}
?>

<html lang="en">
	<head>
        <title>DATA • Dumaguete CDMS</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="img/icon3.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>

	</head>
    <?php include("header.php"); ?>
	<body>
		<div>
			<div>
			<h2 align="center">Data Collection</h2>
		    <!-- Button trigger modal -->
			<h5 align="center"><button type="button" class="btn btn-success col-lg-1" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD DATA</button><h5>

				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<p class="modal-title" id="exampleModalLabel">Place the file</p>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data"> 
								<div class="modal-body">
									<div class="input-group mb-3 ">
										<input type='file' name="choosefile" class="form-control" accept=".csv" required> 
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" name="submit" class="btn btn-primary">Upload Data</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div>
				<table id="employee_grid" class="display" width="100%" cellspacing="0">
					<thead>
						<tr style="background-color: #ed2f38; color: white;">
							<th>#</th>  
							<th>Date</th>
							<th>Day</th>
							<th>time</th>
							<th>Barangay</th>
							<th>X</th>
							<th>Y</th>
							<th>Crime_type</th>
							<th>Category</th>
							<th>Classification</th>
							<th>Status</th>
							<th>Solve</th>
							<th>Clear</th>
							<th>Occurence</th>
							<th>Username</th>
							<th>Imported</th>
						</tr>
					</thead>
			
					<tfoot>
						<tr style="background-color: #ed2f38; color: white;">
							<th>#</th>  
							<th>Date</th>
							<th>Day</th>
							<th>time</th>
							<th>Barangay</th>
							<th>X</th>
							<th>Y</th>
							<th>Crime_type</th>
							<th>Category</th>
							<th>Classification</th>
							<th>Status</th>
							<th>Solve</th>
							<th>Clear</th>
							<th>Occurence</th>
							<th>Username</th>
							<th>Created</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<br>
		<br>
		<br>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	</body>
    <?php include("footer.php"); ?>
</html>

<script type="text/javascript">
$( document ).ready(function() {
	$('#employee_grid').DataTable({
		"bProcessing": true,
        "serverSide": true,
        "ajax":{
            url :"data_index_fetch.php", // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE
            error: function(){
            	$("#employee_grid_processing").css("display","none");
        	}
        }
    });   
});
$('#example').dataTable( {
    language: {
        searchPlaceholder: "Search records"
    }
} );
function add_data(){
	location.href = "data_add.php";
}
var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})
</script>
