<?

 /*
  * Make sure to check that each image hash belongs to that user
  * Update each image to `published`=1
  *
  */

if (!isset($_POST['count'])) {
	header('Location: /index.php?action=upload');
}

?><pre><?=var_dump($_POST); ?></pre><?

$pub = 			$_POST['sks'];
$albumTitle = 	$_POST['albumtitle'];
$images = 		array();
$imageTags =	array();
$amount = 		(int) $_POST['count'];
$album =		false;

for ($i=1; $i<= $amount; $i++) {
	$images[$_POST["imgHash$i"]] = $_POST["imgTitle$i"];
	// $imageTags[$_POST["imgHash$i"]] = $_POST["imgTag$i"];
}

if ( (int) $_POST['albumradio'] == 1) {
	$album = true;
}


?><pre><?=var_dump($images); ?></pre><?


?>