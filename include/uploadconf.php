<?

require("config.php");
session_start();

 /*
  * Make sure to check that each image hash belongs to that user
  * Update each image to `published`=1
  *
  */

if (!isset($_POST['count'])) {
	header('Location: /index.php?action=upload');
}

?><pre><?=var_dump($_POST); ?></pre><?

$token =		$_POST['token'];
//$pub = 			$_POST['sks'];
$albumTitle = 	$_POST['albumtitle'];
$images = 		array();
$imageTags =	array();
$amount = 		(int) $_POST['count'];
$album =		0;
$username = $_SESSION['username'];
// First check if the token matches the username in tempKey table

if (!User::checkToken($token, $username)) { die('Token did not match'); }

if ( (int) $_POST['albumradio'] == 1) {
	// Insert into album table and get last inserted ID
	$album = 00;
}

for ($i=1; $i<= $amount; $i++) {
	$images[$_POST["imgHash$i"]] = $_POST["imgTitle$i"];

	if ( User::checkOwner( $_POST["imgHash$i"] ) == $username ) {
		// This user owns this image
		// add tags
		$conn = new PDO (DB_DSN, DB_USERNAME, DB_PASSWORD);
		$sql = "UPDATE images SET title=:title, tags=:tags, published=1, album=:album WHERE imageHash= :hash";
		$st = $conn->prepare($sql);
		$st->bindValue(":title", $_POST["imgTitle$i"], PDO::PARAM_STR);
		$st->bindValue(":tags", $_POST["imgTag$i"], PDO::PARAM_STR);
		$st->bindValue(":album", $album, PDO::PARAM_STR);
		$st->bindValue(":hash", $_POST["imgHash$i"], PDO::PARAM_STR);
		$st->execute();
		$conn = null;
		// set to published
		// If album, update album id
	}

	// $imageTags = array_merge($imageTags, explode(',' $_POST["imgTags$i"]);
	// var_dump( explode(',', $x) );
	// $imageTags[$_POST["imgHash$i"]] = $_POST["imgTag$i"];
}

//var_dump( $images );

?>
