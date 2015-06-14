<?php 

// Global configuration settings
define("COMPETITION_ID", "");
define("FACEBOOK_APP_ID", "");
define("ASSET_VERSION", "1.0.0");

// Environmentally sensitive configuration settings
$domain = $_SERVER["HTTP_HOST"];
switch($domain) {
	case "win.bristolbronies.dev":
		define("DEBUG", true);
		define("DB_HOST", "");
		define("DB_NAME", "");
		define("DB_USER", "");
		define("DB_PASS", "");
		break;
	case "win.bristolbronies.co.uk":
		define("DEBUG", false);
		define("DB_HOST", "");
		define("DB_NAME", "");
		define("DB_USER", "");
		define("DB_PASS", "");
		break;
	default:
		die("ERROR: Settings for environment <em>" . $domain . "</em> could not be found.");
		break;
}

// Error checking
if(DEBUG) {
	error_reporting(E_ALL);
}
else {
	error_reporting(0);
}

// Database connection
try {
	$connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
	echo $e->getMessage();
}