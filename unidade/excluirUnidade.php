<?php
include("../restrito.php"); $nivel = $_SESSION['nivel']; $nome = $_SESSION['nome']; include("../banco/banco.php"); 
$idUnidade = $_GET['idUnidade'];

$cont = mysql_num_rows(mysql_query("select * from material where iduniade=$idUnidade;"));

if($cont>0)
	header("location:listaUnidade.php?verifica=existe");

mysql_query("delete from unidade where idunidade=$idUnidade;")or die("Erro ao Excluir");
header("location:listaUnidade.php?verifica=exclui");
?>