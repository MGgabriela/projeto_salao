<?php
header('Content-type: text/html; charset=ISO-8859-1');

extract($_POST);

include("../banco/banco.php");


mysql_query("update unidade set descricao='$descricaoAlterar' where idunidade=$descricaoAntigo;")or die("Erro ao Alterar!!!");

header("location:listaUnidade.php?verifica=alterar");

?>