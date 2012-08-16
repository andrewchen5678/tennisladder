<?php
require_once 'init.php';
include 'validEmail.php';

// $error=false;
// $errMsg='';

// function outPutError($which,$str){
	// global $error, $errMsg, $errForm;
	// $error=true;
    // $errForm[$which]=true;
	// $errMsg=$errMsg."<li>".$str."</li>";
// }

// function printRedStar(){
    // echo '<font color="red">*</font>';
// }

$didPost=isset($_POST['registerBtn']);

if($didPost){

    if($_POST['first_Name']==""){
        inputError('first_Name',"Please enter first name");
    }else if(strlen($_POST['first_Name'])>FIRSTNAMELEN){
        inputError('first_Name',"first_Name length > ".FIRSTNAMELEN);
    }
    
    if($_POST['member_ID']==""){
        inputError('member_ID',"Please enter member ID");
    }else{
        $query="select * from users where member_ID='".mysql_real_escape_string($_POST['member_ID'])."' and first_Name='".mysql_real_escape_string($_POST['first_Name'])."'";
		$resultMember=mysql_query($query, $db) or die("failed to check if user in the table".mysql_error());
        $checkMember = mysql_num_rows($resultMember);
        if($checkMember>0){
            inputError('member_ID',"Member ID with same first name already exists");
        }else if(strlen($_POST['member_ID'])>IDLEN){
            inputError('member_ID',"Member ID length > ".IDLEN);
        }
    }    

    if($_POST['last_Name']==""){
        inputError('last_Name',"Please enter last name");
    }else if(strlen($_POST['last_Name'])>LASTNAMELEN){
        inputError('last_Name',"last_Name length > ".LASTNAMELEN);
    }

    if($_POST['phone']==""){
        inputError('phone',"Please enter phone");
    }else if(strlen($_POST['phone'])>PHONELEN){
        inputError('phone',"phone length > ".PHONELEN);
    }else if(!is_numeric($_POST['phone'])){
        inputError('phone',"invalid phone number ".htmlentities($_POST['phone']));
    }

    if($_POST['address']==""){
        inputError('address',"Please enter address");
    }else if(strlen($_POST['address'])>ADDRESSLEN){
        inputError('address',"address length > ".ADDRESSLEN);
    }

    if($_POST['email']==""){
        inputError('email',"Please enter email");
    }else if(strlen($_POST['email'])>EMAILLEN){
        inputError('email',"email length > ".EMAILLEN);
    }else if(!validEmail($_POST['email'])){
        inputError('email',"invalid email ".htmlentities($_POST['email']));
    }

    if($_POST['pwd']!=$_POST['pwd2']){
        inputError('pwd2',"password didn't match");
    }else if($_POST['pwd']==""){
        inputError('pwd',"Please enter password");
    }else if(strlen($_POST['pwd'])>PWDLEN){
        inputError('pwd',"password length > ".PWDLEN);
    }
    
    
}

if($didPost && !formHasError()):
    $member_ID = mysql_real_escape_string($_POST['member_ID']);
    $first_Name = mysql_real_escape_string($_POST['first_Name']);
    $last_Name = mysql_real_escape_string($_POST['last_Name']);
    $phone = mysql_real_escape_string($_POST['phone']);
    $address = mysql_real_escape_string($_POST['address']);	
    $email = mysql_real_escape_string($_POST['email']);	
    $password = mysql_real_escape_string(sha1($_POST['pwd']));
    $query="insert into users (member_ID,first_Name,last_Name,phone,address,usrStatus,pwd,email) values ('$member_ID','$first_Name','$last_Name','$phone','$address',".USR_USER.",'$password','$email')";
    if (!mysql_query($query,$db))
    {
    die('Error: ' . mysql_error());
    }
    echo '<strong>registration success, <a href="index.php">click here to go to the main page...<a></strong>';
endif;

$pageName = 'Register a New User';
include 'header.inc.php'; 
?>
<script language="javascript">
function validate(){
	if(document.form1.pwd.value!=document.form1.pwd2.value){
		alert("password didn't match");
		return false;
	}
}
</script>
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validate();">
<p>
  <label>Member ID
  <input type="text" name="member_ID" id="member_ID" maxlength="<?php echo IDLEN ?>" value="<?php echo htmlentities($_POST["member_ID"])?>"/><?php if(fieldHasError('member_ID')){ printRedStar(); } ?>
  </label>
  </p>
  First Name
  <input type="text" name="first_Name" id="first_Name" maxlength="<?php echo FIRSTNAMELEN ?>" value="<?php echo htmlentities($_POST["first_Name"])?>"/><?php if(fieldHasError('first_Name')){ printRedStar(); } ?>
  </label>
  <p>
    <label>Last Name
    <input type="text" name="last_Name" id="last_Name" maxlength="<?php echo LASTNAMELEN ?>" value="<?php echo htmlentities($_POST["last_Name"])?>"/><?php if(fieldHasError('last_Name')){ printRedStar(); } ?>
    </label>
  </p>
  <p>
    <label>Phone
    <input name="phone" type="text" id="phone" maxlength="<?php echo PHONELEN ?>" value="<?php echo htmlentities($_POST["phone"])?>"/><?php if(fieldHasError('phone')){ printRedStar(); } ?>
    </label>
  </p>
  <p>
    <label>Address
    <input type="text" name="address" id="address" maxlength="<?php echo ADDRESSLEN ?>" value="<?php echo htmlentities($_POST["address"])?>"/><?php if(fieldHasError('address')){ printRedStar(); } ?>
    </label>
  </p>
  <p>
    <label>Email
    <input type="text" name="email" id="email" maxlength="<?php echo EMAILLEN ?>" value="<?php echo htmlentities($_POST["email"])?>"/><?php if(fieldHasError('email')){ printRedStar(); } ?>
    </label>
  </p>  
  <p>
    <label>Password
    <input type="password" name="pwd" id="pwd" maxlength="<?php echo PWDLEN ?>" /><?php if(fieldHasError('pwd') || fieldHasError('pwd2')){ printRedStar(); } ?>
    </label>
  </p>
  <p>
    <label>Confirm Password
    <input type="password" name="pwd2" id="pwd2" maxlength="<?php echo PWDLEN ?>" /><?php if(fieldHasError('pwd2')){ printRedStar(); } ?>
    </label>
  </p>
  <p>
    <label>
    <input type="submit" name="registerBtn" id="registerBtn" value="Register" />
    </label>
  </p>
</form>
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
<?php include 'footer.inc.php' ?>