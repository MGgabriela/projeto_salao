<?php
header('Content-type: text/html; charset=ISO-8859-1');

extract($_POST);

include("../banco/banco.php");


mysql_query("update cargo set descricao='$descricaoAlterar' where idCargo=$descricaoAntigo;")or die("Erro ao Alterar!!!");

header("location:listaCargo.php?verifica=alterar");

?>