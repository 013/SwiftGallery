<?php
ini_set("display_errors", true);
date_default_timezone_set( "Europe/London" );  // http://www.php.net/manual/en/timezones.php
define("DB_DSN", "mysql:host=localhost;dbname=gallery");
define("DB_USERNAME", "gallery_user");
define("DB_PASSWORD", "48sVTM2jFChGW2Du");
define("HOMEPAGE_SORT", "top_daily"); //top_daily, top_weekly, top_monthly, newest

define("PRODUCT_NAME", "Swiftler");

require("include/main.php");

?>

