<?php
	// ---- STEP 1: Establish a DB connection

	// Store credentials into variables
	$host = "303.itpwebdev.com";
	$user = "nayeon_db_user";
	$password = "uscItp2022!";
	$db = "nayeon_song_db";

	$mysqli = new mysqli($host, $user, $password, $db);

	if($mysqli->connect_errno) {
		// Display the error message
		echo $mysqli->connect_error;
		// Terminates the program. PHP stops running after this statement so subsequent code does not run.
		exit();
	}
	$mysqli->set_charset("utf8");

	// ---- STEP 2: Generate & Submit SQL query
	$sql = "SELECT tracks.name AS track, genres.name AS genre, media_types.name AS media
	FROM tracks
	JOIN genres
		ON tracks.genre_id = genres.genre_id
	JOIN media_types
		ON tracks.media_type_id = media_types.media_type_id
	WHERE 1 = 1";

	// If track name is given as search criteria, append track name to the base sql statement
	// $_GET stores all the input that the user gave us
	var_dump($_GET);

	if( isset($_GET["track_name"]) && !empty($_GET["track_name"]) ) {
		$sql = $sql . " AND tracks.name LIKE '%" .$_GET["track_name"] . "%'";
	}

	if( isset($_GET["genre"]) && !empty($_GET["genre"]) ) {
		$sql = $sql . " AND tracks.genre_id = " . $_GET["genre"];
	}

	if( isset($_GET["media_type"]) && !empty($_GET["media_type"]) ) {
		$sql = $sql . " AND tracks.media_type_id = " . $_GET["media_type"];
	}

	$sql = $sql . ";";
	// before querying the statement, double check that sql statement looks good
	echo "<hr>" . $sql . "<hr>";
	
	// submit the query
	$results= $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->close();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<h1 class="col-12 mt-4">Song Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
	<div class="container-fluid">
		<div class="row mb-4 mt-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">

				Showing 2 result(s).

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>Track</th>
							<th>Genre</th>
							<th>Media Type</th>
						</tr>
					</thead>
					<tbody>

						<?php while($row = $results->fetch_assoc()) : ?>
							<tr>
								<td><?php echo $row["track"]; ?> </td>
								<td><?php echo $row["genre"]; ?></td>
								<td><?php echo $row["media"]; ?></td>
							</tr>
						<?php endwhile; ?>

					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
</body>
</html>