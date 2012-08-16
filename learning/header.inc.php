<?php
if (!defined('ACCESS_INCLUDE'))
{
	$selfname=$_SERVER['PHP_SELF'];
	die("direct access to $selfname denied");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Tennis Ladder - 
<?php
	echo $pageName;
?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<table width="100%" border="0">
  <tr>
    <td><h1>Tennis Ladder</h1></td>
    <td><h2 align="right"><a href="logout.php">Logout</a></h2></td>
  </tr>
</table>
<hr />
<div id="tabs">
  <ul>
  <?php
  	//$usrStatus = $_GET['US'];
    $usrStatus=$_SESSION["user"]->usrStatus;
  	if  ($usrStatus == USR_ADMIN) {
    echo '<li><a href="index.php"><span>Administrator Home</span></a></li>
    <li><a href="editladderselect.php"><span>Edit Ladders</span></a></li>
    <li><a href="managerEdit.php"><span>Edit Ladder Chair</span></a></li>
    <li><a href="userEdit.php"><span>Edit Users</span></a></li>
    <li><a href="profile.php"><span>My Profile</span></a></li>';
	}
	else if ($usrStatus == USR_MANAGER) {
	echo '<li><a href="index.php"><span>Manager Home</span></a></li>
    <li><a href="editladderselect.php"><span>Edit Ladders</span></a></li>
    <li><a href="userEdit.php"><span>Edit Users</span></a></li>
	<li><a href="profile.php"><span>My Profile</span></a></li>';
	}
	else if ($usrStatus == USR_USER) {
	echo '<li><a href="index.php"><span>User Home</span></a></li>
    <li><a href="myladders.php"><span>My Ladders</span></a></li>
    <li><a href="stats.php"><span>My Stats</span></a></li>
    <li><a href="profile.php"><span>My Profile</span></a></li>';
	}
	else {
	echo '<li><a href="index.php"><span>Default Home</span></a></li>
    <li><a href="ladders.php"><span>Ladders</span></a></li>
	<li><a href="register.php"><span>Register</span></a></li>';
	}
	?>
<!--    <li><a href="http://www.free-css.com/"><span>CSS Templates</span></a></li>
    <li><a href="http://www.free-css.com/"><span>CSS Layouts</span></a></li>
    <li><a href="http://www.free-css.com/"><span>CSS Books</span></a></li>
    <li><a href="http://www.free-css.com/"><span>CSS Menus</span></a></li>
    <li><a href="http://www.free-css.com/"><span>CSS Tutorials</span></a></li>
    <li><a href="http://www.free-css.com/"><span>CSS Reference</span></a></li>
    <li><a rel="nofollow" target="_blank" href="http://www.exploding-boy.com/" title="explodingboy"><span>explodingboy</span></a></li>-->
  </ul>
</div>
<div id="content">
<br/>