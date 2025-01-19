<?php
/**
 * Database config variables
 */
define("DB_HOST", "YOUR HOST NAME");
define("DB_USER", "YOUR DATABASE USER NAME");
define("DB_PASSWORD", "YOUR DATABASE PASSWORD");
define("DB_DATABASE", "YOUR DATABASE NAME");

/*
 * Google API Key
 */
define("GOOGLE_API_KEY", "PLACE YOUR KEY HERE"); // Place your Google API Server Key



$root_path = '/PATH FROM ROOT/admin/'; // please replace "PATH FROM ROOT" with your path from root here. If your application is in root, leave it as /admin/
$root_path1 = '/PATH FROM ROOT';// please replace "PATH FROM ROOT" with your path from root here. If your application is in root, leave it as /
$dirroot_path = $_SERVER['DOCUMENT_ROOT'] . 'PATH FROM ROOT/admin/';// please replace "PATH FROM ROOT" with your path from root here. If your application is in root, leave it as /
$dirroot_path1 = $_SERVER['DOCUMENT_ROOT'] . 'PATH FROM ROOT/';// please replace "PATH FROM ROOT" with your path from root here. If your application is in root, leave it as /
$host = "http://$_SERVER[HTTP_HOST]";
$completelink= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$admin_mail="contact@eprofitbooster.com";

define("PROJECT_NAME","BookMyCab")

?>