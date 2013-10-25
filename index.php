<?php
// Move outside of web directory
require("include/config.php");

$action = isset($_GET['action']) ? $_GET['action'] : "";

switch($action) {
	case 'upload':
		upload();
		break;
	case 'view':
		/*
		 * Each image can be viewed on an individual page, if a user
		 * simply clicks on an image it will pop up
		 * but not take them to a new 
		 *
		 */
		viewImg($_GET['id']);
		break;
	case 'register':
		register();
		break;
	case 'login':
		login();
		break;
	case 'logout':
		logout();
		break;
	case 'user':
		userArea($_GET['id']);
		break;
	default:
		homepage();
}

function homepage() {
	$results = array();

	// At the end of every page call this function
	// Using the next page number as an arguement
	$data = Image::getList();	
	$results['images'] = $data['results'];
	$results['totalRows'] = $data['totalRows'];
	$results['pageTitle'] = "Gallery";
	
	require("include/homepage.php");
}

function userArea($id) {
	// Still a WIP
	$results['pageTitle'] = "User: ".htmlspecialchars($id);//.getUsername($id);
	require("include/user.php");
}

function upload() {
	$results['pageTitle'] = "Upload";
	require("include/upload.php");
}

function viewImg($id) {
	// Temporary for now
	//
	$results = array();
	$results['pageTitle'] = "Viewing".htmlspecialchars($id);
	$image = Image::getById($id);
	//var_dump($x);
	require("include/header.php");
	$html = "<img src=\"images/".substr($image->imageHash, 0,4).'/'.substr($image->imageHash, 4,8).$image->imageTypes[$image->mimeType]."\">";
	echo $html;
	require("include/footer.php");
}

function register() {
	$results = array();
	$results['pageTitle'] = "Register";

	require("include/register.php");
}

function login() {
	$results = array();
	$results['pageTitle'] = "Login";

	require("include/login.php");
}

function logout() {
	session_start();
	echo $_SESSION['username'];
	unset($_SESSION['uid']);
	unset($_SESSION['username']);
	session_destroy();
	//header('Location: index.php');
}

?>


