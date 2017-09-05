<?php
include("../restrito.php");
header('Content-type: text/html; charset=ISO-8859-1');

extract($_POST);

include("../banco/banco.php");


$login = $_SESSION['login'];


date_default_timezone_set('America/Sao_Paulo');
$date = date('Y-m-d');

mysql_query("insert into modelo values(null, '$descricaoCadastrar','$date',(select idFuncionario from usuario where login='$login'));")or die("Erro ao Cadastrar!!!");

if(!empty($material[0])){
	$id = mysql_insert_id();
	$i = 0;
	foreach(array_combine($material , $qtd) as $m => $q){
		
		mysql_query("insert into materialmodelo values($m, $id, $q);")or die("Erro ao cadastrar o Material Modelo!".mysql_error());
		
	}
}

header("location:listaModelo.php?verifica=cadastro");






?>