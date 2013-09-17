<?

//var_dump($_POST);

$pub = 			$_POST['sks'];
$albumTitle = 	$_POST['albumtitle'];
$images = 		array();
$amount = 		(int) $_POST['count'];
$album =		false;

for ($i=0; $i<= $amount, $i++) {
	$images + $_POST['imgHash'+$i];
}

if ( (int) $_POST['albumradio'] == 1) {
	$album = true;
}





?>
