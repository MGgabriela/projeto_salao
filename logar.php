<?php

include("banco/banco.php");

$login = $_POST['login'];

$senha = md5($_POST['senha']);


$sql = (mysql_query("select u.nivel, f.nome from usuario u, funcionario f where f.idfuncionario=u.idfuncionario and login='$login' and senha='$senha';"));

$busca = mysql_num_rows($sql);

if( $busca == 1 ){
  	
  session_start();
  
  $result = mysql_fetch_array($sql);
  
  $_SESSION['login'] = $login;
  $_SESSION['nivel'] = $result[0];
  $_SESSION['nome'] = $result[1];
  
  header("location:index.php");
	
}else{
  header("location:login.php?verifica=dados");
}


?>