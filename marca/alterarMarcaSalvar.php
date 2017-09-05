<?php
header('Content-type: text/html; charset=ISO-8859-1');

extract($_POST);

include("../banco/banco.php");


mysql_query("update marca set descricao='$descricaoAlterar' where idmarca=$descricaoAntigo;")or die("Erro ao Alterar!!!");

header("location:listaMarca.php?verifica=alterar");

?>