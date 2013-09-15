<?php
// Move outside of web directory
require("include/config.php");

$action = isset($_GET['action']) ? $_GET['action'] : "";

switch($action) {
	case 'upload':
		upload();
		break;
	case 'view':
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
	$data = Image::getList(100);
	$results['images'] = $data['results'];
	$results['totalRows'] = $data['totalRows'];
	$results['pageTitle'] = "Gallery";

	require("include/homepage.php");
}

function userArea($id) {
	$results['pageTitle'] = "User: ".htmlspecialchars($id);//.getUsername($id);
	require("include/user.php");
}

function upload() {
	$results['pageTitle'] = "Upload";
	require("include/upload.php");
}

function viewImg($id) {
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
	unset($_SESSION['uid']);
	session_destroy();
	header('Location: index.php');
}

?>



