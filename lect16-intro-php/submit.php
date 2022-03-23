<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Intro to PHP</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Intro to PHP</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4 mb-3">PHP Output</h2>

<div class="col-12">
	<!-- Display Test Output Here -->
	<?php
		echo "Hello World!";
		echo "<strong>Hi!!</strong>";
		echo "<hr>";

		// Variables
		$name = "Tommy";
		$age = 18;

		// Can utilize variable interpolation with double quotes
		echo "My name is $name";
		// concatenate strings with period in PHP
		echo "<hr>";
		echo "My name is \"" . $name;
		echo "<hr>";
		// Single quotes are literal strings
		echo 'My name is $name';

		echo "<hr>";

		// ---- DATE/TIME
		// set the timezone we want to work with
		date_default_timezone_set("America/Los_Angeles");

		// Display the current date/time
		echo date("m-d-y H:i");

		// ---- ARRAYS & LOOPS

		echo "<hr>";
		// Create an array
		$colors = ["red", "blue", "green"];
		echo $colors[0];
		echo "<hr>";

		// loops
		for( $i = 0; $i < sizeof($colors); $i++) {
			echo $colors[$i];
		}

		echo "<hr>";

		// foreach loops
		foreach( $colors as $c) {
			echo $c;
		}

		// ---- ASSOCIATIVE ARRAYS
		// An array with string keys & value pairs
		$courses = [
			"ITP 303" => "Full-stack Web Development",
			"ITP 404" => "Advanced Front-End Web Development",
			"ITP 405" => "Advanced Back-End Web Development"
		];
		echo "<hr>";
		// Can get values by string key
		echo $courses["ITP 303"];
		echo "<hr>";

		// foreach loop to iterate through an assoc array
		foreach($courses as $courseName) {
			echo $courseName;
			echo "<br>";
		}

		echo "<hr>";
		// show both the key & value of assoc array
		foreach($courses as $courseNumber => $courseName) {
			echo "$courseNumber: $courseName";
			echo "<br>";
		}

		echo "<hr>";
		// A useful method to dump out what you are working with
		var_dump($courses);
		echo "<hr>";

		// ---- SUPERGLOBALS
		// superglobal variable is always available and uses a $_ prefix
		var_dump($_SERVER);
		echo "<hr>";
		echo $_SERVER["HTTP_HOST"];

		// Two other superglobal variables that are useful for submitting forms.
		echo "<hr>";
		echo "GET superglobal here: <br/>";
		var_dump($_GET);

		echo "<hr>";
		echo "POST superglobal here: <br/>";
		var_dump($_POST);

	?>
</div>

		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4">Form Data</h2>

		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-3 text-right">Name:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				<?php 
					// Handle if user input is empty
					// isset() does this variable even exist? returns true or false
					// empty() is the variable empty (blank?)
					if( isset($_POST["name"]) && !empty($_POST["name"])) {
						echo $_POST["name"];
					}
					else {
						echo "<div class='text-danger'>Not provided.</div>";
					}
					 
				?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Email:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				<?php echo $_POST["email"]; ?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Current Student:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subscribe:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				<?php
					if( isset($_POST["subscribe"]) && !empty($_POST["subscribe"])) {
						// Foreach loop to iterate
						foreach ( $_POST["subscribe"] as $sub ) {
							echo $sub . ", ";
						}
					}
					else {
						// class text-danger is coming from bootstrap
						echo "<div class='text-danger'>Not provided.</div>";
					}
				?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subject:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Message:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->

		<div class="row mt-4 mb-4">
			<a href="form.php" role="button" class="btn btn-primary">Back to Form</a>
		</div> <!-- .row -->

	</div> <!-- .container -->
	
</body>
</html>