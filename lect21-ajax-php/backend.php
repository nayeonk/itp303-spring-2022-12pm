<?php
	$php_array = [
		"first_name" => "Tommy",
		"last_name" => "Trojan",
		"age" => 21,
		"phone" => [
			"cell" => "123-123-1234",

			"home" => "456-456-4567"
		],
	];

	// Anything that is echoed out will be returned to the frontend
	//echo "hello world!";

	// echo can only echo out STRINGS but we will need to send the frontend more complicated data than just a string

	// json_encode() converts a php assoc array into a JSON string.
	// echo json_encode($php_array);

	$host = "303.itpwebdev.com";
	$user = "nayeon_db_user";
	$pass = "uscItp2022!";
	$db = "nayeon_song_db";

	$mysqli = new mysqli($host, $user, $pass, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	$sql = "SELECT * FROM tracks WHERE name LIKE '%" . $_GET["term"] ."%' LIMIT 10;";

	$results = $mysqli->query($sql);
	if ( !$results ) {
		echo $mysqli->error;
		exit();
	}

	// Create an array to store all the data so that it can be sent to the frontend
	$results_array = [];

	while($row = $results->fetch_assoc()) {
		array_push($results_array, $row);
	}
	
	// Convert the results_array into json string so that frontend can read it
	echo json_encode($results_array);

	$mysqli->close();


?>