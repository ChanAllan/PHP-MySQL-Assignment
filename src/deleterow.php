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
/*Code obtained from lecture to access my database and can be seen on: 
http://php.net/manual/en/mysqli.quickstart.prepared-statements.php*/
$row_id = $_POST['row_id'];

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "chanal-db", $myPassword, "chanal-db");
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
	if(!$stmt = $mysqli->prepare('DELETE FROM video_store WHERE id=?')) {
		echo 'Prepare failed<br>';
	}

	if(!$stmt->bind_param('s', $row_id)) {
		echo 'Binding parameters failed<br>';
	}

	if(!$stmt->execute()) {
		echo 'Execute failed<br>';
	}
}
///////////*WILL REMOVE MYSQL ERROR  OUTPUTS BEFORE SUBMISSION*/////////////////////////////////////



?>