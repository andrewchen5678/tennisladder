<?php require_once 'init.php';
$pageName = 'Edit Ladder Chair'; 
include "header.inc.php"; 
?>
<form id="form1" name="form1" method="post" action="">
	<?php //THIS SHOULD ALLOW THE ADMIN OR MANAGER TO FILTER OUT RESULTS ?>
  Search for ladder by 
  <select name="searchParm" id="searchParm">
    <option>Ladder ID</option>
    <option>Chair Name</option>
    <option>Gender</option>
    <option>Date</option>
    <option>Time</option>
  </select> 
  : 
  <input type="text" name="searchParamText" id="searchParamText" />
  <input type="submit" name="submitSearch" id="submitSearch" value="Submit" />
</form>
<p>
</p>
<table width="600" border="1">
  <tr>
    <th scope="col">Ladder ID</th>
    <th scope="col">Gender</th>
    <th scope="col">Date</th>
    <th scope="col">Time</th>
    <th scope="col">Chair</th>
  </tr>
  	<?php
		//this is the user "loop" to list existing users
		echo '<tr>
		<th scope="col"><a href="editLadder.php?ladderID=' . ' '/*current listed ladder ID*/. '">' ./*current listed ladder ID*/ '</a></th>
		<th scope="col">' . ' '/*current listed ladder's gender*/.'</th>
		<th scope="col">'.' '/*current listed ladder's date*/.'</th>
		<th scope="col">'.' '/*current listed ladder's time*/.'</th>
		<th scope="col">'.' '/*current listed ladder's chair*/.'</th>
		</tr>';
  ?>
</table>
<?php include 'footer.inc.php' ?>
