<?php

// https://github.com/ircmaxell/password_compat
require('include/password.php');
require('include/config.php');

if (isset($_POST)) {
	//var_dump($_POST);
	$email =    $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$rememberMe = isset($_POST['remember']);
} else {
	header('Location: /');
	die();
}

 /*
  * Client side authentication would have found duplicate usernames / email addresses
  * Use userExists() function to search DB for username of email - Don't trust the users
  *
  */
//die();
if (userExists($username, $password)) die();

// Insert new user and log them in
echo "not dead yet";


/*
 * Set cost lower to increase time for hashing (less secure)
 * http://uk3.php.net/password_hash
 *
 */
$options = [
	'cost' => 12,
];

$password = password_hash($password, PASSWORD_BCRYPT, $options);

$userID = insertUser($email, $username, $password, '');

session_start();
$_SESSION['uid'] = $userID;
header('Location: ?action=user&id='.$_SESSION['uid']);
//echo $_SESSION['uid'];

function userExists($username, $email) {
	$conn = new PDO ('mysql:host=localhost;dbname=gallery', 'gallery_user', '48sVTM2jFChGW2Du');
	$sql = "SELECT id FROM users WHERE email = :email OR username = :username";
	$st = $conn->prepare($sql);
	$st->bindValue(":email", $email, PDO::PARAM_STR);
	$st->bindValue(":username", $username, PDO::PARAM_STR);
	$st->execute();
	$row = $st->fetch();
	$conn = null;
	if ($row) return True;
	return False;
}

function insertUser($email, $username, $password, $session) {
	$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
	$sql = "INSERT INTO users ( email, username, password, session, locked ) VALUES ( :email, :username, :password, :session, 0)";
	$st = $conn->prepare($sql);
	$st->bindValue(":email", $email, PDO::PARAM_STR);
	$st->bindValue(":username", $username, PDO::PARAM_STR);
	$st->bindValue(":password", $password, PDO::PARAM_STR);
	$st->bindValue(":session", $session, PDO::PARAM_STR);
	$st->execute();
	
	$id = $conn->lastInsertId();
	$conn = null;
	return $id;
}

function hashPassword($plaintext) {
	echo "";
}

?>

