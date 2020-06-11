<?php
spl_autoload_register(function ($class_name) {
    include_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/classes/" . $class_name . ".php");
});
$detect = new Mobile_Detect;
define("IS_MOBILE", ($detect->isMobile()) ? (true) : (false));
define("IS_TABLET", ($detect->isTablet()) ? (true) : (false));
define("IS_TOUCHPAD", (IS_MOBILE || IS_TABLET) ? (true) : (false));
if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/classes/customtypehtml.php")) ;
    include $_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/classes/customtypehtml.php";
if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/constants.php")) ;
    include $_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/constants.php";
if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/functions.php")) ;
    include $_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/functions.php";
if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/events.php")) ;
    include $_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/events.php";