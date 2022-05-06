
<?php
	//include connection file 
	include_once("connection.php");
	 
	// initilize all variable
	$params = $columns = $totalRecords = $data = array();

	$params = $_REQUEST;

	//define index of column
	$columns = array( 
		0 =>'case_id',
		1 => 'date', 
		2 => 'day',
		3 => 'time', 
		4 => 'barangay_name',
		5 => 'coordinate_x', 
		6 => 'coordinate_y',
		7 => 'crime_type_name', 
		8 => 'category_name',
		9 => 'classification_name', 
		10 => 'status_name',
		11 => 'solve',
		12 => 'clear', 
		13 => 'occurence_name',
		14 => 'user_name',
		15 => 'create_timestamp'
	);

	$where = $sqlTot = $sqlRec = "";

	// check search value exist
	if( !empty($params['search']['value']) ) {   
		$where .=" WHERE ";
		$where .=" ( date LIKE '%".$params['search']['value']."%' ";    
		$where .=" OR day LIKE '".$params['search']['value']."%' ";
		$where .=" OR time LIKE '".$params['search']['value']."%' ";
		$where .=" OR barangay_name LIKE '%".$params['search']['value']."%' ";
		$where .=" OR coordinate_x LIKE '".$params['search']['value']."%' ";
		$where .=" OR coordinate_y LIKE '".$params['search']['value']."%' ";
		$where .=" OR crime_type_name LIKE '".$params['search']['value']."%' ";
		$where .=" OR category_name LIKE '".$params['search']['value']."%' ";
		$where .=" OR classification_name LIKE '%".$params['search']['value']."%' ";
		$where .=" OR status_name LIKE '%".$params['search']['value']."%' ";
		$where .=" OR occurence_name LIKE '%".$params['search']['value']."%' ";
		$where .=" OR first_name LIKE '".$params['search']['value']."%' ";
		$where .=" OR last_name LIKE '".$params['search']['value']."%' )";
	}

	// getting total number records without any search
	$sql = "SELECT `case_id`,`date`,`day`,`time`,`barangay_name`,`coordinate_x`,`coordinate_y`,`crime_type_name`,`category_name`,`classification_name`,`status_name`,`solve`,`clear`,`occurence_name`, CONCAT(user.first_name,' ', user.last_name) AS user_name ,cases.create_timestamp
	FROM cases INNER JOIN user ON user.user_id= cases.user_id ";
	$sqlTot .= $sql;
	$sqlRec .= $sql;
	//concatenate search sql if value exist
	if(isset($where) && $where != '') {

		$sqlTot .= $where;
		$sqlRec .= $where;
	}


 	$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";

	$queryTot = mysqli_query($conn, $sqlTot) or die("database error:". mysqli_error($conn));


	$totalRecords = mysqli_num_rows($queryTot);

	$queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch case data");

	//iterate on results row and create new index array of data
	while( $row = mysqli_fetch_row($queryRecords) ) { 
		$data[] = $row;
	}	

	$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"data"            => $data   // total data array
			);

	echo json_encode($json_data);  // send data as json format
?>
	