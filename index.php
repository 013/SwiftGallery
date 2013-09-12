<?php
// Move outside of web directory
require("include/config.php");

$action = isset($_GET['action']) ? $_GET['action'] : "";

switch($action) {
	case 'upload':
		//echo "someaction";//func();
		upload();
		break;
	case 'view':
		viewImg($_GET['id']);
		break;
	case 'register':
		register();
		break;
	case 'user':
		userArea($_GET['id']);
		break;
	default:
		homepage();
}

function homepage() {
	$results = array();
	$data = Image::getList(10);
	$results['images'] = $data['results'];
	$results['totalRows'] = $data['totalRows'];
	$results['pageTitle'] = "Gallery";

	require("include/homepage.php");
}

function userArea($id) {
	echo "You're viewing: ";
	if ($id == $_SESSION['uid']) {
		echo 'Your page';
	} else {
		echo $id;
	}
}

function upload() {
	$results['pageTitle'] = "Upload";
	require("include/upload2.php");
}

function viewImg($id) {
	$results = array();
}

function register() {
	$results = array();

	$results['pageTitle'] = "Register";

	require("include/register.php");
}

?>



