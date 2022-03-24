<?php
	// ---- STEP 1: Establish a DB connection

	// Store credentials into variables
	$host = "303.itpwebdev.com";
	$user = "nayeon_db_user";
	$password = "uscItp2022!";
	$db = "nayeon_song_db";

	// Create an instance of the mysqli class. The mysqli class is a PHP extension that will handle connecting and interacting with the database.
	// When we create an instance of this class, mysqli tries to connect to the database using these credentials
	$mysqli = new mysqli($host, $user, $password, $db);

	// Check for database connection errors
	// $mysqli->connect_errno returns an error number if there is one. If there is no error, it will return false.
	if($mysqli->connect_errno) {
		// Display the error message
		echo $mysqli->connect_error;
		// Terminates the program. PHP stops running after this statement so subsequent code does not run.
		exit();
	}

	// ---- STEP 2: Generate & Submit SQL query
	$sql = "SELECT * FROM genres;";

	// echo out sql statement just to double check it looks good
	echo "<hr>" . $sql . "<hr>";

	// Submit this SQL statement to the database. query() method submits the query to the database. it will return a reference to results
	$results = $mysqli->query($sql);

	// $results gives us information about the results, such as num_rows, and not the actual full results.
	var_dump($results);

	// Check that the query() method ran, and we didn't get errors with $results
	// $results will return FALSE if there are any errors
	if(!$results) {
		// display the error msg
		echo $mysqli->error;
		// terminate the program. no need to continue code.
		exit();
	}

	// ---- STEP 3: Display Results
	echo "<hr>";
	echo "Number of results: " . $results->num_rows;

	// fetch_assoc() - fetches one row as an associative array.
	// echo "<hr>";
	// var_dump($results->fetch_assoc());
	// echo "<hr>";
	// var_dump($results->fetch_assoc());

	// fetch_assoc() will return false when it reaches the end of the results
	// $row is a temporary variable that stores the fetch_assoc() value for that iteration of the loop
	while($row = $results->fetch_assoc()) {
		echo "<hr>";
		var_dump($row);
	}

	// Once fetch_assoc() gets to the end of the result list, need to reset the list
	$results->data_seek(0);

	// echo "<hr>";
	// var_dump($results->fetch_assoc());


	// Can query multiple SQL statements
	$sql_media_types = "SELECT * FROM media_types";
	$results_media = $mysqli->query($sql_media_types);
	if(!$results_media) {
		echo $mysqli->error;
		exit();
	}

	// ---- STEP 4: Close the db connection
	$mysqli->close();

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Search Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Song Search Form</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">

		<form action="search_results.php" method="GET">

			<div class="form-group row">
				<label for="name-id" class="col-sm-3 col-form-label text-sm-right">Track Name:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name-id" name="track_name">
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre:</label>
				<div class="col-sm-9">
<select name="genre" id="genre-id" class="form-control">
	<option value="" selected>-- All --</option>

	<?php
		// while( $row = $results->fetch_assoc()) {
		// echo "<option value='" . $row["genre_id"] . "'>" . $row["name"] ."</option>";
		// }
	?>

	<!-- Alternate PHP syntax -->
	<?php while( $row = $results->fetch_assoc() ): ?>
		<option value="<?php echo $row["genre_id"]; ?>">
			<?php echo $row["name"]; ?>
		</option>
	<?php endwhile; ?>

	<!-- <option value='1'>Rock</option>
	<option value='2'>Jazz</option>
	<option value='3'>Metal</option>
	<option value='4'>Alternative & Punk</option>
	<option value='5'>Rock And Roll</option> -->

</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="media-type-id" class="col-sm-3 col-form-label text-sm-right">Media Type:</label>
				<div class="col-sm-9">
					<select name="media_type" id="media-type-id" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- <option value='1'>MPEG audio file</option>
						<option value='2'>Protected AAC audio file</option> -->

						<?php while( $row = $results_media->fetch_assoc() ): ?>
							<option value="<?php echo $row["media_types_id"]; ?>">
								<?php echo $row["name"]; ?>
							</option>
						<?php endwhile; ?>

					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Search</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div> <!-- .container -->
</body>
</html>