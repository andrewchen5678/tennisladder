<?php 
require_once 'init.php'; 
include 'validEmail.php';

requireLogin();

$didPost=isset($_POST['Submit']);

$member_ID=intval($_SESSION['user']->member_ID);	//CHANGE TO ACCEPT USER ID AS INPUT FROM userEdit.php

if($didPost){
/*
    if($_POST['first_Name']==""){
        inputError('first_Name',"Please enter first name");
    }else if(strlen($_POST['first_Name'])>FIRSTNAMELEN){
        inputError('first_Name',"first_Name length > ".FIRSTNAMELEN);
    }

    if($_POST['last_Name']==""){
        inputError('last_Name',"Please enter last name");
    }else if(strlen($_POST['last_Name'])>LASTNAMELEN){
        inputError('last_Name',"last_Name length > ".LASTNAMELEN);
    }
*/
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
    }else if(strlen($_POST['pwd'])>PWDLEN){
        inputError('pwd',"password length > ".PWDLEN);
    }else if($_POST['pwd']!="" || $_POST['pwd2']!=""){
        $changePass=true;
    }
}

if($didPost && !formHasError()):
//    $first_Name = mysql_real_escape_string($_POST['first_Name']);
    //$last_Name = mysql_real_escape_string($_POST['last_Name']);
    $phone = mysql_real_escape_string($_POST['phone']);
    $address = mysql_real_escape_string($_POST['address']);	
    $email = mysql_real_escape_string($_POST['email']);	
    if($changePass) {
        $password = mysql_real_escape_string(sha1($_POST['pwd']));
        //$query="UPDATE users SET first_Name = '$first_Name', last_Name = '$last_Name', phone = '$phone', address = '$address', pwd = '$password', email = '$email' WHERE member_ID =$member_ID";
        $query="UPDATE users SET phone = '$phone', address = '$address', pwd = '$password', email = '$email' WHERE member_ID =$member_ID";
    }else{
        //$query="UPDATE users SET first_Name = '$first_Name', last_Name = '$last_Name', phone = '$phone', address = '$address', email = '$email' WHERE member_ID =$member_ID";
        $query="UPDATE users SET phone = '$phone', address = '$address', email = '$email' WHERE member_ID =$member_ID";
    }
        //$query="insert into users (member_ID,first_Name,last_Name,phone,address,usrStatus,pwd,email) values ('$member_ID','$first_Name','$last_Name','$phone','$address',3,'$password','$email')";
    mysql_query($query,$db) or die('Error: ' . mysql_error());
    
    //$_SESSION["first_Name"]=$first_Name;
    //$_SESSION["last_Name"]=$last_Name;
    
    if($changePass) echo '<strong>information and password updated...</strong>';
    else echo '<strong>information updated...</strong>';
endif;

$first_Name = $_SESSION['user']->first_Name;
$last_Name = $_SESSION['user']->last_Name;

//load page
if(!$didPost){
    $query="select phone,address,email from users where member_ID=$member_ID";
    $result=mysql_query($query,$db);
    if(!$result){
        die('Error: ' . mysql_error());
    }
    $row=mysql_fetch_array($result);
    $phone = $row['phone'];
    $address = $row['address'];
    $email = $row['email'];	
}else{
    //$first_Name = $_POST["first_Name"];
    //$last_Name = $_POST["last_Name"];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];	
}

$pageName = 'Edit '. $member_ID .' Profile';
include "header.inc.php"; 
?>
To change any of the information below simply correct the existing information in the boxes.<br />
(Leave Password box blank if don't want to change passwords).
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <p>
    <label>Change First Name To:
    <input type="text" name="first_Name" id="first_Name" READONLY value="<?php echo $first_Name; ?>" />
    </label>
  </p>
  <p>
    <label>Change Last Name To:
    <input type="text" name="last_Name" id="last_Name" READONLY value="<?php echo $last_Name; ?>" />
    </label>
  </p>
  <p>
    <label>Change Address To:<br />
    <textarea name="address" rows="5" id="address" style="overflow:auto"><?php echo $address; ?></textarea>
    </label>
  </p>
  <p>
    <label>Change Phone Number To:
    <input type="text" name="phone" id="phone" maxlength="<?php echo PHONELEN ?>" value="<?php echo $phone; ?>" />
    </label>
      Visible to other members?
    <input type="checkbox" name="showPhoneNum" id="showPhoneNum" />
  </p>
  <p>
    <label>Change Email Address To:
    <input type="text" name="email" id="email" value="<?php echo $email; ?>" />
    </label>
  Visible to other members?
  <input type="checkbox" name="showEmailAdd" id="showEmailAdd" />
  </p>
  <p>NTRP Rating:
    <select name="ratingNTRP" id="ratingNTRP">
      <option>1.0</option>
      <option>1.5</option>
      <option>2.0</option>
      <option>2.5</option>
      <option>3.0</option>
      <option>3.5</option>
      <option>4.0</option>
      <option>4.5</option>
      <option>5.0</option>
      <option>5.5</option>
      <option>6.0</option>
      <option>6.5</option>
      <option>7.0</option>
        </select>
 <a href="http://www.matchmakertennis.com/public/ntrp.html">What is this?</a>
 </p>
  <p>
    <label>Change Password:
    <input type="password" name="pwd" id="pwd" />
    </label>
  </p>
  <p>
    <label>Confirm Password:
    <input type="password" name="pwd2" id="pwd2" />
    </label>
  </p>
  <p>
    <input type="submit" name="Submit" id="Submit" value="Submit" />
    <input type="reset" name="resetButton" id="resetButton" value="Reset" />
  </p>
</form>

<?php
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

<p>&nbsp;</p>
<?php include 'footer.inc.php' ?>
