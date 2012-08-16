<?php
require_once 'init.php';

    $getUserList= !isset($_POST['submitselect']) && isset($_GET['member_id']);

	if(isSet($_SESSION['user']) && $_SESSION['user']->member_ID>=1) {
		header('Location: index.php');
		die();
	}
    
    if(isset($_POST['submitselect'])){
        //login by record id
        $recordID=intval($_POST["whichselected"]);
        $result = mysql_query("select * from users where recordID='$recordID'", $db) or die("failed to select user");
        $rowCheck = mysql_num_rows($result);
        if($rowCheck<1){
            die("record doesn't exist");
        }
		$row = mysql_fetch_assoc($result);
		$pass = $row["pwd"];
        //echo $pass. '<br />';
        //echo sha1($_POST["passwd"]) . '      ';
		if(sha1($_POST["passwd"])==$pass){
        	//$usr = sprintf("%s %s",$row["first_Name"],$row["last_Name"]);
            createUserObject($row);
			header('Location: index.php');
			die();
		}else{
			die("invalid password");
		}
    }else if($getUserList){
        //get the list of users with the member id
        $resultList = mysql_query("select recordID,first_name from users where member_id='".$_GET['member_id']."'", $db) or die("failed to select user".mysql_error());
        if(mysql_num_rows($resultList)<1) die("member doesnt exist........................................");
    } 
    
$pageName = 'Select Users'; 
include "header.inc.php"; 
?>
<form id="entermemberid" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" name="entermemberid">
  <label>member_ID
  <input type="text" name="member_id" id="member_id" value="<?php echo $_GET['member_id'] ?>" />
  </label>
  <label>submitid
  <input type="submit" name="submitid" id="submitid" value="Submit" />
  </label>
</form>
<?php if(isset($_GET['member_id'])){ ?>
<form id="selectform" name="selectform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <?php
  while($rowList=mysql_fetch_row($resultList)){
    echo '<label>
  <input type="radio" name="whichselected" id="'.$rowList[0].'" value="'.$rowList[0].'" />'.$rowList[1].'</label>';
    }
    ?>
  <label>
    <label>Password:
    <input type="password" name="passwd" id="passwd" />
    </label>      
  <input type="submit" name="submitselect" id="submitselect" value="Submit" />
  </label>
</form>
<?php } ?>
<?php include 'footer.inc.php' ?>