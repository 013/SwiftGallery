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
$album =		false;
$username = $_SESSION['username'];
// First check if the token matches the username in tempKey table

if (!User::checkToken($token, $username)) { die('Token did not match'); }

for ($i=1; $i<= $amount; $i++) {
	$images[$_POST["imgHash$i"]] = $_POST["imgTitle$i"];

	if ( User::checkOwner( $_POST["imgHash$i"] ) == $username ) {
		// This user owns this image
		// add tags
		// set to published
		// If album, update album id
	}

	// $imageTags = array_merge($imageTags, explode(',' $_POST["imgTags$i"]);
	// var_dump( explode(',', $x) );
	// $imageTags[$_POST["imgHash$i"]] = $_POST["imgTag$i"];
}

if ( (int) $_POST['albumradio'] == 1) {
	$album = true;
}


//var_dump( $images );




?>
