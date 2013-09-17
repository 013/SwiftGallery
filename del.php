<?

require('include/config.php');
session_start();

if (!isset($_SESSION['username'])) { 
	// If it's not set, how did they even get here???
	die(0);
}

$username = $_SESSION['username'];
//$id = $_SESSION['uid'];

// select username from images where imageHash = $_GET['hash']
// if $username = row['username'], delete row and image
// 

//var_dump($_GET);
//var_dump($_SESSION);

?>
