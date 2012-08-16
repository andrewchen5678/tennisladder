<?php require_once 'init.php';
requireLogin();
$pageName = 'Ladder Listing'; 
include "header.inc.php"; 
?>
<table width="400" border="1">
  <tr>
    <th scope="col">Seed</th>  
    <th scope="col">Player Name</th>
	<?php	//IF DOUBLES WTIH PARTNER MATCH
	$hasDouble = true;
	if ($hasDouble) {
		echo '<th scope="col">Partner Name</th>';
	}
	?>
    <th scope="col">Playing?</th>
  </tr>
  <th scope="row"> 
  <?php echo "Player's Seed"; ?>
  </th>
  <th scope="row">
  <?php echo "Player\'s Name"; ?>
  </th>
  
  <?php
  if ($hasDouble) {
  	echo'  <th scope="row">
	Player\'s Name
  </th>';
  }
  ?>
  <th scope="row">
  
  <?php
  	//Have it dynamically increase the length of the table
	//based on the number of players in this ladder (build a "getPlayList()" function)
	//For the "Playing?" field use the following code:
  ?>
  <form id="form1" name="form1" method="post" action="">
  <input type="checkbox" name="isPlaying" id="isPlaying" />
</form>
  </th>
</table>

<p>&nbsp;</p>
<p>
  <?php include 'footer.inc.php' ?>
