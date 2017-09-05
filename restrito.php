<?php
session_start();
if(isset($_SESSION["login"])){
	
}else{
	session_destroy();
	header("location:login.php?verifica=false");
}

?>