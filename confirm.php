<?php

 /*
  * Serverside validation of login and registration
  *
  *
  *
  */

// https://github.com/ircmaxell/password_compat
require('include/password.php');
require('include/config.php');

session_start();
$reg = false;
if (isset($_POST['username'])) {
	//var_dump($_POST);
	if (isset($_POST['email'])) {
		$email =    $_POST['email'];
		$reg = true;
	}
	$username = $_POST['username'];
	$password = $_POST['password'];
	$rememberMe = isset($_POST['remember']);
} else {
	header('Location: index.php');
	die();
}

/*
 * If the length of the username/password is <1 
 * Send them back
 *
 */

if (strlen($username) <= 1 || strlen($password) <= 1) {
	if ($reg) {
		header('Location: index.php?action=register');
	} else {
		header('Location: index.php?action=login');
	}
}

if ($reg) {
	/*
	  * Client side authentication would have found duplicate usernames / email addresses
	  * Use userExists() function to search DB for username of email - Don't trust the users
	  *
	  */
	
	if (userExists($username, $email)) {
		$Ge = '';
		if (strlen($email) > 1) {
			$Ge = "&email=".$email;
		}
		header("Location: index.php?action=register&username=$username$Ge");
	} else {
		
		// Insert new user and log them in
		
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
		
		
		$_SESSION['uid'] = $userID;
		header('Location: ?action=user&id='.$_SESSION['uid']);
	}
} else {
	/*
	 * If the user has simply logged in
	 *
	 */
	
	//diie();p
	//getUserHash('ryan');
	if (password_verify($password, getUserHash($username))) {
		$_SESSION['uid'] = getUserID($username);
		$_SESSION['username'] = $username;
		header('Location: index.php?action=user&id='.$_SESSION['uid']);
	} else {
		header('Location: index.php?action=login&username='.$username.'&incorrect=true');
		//echo 'Invalid password';
	}
}

function userExists($username, $email) {
	$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
	$sql = "SELECT * FROM users WHERE username = :username";
	$st = $conn->prepare($sql);
	//$st->bindValue(":email", $email, PDO::PARAM_STR);
	$st->bindValue(":username", $username, PDO::PARAM_STR);
	$st->execute();
	
	$row = $st->fetch();
	$conn = null;
	if (strlen($row['email'] > 1) || isset($row['username'])) {
		return true;
	} else {
		return false;
	}
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

function getUserHash($username) {
	$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
	$sql = "SELECT password FROM users WHERE username = :username";
	$st = $conn->prepare($sql);
	$st->bindValue(":username", $username, PDO::PARAM_STR);
	$st->execute();
	
	$row = $st->fetch();
	$conn = null;
	return $row['password'];
}

function getUserID($username) {
	$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
	$sql = "SELECT id FROM users WHERE username = :username";
	$st = $conn->prepare($sql);
	$st->bindValue(":username", $username, PDO::PARAM_STR);
	$st->execute();
	
	$row = $st->fetch();
	$conn = null;
	return $row['id'];
}

?>

