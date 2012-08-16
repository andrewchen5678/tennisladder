<?php require_once 'init.php';
requireLogin();
$pageName = 'Ladders'; 
include "header.inc.php"; 
?>
<table width="386" border="1">
  <tr>
    <th scope="col">Ladder</th>  
    <th scope="col">Type</th>
    <th scope="col">Day</th>
    <th scope="col">Time</th>
    <th scope="col">Manager</th>
  </tr>
  <?php
	$result = mysql_query("select distinct(ladders.ladderID),gender,type,day,time,managerID from ladders,ladderusers where ladders.ladderID=ladderusers.ladderID and (firstuserid=".intval($_SESSION['user']->recordID)." or partnerid=".intval($_SESSION['user']->recordID).")", $db) or die("failed to select ladders". mysql_error());
	while($row = mysql_fetch_array($result)){
	$ladderID=$row['ladderID'];
		echo '<tr>';
		echo "<td><a href='showladder.php?id=$ladderID'>$ladderID</a></td>";
		echo '<td>'.tl_ladderType($row['gender'],$row['type']).'</td>';
		echo '<td>'.tl_getDayOfWeek($row['day']).'</td>';
		echo '<td>'.$row['time'].'</td>';
		
		$manager = mysql_query("select first_Name, last_Name from users where recordID=".mysql_real_escape_string($row['managerID']), $db) or die("failed to select manager");
		if($rowMgr=mysql_fetch_row($manager)){
			echo '<td>'."$rowMgr[0] $rowMgr[1]".'</td>';
		}else{
			echo '<td>---</td>';
		}
		echo '</tr>';
	}
  ?>
</table>
<?php include 'footer.inc.php' ?>
