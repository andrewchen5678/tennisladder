<?php require_once 'init.php'; 
$pageName = 'Show Ladders';
include "header.inc.php"; 

$idToShow=intval($_GET['id']);
$resultLadder=mysql_query("select ladderID, type from ladders where ladderID=$idToShow", $db) or die("failed to select ladders");
if($row = mysql_fetch_array($resultLadder)){
	$ladderID=$row[0];
	$ladderType=$row[1];
}else{
	die("ladder doesn't exist");
}
    $userList = array();
if($ladderType==TYPE_SINGLE || $ladderType==TYPE_DOUBLEWO) {
	$query="SELECT ulid,afterwhich,recordID,first_Name,last_Name from ladderusers,users where firstuserid=recordID and ladderID=$idToShow";
    $result=mysql_query($query) or die("failed to select");
    
    while($row = mysql_fetch_array($result)){
       $userList[$row['afterwhich']]=array('ulid'=>$row['ulid'],'after'=>$row['afterwhich'],'recordID'=>$row['recordID'],'first_Name'=>$row['first_Name'],'last_Name'=>$row['last_Name']);
    }
} else {
	$query="SELECT ulid,afterwhich,users.recordID,users.first_Name,users.last_Name,partner.recordID,partner.first_Name,partner.last_Name from ladderusers,users,users as partner where firstuserid=users.recordID and partnerid=partner.recordID and ladderID=$idToShow";
    $result=mysql_query($query) or die("failed to select");
    while($row = mysql_fetch_array($result)){
       $userList[$row['afterwhich']]=array('ulid'=>$row[0],'after'=>$row[1],'recordID'=>$row[2],'first_Name'=>$row[3],'last_Name'=>$row[4],'recordID2'=>$row[5],'first_Name2'=>$row[6],'last_Name2'=>$row[7]);
    }
}    
    $sortedUserList=array();
    $sortedUserList[0]=$userList[0];
    $nextOne=$userList[$userList[0]['ulid']]; 
    $counter=1;
    while(isset($nextOne)){
        $sortedUserList[$counter]=$nextOne;
        $nextOne=$userList[$sortedUserList[$counter]['ulid']]; 
        $counter++;
    }
    //var_dump($sortedUserList);    

?>
<table width="397" border="1">
<?php if($ladderType==TYPE_SINGLE || $ladderType==TYPE_DOUBLEWO){
echo <<<BAR
  <tr>
    <th scope="col">position</th>
    <th scope="col">member ID</th>
    <th scope="col">first name</th>
    <th scope="col">last name</th>
  </tr>
BAR;

}else{
echo <<<FOO
  <tr>
    <th scope="col">position</th>
    <th scope="col">member ID</th>
    <th scope="col">first name</th>
    <th scope="col">last name</th>
    <th scope="col">partner member ID</th>
    <th scope="col">partner first name</th>
    <th scope="col">partner last name</th>	
  </tr>
FOO;
}
?>
<?php
	$counter=1;
	foreach($sortedUserList as $row){
		echo '<tr>';
		echo "<td>".$counter."</td>";
		echo '<td>'.$row['recordID'].'</td>';
		echo '<td>'.$row['first_Name'].'</td>';
		echo '<td>'.$row['last_Name'].'</td>';
		if($ladderType==TYPE_DOUBLEWP){
			echo '<td>'.$row['recordID2'].'</td>';
			echo '<td>'.$row['first_Name2'].'</td>';
			echo '<td>'.$row['last_Name2'].'</td>';
		}
		echo '</tr>';
		$counter++;
	}
?>
</table>
<?php include 'footer.inc.php' ?>