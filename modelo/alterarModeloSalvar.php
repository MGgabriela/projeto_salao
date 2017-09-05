<?php
header('Content-type: text/html; charset=ISO-8859-1');

extract($_POST);

include("../banco/banco.php");


mysql_query("update modelo set descricao='$descricaoAlterar' where idModelo=$descricaoAntigo;")or die("Erro ao Alterar!!!");



if(!empty($material[0])){
	mysql_query("delete from materialmodelo where idModelo=$descricaoAntigo")or die("Erro ao Excluir Tudo Material Modelo".mysql_error());
	echo("delete fom materialmodelo where idModelo=$descricaoAntigo");
	$id = mysql_insert_id();
	$i = 0;
	foreach(array_combine($material , $qtd) as $m => $q){
		
		mysql_query("insert into materialmodelo values($m, $descricaoAntigo, $q);")or die("Erro ao cadastrar o Material Modelo!".mysql_error());
		
	}
}

header("location:listaModelo.php?verifica=alterar");

?>