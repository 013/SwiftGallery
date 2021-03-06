<?php
include "include/header.php";
$username = "";
$email = "";
$message = "";
if (isset($_GET['username'])) {
	/*
	 * If the username is set, than it must alreadyt exist
	 * $_GET['email'] may also be set, but it is not required
	 *
	 */
	 $username = htmlentities($_GET['username']);
	 if (isset($_GET['email'])) $email = htmlentities($_GET['email']);
	 $message = "<small>This username/email already exists</small>";
}
?>
<style>
.form-signin {
	max-width: 330px;
	padding: 15px;
	margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
	margin-bottom: 10px;
}
.form-signin .checkbox {
	font-weight: normal;
}
.form-signin .form-control {
	position: relative;
	font-size: 16px;
	height: auto;
	padding: 10px;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
.form-signin .form-control:focus {
	z-index: 2;
}
.form-signin input[type="text"] {
	margin-bottom: -1px;
	border-bottom-left-radius: 0;
	border-bottom-right-radius: 0;
}
.form-signin input[type="password"] {
	margin-bottom: 10px;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
}
</style>
	<form class="form-signin" action="confirm.php" method="post">
	<h2 class="form-signin-heading">Register</h2>
	<input type="text" class="form-control" placeholder="Email (Optional)" name="email" value="<?=$email; ?>">
	<input type="text" class="form-control" placeholder="Username" name="username" style="border-radius: 0;" value="<?=$username; ?>" autofocus>
	<input type="password" class="form-control" placeholder="Password" name="password">
	<label class="checkbox">
	<input type="checkbox" value="0" name="remember"> Remember me
	</label>
	<?=$message; ?>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
	</form>

<?php include "include/footer.php" ?>
