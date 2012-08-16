<?php

require_once "constants.php";
require_once "dbconfig.php";
require_once "classes.php";
require_once "functions.php";

session_start();

//protect against session hijacking and session fixation
$user_check = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
if (empty($_SESSION['user_data'])) {
    session_regenerate_id();
    //echo ("New session, saving user_check.");
    $_SESSION['user_data'] = $user_check;
}
if (strcmp($_SESSION['user_data'], $user_check) !== 0) {
    session_regenerate_id();
    //echo ("Warning, you must reenter your session.");
    $_SESSION = array();
    $_SESSION['user_data'] = $user_check;
}

//else {
//    echo ("Connection verified!");
//}


$db = mysql_connect("$dbHost", "$dbUser", "$dbPass") or die ("Error connecting to database.");
mysql_select_db("$dbDatabase", $db) or die ("Couldn't select the database.");
define('ACCESS_INCLUDE',true);
?>