<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include 'storedInfo.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<!--Referred to http://webmaster.iu.edu/tools-and-guides/maintenance/redirect-meta-refresh.phtml
			for redirecting pages-->
		<meta http-equiv="refresh" content="0; URL=index.php" />
		<title>PHP-Assignment-2</title>
	</head>
</html>

<?php
$row_id = $_POST['row_id'];
$check_status = NULL;

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "chanal-db", $myPassword, "chanal-db");
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL<br>";
} else {
	if(!$stmt = $mysqli->prepare("SELECT rented FROM video_store WHERE id =".$row_id)) {
		echo 'Prepare failed<br>';
	}

	if(!$stmt->execute()) {
		echo 'Execute failed<br>';
	}

	if(!$stmt->bind_result($check_status)) {
		echo 'Binding result failed<br>';
	}

	$stmt->fetch();
	$stmt->close();
	if($check_status === 0) {
		if(!$stmt = $mysqli->prepare('UPDATE video_store SET rented = TRUE WHERE id=?')) {
			echo 'Prepare failed<br>';
		}
		if (!$stmt->bind_param('s', $row_id)) {
			echo 'Binding parameters failed<br>';
		}
		if (!$stmt->execute()) {
			echo 'Execute failed<br>';
		}
	} else {
		if(!$stmt = $mysqli->prepare('UPDATE video_store SET rented = FALSE WHERE id=?')) {
			echo 'Prepare failed<br>';
		}
		if (!$stmt->bind_param('s', $row_id)) {
			echo 'Binding parameters failed<br>';
		}
		if (!$stmt->execute()) {
			echo 'Execute failed<br>';
		}
	}

}



?>