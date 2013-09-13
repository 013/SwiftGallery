<?php include "include/header.php" ?>
<?
$message = "";
$username = "";


	/*
	 * Once there is an actual page, won't need all this code
	 *
	 */
	echo "You're viewing: ";
	if (isset($_SESSION['uid']) && $_SESSION['uid'] == $_GET['id']) {
		if ($id == $_SESSION['uid']) {
			echo 'Your page<br><a href="index.php?action=logout">Logout</a>';
		}
	} else {
		echo htmlspecialchars($_GET['id']);
	}
?>
<?php include "include/footer.php" ?>
