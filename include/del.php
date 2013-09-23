<?

require('include/config.php');
session_start();

if (!isset($_SESSION['username'])) { 
	// If it's not set, how did they even get here???
	die(0);
}

$username = $_SESSION['username'];
$hash = $_POST['imageHash'];

if ( User::checkOwner( $_POST["imgHash$i"] ) == $username ) {
	$conn = new PDO (DB_DSN, DB_USERNAME, DB_PASSWORD);
	$sql = "DELETE FROM images WHERE imageHash = :hash";
	$st = $conn->prepare($sql);
	$st->bindValue(":hash", $hash, PDO::PARAM_INT);
	$st->execute();
	//$row = $st->fetch();
	$conn = null;
}

?>
