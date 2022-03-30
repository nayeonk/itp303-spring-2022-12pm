<?php
// Dump out what the user submitted from add-form.php
var_dump($_POST);

$isInserted = false;

// Check that the user filled out all the required fields
if ( !isset($_POST['track_name']) || 
	empty($_POST['track_name']) || 
	!isset($_POST['media_type']) || 
	empty($_POST['media_type']) || 
	!isset($_POST['genre']) || 
	empty($_POST['genre']) || 
	!isset($_POST['milliseconds']) || 
	empty($_POST['milliseconds']) || 
	!isset($_POST['price']) || 
	empty($_POST['price']) ) {

		$error = "Please fill out all required fields";

}
else {
	// All required fields are filled out. Let's connect to the database and insert this song!

	$host = "303.itpwebdev.com";
	$user = "nayeon_db_user";
	$password = "uscItp2022!";
	$db = "nayeon_song_db";

	$mysqli = new mysqli($host, $user, $password, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	// Write out sql statement

	// Check for optional fields. If user doesn't give certain info, we need to handle it so that the SQL statement does not break

	// album is given
	if( isset($_POST["album"]) && !empty($_POST["album"])) {
		$album_id = $_POST["album"];
	}
	// album is not given
	else {
		$album_id = "null";
	}

	// composer is given
	if( isset($_POST["composer"]) && !empty($_POST["composer"])) {
		$composer = "'" . $_POST["composer"] . "'";
	}
	// composer is not given
	else {
		$composer = "null";
	}

	// bytes is given
	if( isset($_POST["bytes"]) && !empty($_POST["bytes"])) {
		$bytes = $_POST["bytes"];
	}
	// bytes is not given
	else {
		$bytes = "null";
	}

	$sql = "INSERT INTO tracks(name, media_type_id, genre_id, milliseconds, unit_price, album_id, composer, bytes) 
	VALUES('" . $_POST["track_name"] . "',"
	. $_POST["media_type"] . ", "
	. $_POST["genre"] . ", "
	. $_POST["milliseconds"] . ", "
	. $_POST["price"] . ", "
	. $album_id . ", "
	. $composer . ", "
	. $bytes .");";

	// Double check the sql statement. This sql statement is prone to errors so really importnat to double check
	echo "<hr>" . $sql . "</hr>";

	$results = $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}

	// No results will come back for an insert statement. However, we can check $mysqli->affected_rows to see how many rows were inserted

	echo "<hr>";
	echo $mysqli->affected_rows;

	// Using this we can set a boolean to indicate if a new record has been added
	if($mysqli->affected_rows == 1) {
		$isInserted = true;
	}

	// To truly check this song was aded, check the database
	// SELECT * FROM tracks ORDER BY track_id desc;
	// the above sql statement will give you the latest tracks added to the database

	$mysqli->close();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="add_form.php">Add</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Add a Song</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

			<?php if(isset($error) && !empty($error)) :?>
				<div class="text-danger">
					<?php echo $error; ?>
				</div>
			<?php endif; ?>

			
			<?php if($isInserted) :?>
				<div class="text-success">
					<span class="font-italic"><?php echo $_POST["track_name"]?></span> was successfully added.
				</div>
			<?php endif;?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="add_form.php" role="button" class="btn btn-primary">Back to Add Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>