<?php
include("../restrito.php"); $nivel = $_SESSION['nivel']; $nome = $_SESSION['nome']; 

header('Content-type: text/html; charset=ISO-8859-1');

extract($_POST);

include("../banco/banco.php");


mysql_query("insert into funcionario values(null, '$matricula', '$nome', $cargo);")or die("Erro ao cadastrar Funcionario!");
$id = mysql_insert_id();


$telefone = array_unique($telefone);
$telefone = array_filter($telefone);
$telefone = array_values($telefone);


foreach($telefone as $tel){

	mysql_query("insert into telefonefuncionario values($id, '$tel');")or die("Erro ao cadastrar o Telefone!".mysql_error());
	
}

$email = array_unique($email);
$email = array_filter($email);
$email = array_values($email);


foreach($email as $e){
	
	mysql_query("insert into emailfuncionario values($id, '$e');")or die("Erro ao cadastrar o Email!".mysql_error());
	
}


if(isset($adm)){
	$senha = md5($senha);
	mysql_query("insert into usuario values('$usuarioCadastrar', '$senha',$nivel,$id);")or die("Erro ao cadastrar o Usuario!".mysql_error());
}


header('location:listaFuncionario.php?verifica=cadastro');

?>