<?php
header('Content-type: text/html; charset=ISO-8859-1');

extract($_POST);

include("../banco/banco.php");
$dataValidade = implode("-",array_reverse(explode("/",$dataValidade)));

mysql_query("update material set descricao='$descricaoAlterar',qtd=$qtd, dataValidade='$dataValidade', idMarca=$marca, idUnidade=$unidade where idMaterial=$idMaterial and idMarca=$marca;")or die("Erro ao Alterar!!!");

header("location:listaMaterial.php?verifica=alterar");

?>