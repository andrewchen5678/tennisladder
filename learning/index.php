<?php 
require_once 'init.php'; 

requireLogin();
//	$name = $_GET['na'];


	//$member_ID = mysql_real_escape_string($_POST['member_ID']);   //escape the mysql string to prevent sql injection
	//$result = mysql_query(sprintf("select * from users where member_ID='%s'",$_SESSION['member_ID']), $db);
	
	//$rowCheck = mysql_num_rows($result);
	
	//if ($rowCheck > 0) {
	//	$row = mysql_fetch_assoc($result);
		$usr = sprintf("%s %s",$_SESSION["user"]->first_Name,$_SESSION["user"]->last_Name);
		//$_SESSION["usrStatus"] = $row['usrStatus'];
	//	$pass = $row["pwd"];
		//echo '<title>Welcome '.$usr.'</title>';
		$pageName = 'Welcome '.$usr;
		//echo '<b>' . $usr . ' is a user! <b>';
	//}
	//else 
	//	echo '<b>' . $user . ' is not a user! <b>';
		
	//echo 'complete!';
	//echo "usr status".$_SESSION["usrStatus"];
	include "header.inc.php"; 
//	while ($row = mysql_fetch_array($result)) {
	//	echo $result[1];
//	}
	
//	$usr = $_POST['userName']; 

//	if ( $usrStatus == 1 ) {	//for an administrator
		
//	}
//	else if ( $usrStatus == 2 ) {	//for a manager
	
//	}
//	else if ( $usrStatus == 3 ) {	//for a user
	
//	}
	//echo $usr . ' is a user!'
    print_r ($_SESSION['user']) ;
?>
<a href="logout.php">Log out </a>
<?php include 'footer.inc.php' ?>