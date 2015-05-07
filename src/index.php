<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include 'storedInfo.php';

/*Code obtained from lecture to access my database and can be seen on: 
http://php.net/manual/en/mysqli.quickstart.prepared-statements.php*/
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "chanal-db", $myPassword, "chanal-db");
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
	echo "MySQL connection established!<br>";
}
///////////*WILL REMOVE MYSQL ERROR  OUTPUTS BEFORE SUBMISSION*/////////////////////////////////////

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>PHP-Assignment-2</title>
	</head>
<body>
	<fieldset>
		<form name="add_form" method="post">
			<label>Video Name: </label>
			<input type="text" name="video_name">
			<label>Video Category: </label>
			<input type="text" name="video_cat">
			<label>Video Length: </label>
			<input type="number" name="video_len">
			<p><input type="submit" value="Add Video" name="add_video" /></p>
		</form>
	</fieldset>

<?php 
	if (isset($_POST['add_video'])) {
		/*Checks that name, category, length are all set*/
		if (empty($_POST['video_name'])) {
			echo 'Video name cannot be empty<br><br>';
		}
		/* 	CATEGORY IS NOT A REQUIRED INPUT THEREFORE DO NOT NEED THIS STATEMENT
		if (empty($_POST['video_cat'])) {
			echo 'Video category cannot be empty<br><br>';
		}
		*/
		if ($_POST['video_len'] < 0) {
			echo 'Video length cannot be less than 0<br><br>';
		}
		/*Assigns the name, category and length to variables if all criteria
		were met in the form entry*/
		if ((!empty($_POST['video_name']) && !empty($_POST['video_cat']) && 
			!(empty($_POST['video_len']) || $_POST['video_len'] < 0))) {
			$vid_name = $_POST['video_name'];
			$vid_cat = $_POST['video_cat'];
			$vid_len = $_POST['video_len'];

			/*Referred to prepared statements on 
			http://php.net/manual/en/mysqli.quickstart.prepared-statements.php*/

			/* Prepared statement, stage 1: prepare from */
			if (!($stmt = $mysqli->prepare('INSERT INTO video_store(name, category, length) VALUES (?, ?, ?)'))) {
    			echo 'Prepare failed<br><br>';
			}
			
			/* Prepared statement, stage 2: bind and execute */
			if (!($stmt->bind_param('ssi', $vid_name, $vid_cat, $vid_len))) {
			    echo 'Binding parameters failed<br><br>';
			}
			if (!($stmt->execute())) {
//////////////echo 'Execute failed<br><br>'; IT WORKS, WILL DISPLAY MESSAGE IF A DUPLICATE VIDEO NAME IS ENTERED WHICH THE ERROR MESSAGE SHOWS
    			echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			}
		}
	}

	/*Referred to prepared statements on http://php.net/manual/en/mysqli.quickstart.prepared-statements.php*/
	$out_category = NULL;

	if (!$stmt = $mysqli->prepare("SELECT category FROM video_store GROUP BY category")) {
		echo 'Prepare failed';
	}

	if (!($stmt->execute())) {
//////////////echo 'Execute failed<br><br>'; IT WORKS, WILL DISPLAY MESSAGE IF A DUPLICATE VIDEO NAME IS ENTERED WHICH THE ERROR MESSAGE SHOWS
    	echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	if (!$stmt->bind_result($out_category)) {
		echo 'Binding output parameters failed';
	}

	echo '<form name="category_list" method="POST">
		<select name="Categories">
			<option value="All">All Movies</option>';

			while ($stmt->fetch()) {
				echo "<option value= $out_category'>$out_category</option>";
			}
	echo '</select>
	<input type="submit" value="Filter" />
	</form>';

	echo '<form name="delete_all" method="POST" action="delete.php">
		<input type="submit" value="Delete All Videos">
		</form>';




?>




</body>
</html>