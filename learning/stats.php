<?php require_once 'init.php'; 
requireLogin();

$selecttype=array(
'Singles',
'Doubles w/o partner',
'Doubles w partner',
'Mix Doubles'
); 

//$didPost=isset($_POST['Submit']);

$pageName = 'My Stats';
include "header.inc.php"; 
?>
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <p>You are 
<?php echo 'SEAT NUMBER' //GET SEAT FOR CURRENT LADDER SELECTED ?>
  seed in the 
  <select name="listLadders" id="listLadders">
  <?php
    //FOR LOOP TO PRINT ALL APPLICABLE LADDERS FOR USER
    foreach ($selecttype as $value)
    {
        echo "<option value='$value'>$value</option>";
    } 

/*
	  	echo '<option>Singles</option>';
		echo '<option>Doubles w/o partner</option>';
		echo '<option>Doubles w partner</option>';
		echo '<option>Mix Doubles</option>';
*/
  ?>
  </select>
  ladder.</p>
  <p>Last
    <input name="numToDisplay" type="text" id="numToDisplay" value="10" size="4" maxlength="4" /> 
    games: 
    <input type="submit" name="refresh" id="refresh" value="Refresh" />
  </p>

<table width="500" border="1">
    <tr> <b>
      <td width="100"><div align="center">Date</div></td>
      <td width="200"><div align="center">Opponent</div></td>
      <td width="178"><div align="center">Win/Loss</div></td>
    </b>
    </tr>
<?php
if ($_POST["listLadders"]=='Doubles w/o partner'){

} else if ($_POST["listLadders"]=='Doubles w/o partner'){

} else if ($_POST["listLadders"]=='Doubles w partner'){

} else { //single or not submitted
    $result = mysql_query("SELECT m.matchdate,u1.First_Name as u1First,u2.First_Name as u2First FROM matchsingle AS m,users AS u1,users AS u2 WHERE (m.firstUserID=".$_SESSION['user']->recordID.
    " OR m.secondUserID=".$_SESSION['user']->recordID.") and m.firstUserID=u1.recordID and m.secondUserID=u2.recordID", $db) or die("failed to select stats:".mysql_error());
    
    print_r($result);
    while($row=mysql_fetch_assoc($result)){
        
        echo '<tr><td>'.$row['matchdate'].'</td><td>'.$row['u1First'].'</td><td>'.$row['u2First'].'</td></tr>';
    }
  }
?>  
    </table>
</form>
<?php include 'footer.inc.php' ?>
