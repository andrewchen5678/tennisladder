<?php
if (!defined('ACCESS_INCLUDE'))
{
	$selfname=$_SERVER['PHP_SELF'];
	die("direct access to $selfname denied");
}
if(!empty($db)){
//echo "<strong>closing mysql connection...</strong>";
 mysql_close($db);
}
?>
</div>
</body>
</html>