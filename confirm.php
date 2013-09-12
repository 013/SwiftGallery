<?php

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

if (userExists($username, $password)) die();

echo "not dead yet";
// Insert new user and log them in

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



?>

