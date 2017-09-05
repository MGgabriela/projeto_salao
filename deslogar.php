<?php

session_start();

@session_destroy();
$_SESSION['login'] = NULL;
unset($_SESSION['login']);

$urlEndereco  = $_SERVER ['REQUEST_URI']; 
$array = $pieces = explode("/", $urlEndereco);
$array = array_unique($array);
$array = implode("/", $array); 
							 
header("location:login.php?verifica=deslogou");
exit;
?>