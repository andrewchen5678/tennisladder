<?php
session_start();
session_destroy(); 
/*if(isset($_SERVER['HTTP_REFERER'])){
  header("Location: ".$_SERVER['HTTP_REFERER']);
  die();
}else{*/
  header("Location: dologin.php");
  die();
//}
?>