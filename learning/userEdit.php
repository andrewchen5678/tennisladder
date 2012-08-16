<?php require_once 'init.php';
$pageName = 'Edit Users'; 
include "header.inc.php"; 
?>
<form id="form1" name="form1" method="post" action="">
	<?php //THIS SHOULD ALLOW THE ADMIN OR MANAGER TO FILTER OUT RESULTS ?>
  Search for user by 
  <select name="searchParm" id="searchParm">
    <option>Name</option>
    <option>Member ID</option>
  </select> 
  : 
  <input type="text" name="searchParamText" id="searchParamText" />
  <input type="submit" name="submitSearch" id="submitSearch" value="Submit" />
</form>
<p>
</p>
<table width="600" border="1">
  <tr>
    <th scope="col">Member ID</th>  
    <th scope="col">Name</th>
    <th scope="col">Email Address</th>
    <th scope="col">Phone Number</th>
    <th scope="col">Address</th>
  </tr>
  	<?php
		//this is the user "loop" to list existing users
		echo '<tr>
		<th scope="col"><a href="managerProfile.php?user=' . ' '/*current listed user's ID*/. '">' ./*current listed user's ID*/ '</a></th>
		<th scope="col">' . ' '/*current listed user's name*/.'</th>
		<th scope="col">'.' '/*current listed user's email address*/.'</th>
		<th scope="col">'.' '/*current listed user's phone number*/.'</th>
		<th scope="col">'.' '/*current listed user's address*/.'</th>
		</tr>';
  ?>
</table>
<?php include 'footer.inc.php' ?>
