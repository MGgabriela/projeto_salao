<?php
include("../restrito.php");
header('Content-type: text/html; charset=ISO-8859-1');

extract($_POST);

include("../banco/banco.php");


$login = $_SESSION['login'];




mysql_query("insert into turma values(null, '$seiCadastrar','$descricao','$dataInicio','$dataFim','$turno',(select idFuncionario from usuario where login='$login'));")or die("Erro ao Cadastrar!!!");
$id = mysql_insert_id();
if(!empty($material[0])){
	$id = mysql_insert_id();
	$i = 0;
	foreach(array_combine($material , $qtd) as $m => $q){
		
		mysql_query("insert into materialturma values($id, $m, $q);")or die("Erro ao cadastrar o Material Turma!".mysql_error());
		
	}
}

header("location:listaTurma.php?verifica=cadastro");






?>