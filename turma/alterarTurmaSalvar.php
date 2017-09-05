<?php
header('Content-type: text/html; charset=ISO-8859-1');

extract($_POST);

include("../banco/banco.php");


mysql_query("update turma set descricao='$descricaoAlterar' where idTurma=$descricaoAntigo;")or die("Erro ao Alterar!!!");



if(!empty($material[0])){
	mysql_query("delete from materialturma where idTurma=$descricaoAntigo")or die("Erro ao Excluir Tudo Material Turma".mysql_error());
	echo("delete fom materialturma where idTurma=$descricaoAntigo");
	$id = mysql_insert_id();
	$i = 0;
	foreach(array_combine($material , $qtd) as $m => $q){
		
		mysql_query("insert into materialturma values($m, $descricaoAntigo, $q);")or die("Erro ao cadastrar o Material Turma!".mysql_error());
		
	}
}

header("location:listaTurma.php?verifica=alterar");

?>