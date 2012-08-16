<?php 
require_once 'init.php'; 
include 'validEmail.php';

requireManager();

$didPost=isset($_POST['Submit']);

$member_ID=intval($_SESSION['user']->member_ID);

$ladderEditID=intval($_GET['id']);

if($didPost){
    
    $day=0;
    foreach($_POST['dayCheckBox'] as $value){
        $day=$day | intval($value);
    }    
    
if(!($datetime = date_create($_POST["timeL"]))){
    inputError('day','not valid date/time');
}else{
 //date_format($datetime, 'h:i:s');
}

}

if($didPost && !formHasError()):

    $dayfromdb = mysql_real_escape_string($day);	
    $timefromdb = mysql_real_escape_string(date_format($datetime, 'h:i:s'));	

        $query="UPDATE ladders SET day = '$dayfromdb', time = '$timefromdb' WHERE ladderID =$ladderEditID";

    mysql_query($query,$db) or die('Error: ' . mysql_error());
    

    echo '<strong>information updated...</strong>';
endif;

$first_Name = $_SESSION['user']->first_Name;

//load page

    $query="select * from ladders where ladderID=$ladderEditID";
    $result=mysql_query($query,$db);
    if(!$result){
        die('Error: ' . mysql_error());
    }
    if(!$row=mysql_fetch_array($result)){
        die("ladder doesn't exist:");
    }
    $managerID = intval($row['managerID']);
    if(!isAdmin() && $managerID != $_SESSION['user']->member_ID){
        die("Managers not allowed to edit other manager's ladder");
    }
    
    $genderfromdb = intval($row['gender']);
    $typefromdb = intval($row['type']);
    $dayfromdb = intval($row['day']);
    $timefromdb = $row['time'];
    
if(!$didPost){
    $gender=$genderfromdb;
    $type=$typefromdb;
    $day=$dayfromdb;
    $time=$timefromdb;
}else{
    $gender=$_POST["genderGroup"];
    $type=$_POST["ladderType"];
    $time=$_POST["timeL"];
}

$pageName = 'Edit Ladder';
include "header.inc.php"; 
?>
<?php echo "Ladder: $ladderEditID" ."<br>";
echo "Gender: ".$tl_gender[$genderfromdb]."<br>";
echo "Type: ".$tl_singledouble[$typefromdb]."<br>";
echo "Day: ".tl_getDayOfWeek($dayfromdb)."<br>";
echo "Time: ".$timefromdb."<br>";
 ?>
To change any of the information below simply correct the existing information in the boxes.<br />
(Leave Password box blank if don't want to change passwords).
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']."?id=$ladderEditID"; ?>">

  <p>
    Time:
    <input type="text" name="timeL" id="timeL" value="<?php echo $time ?>" />
  hh:mm:ss (ex. 12:30:00) 
<?php /*  
  <select name="amPM" id="amPM">
    <option>AM</option>
    <option>PM</option>
  </select>
  */
  ?>
  </p>
  <p>Days: (check all that apply) </p>
  <p>Monday:
    <input type="checkbox" name="dayCheckBox[]" id="monDay" value="<?php echo WK_MONDAY ?>" <?php if(($day & WK_MONDAY)==WK_MONDAY) echo "checked"; ?> />
Tuesday:
<input type="checkbox" name="dayCheckBox[]" id="tuesDay" value="<?php echo WK_TUESDAY ?>" <?php if(($day & WK_TUESDAY)==WK_TUESDAY) echo "checked"; ?> />
  Wednesday:
  <input type="checkbox" name="dayCheckBox[]" id="wednesDay" value="<?php echo WK_WEDNESDAY ?>" <?php if(($day & WK_WEDNESDAY)==WK_WEDNESDAY) echo "checked"; ?> />
  Thursday:
  <input type="checkbox" name="dayCheckBox[]" id="thursDay" value="<?php echo WK_THURSDAY ?>" <?php if(($day & WK_THURSDAY)==WK_THURSDAY) echo "checked"; ?> />
  </p>
  <p>Friday:
    <input type="checkbox" name="dayCheckBox[]" id="friDay" value="<?php echo WK_FRIDAY ?>" <?php if(($day & WK_FRIDAY)==WK_FRIDAY) echo "checked"; ?> />
  Saturday:
  <input type="checkbox" name="dayCheckBox[]" id="saturDay" value="<?php echo WK_SATURDAY ?>" <?php if(($day & WK_SATURDAY)==WK_SATURDAY) echo "checked"; ?> />
  Sunday:
  <input type="checkbox" name="dayCheckBox[]" id="sunDay" value="<?php echo WK_SUNDAY ?>" <?php if(($day & WK_SUNDAY)==WK_SUNDAY) echo "checked"; ?> />
  </p>
  <p>Chair:
  <?php if(isAdmin()){ 
        echo '
        <select name="chairL" id="chairL">
          <option>chair1</option>
          <option>chair2</option>
        </select>
        ';
    }else{
        echo $_SESSION['user']->first_Name." ".$_SESSION['user']->last_Name;
    }
  ?>
  </p>
  <p>
    <label><br />
    </label>
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
