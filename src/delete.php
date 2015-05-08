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

/* Referred to http://www.mustbebuilt.co.uk/php/insert-update-and-delete-with-mysqli/
to set up DELETE statements*/
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "chanal-db", $myPassword, "chanal-db");
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL";
} else {
	if (!($stmt = $mysqli->prepare('DELETE FROM video_store'))) {
		echo 'Prepared failed<br>';
	}
	if(!($stmt->execute())) {
		echo 'Execute failed<br>';
	}
}

$stmt->close();




?>