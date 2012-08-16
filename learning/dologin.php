<?php
require_once 'init.php';

// $error=false;
// $errMsg='';

// function outPutError($str){
	// global $error, $errMsg;
	// $error=true;
	// $errMsg=$errMsg."<li>".$str."</li>";
// }

	if(isSet($_SESSION['user']) && $_SESSION['user']->member_ID>=1) {
		header('Location: index.php');
		die();
	}

$didPost=isset($_POST['passInfo']);
if($didPost && $_POST['member_ID']==""){
	inputError("usr","Please enter member ID");
}
if($didPost && $_POST['passwd']==""){
	inputError("pass","Please enter password");
}
if($didPost && $_POST['member_ID']!="" && $_POST['passwd']!=""):
	$member_ID = mysql_real_escape_string($_POST['member_ID']);   //escape the mysql string to prevent sql injection
	$result = mysql_query("select * from users where member_ID='$member_ID'", $db) or die("failed to select user");
	
	$rowCheck = mysql_num_rows($result);
	
	if ($rowCheck > 1) {
		//ask user to select
        header("Location: selectuser.php?member_id=$member_ID");
	}
	else if ($rowCheck > 0) {
		$row = mysql_fetch_assoc($result);
		$pass = $row["pwd"];
		if(sha1($_POST["passwd"])==$pass){
        	//$usr = sprintf("%s %s",$row["first_Name"],$row["last_Name"]);
            createUserObject($row);
			header('Location: index.php');
			die();
		}else{
			inputError("pass","invalid password");
		}
	}
	else 
		inputError("usr",'<b>' . $member_ID . ' is not a valid member id! <b>');
		

endif;

//$usrStatus = 11;
$pageName = 'Login';
include 'header.inc.php'; 
?>
<?php
//echo $error . ":hfdsjkhfkdshnfkdfgkndfkjgbkjfgfd";
if(formHasError()){
$errMsg=formatErrorMsg();
echo <<<EOT
<div id="error" style="background-color:#ff0000;">
<ul>
$errMsg
</ul>
</div>
EOT;
}
?>
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <label>Member ID:
  <input type="text" name="member_ID" id="member_ID" value="<?php echo htmlentities($_POST["member_ID"])?>"/>
  </label>
  <p>
    <label>Password:
    
	<input type="password" name="passwd" id="passwd" />
    </label>
  </p>
  <p>
    <label>
    <input type="submit" name="passInfo" id="passInfo" value="Submit" />
    </label>
</form>
<a href="selectuser.php">click here if you have multiple users in one member id</a>
<?php include 'footer.inc.php' ?>