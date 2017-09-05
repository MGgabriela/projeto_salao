<?php
include("../restrito.php"); $nivel = $_SESSION['nivel']; $nome = $_SESSION['nome']; include("../banco/banco.php"); 
$idCargo = $_GET['idCargo'];

$cont = mysql_num_rows(mysql_query("select * from funcionario where idCargo=$idCargo;"));

if($cont>0)
	header("location:listaCargo.php?verifica=existe");

mysql_query("delete from cargo where idCargo=$idCargo;")or die("Erro ao Excluir");
header("location:listaCargo.php?verifica=exclui");
?>