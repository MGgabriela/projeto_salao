<?php
include("../restrito.php"); $nivel = $_SESSION['nivel']; $nome = $_SESSION['nome']; include("../banco/banco.php"); 
$idMarca = $_GET['idMarca'];

$cont = mysql_num_rows(mysql_query("select * from material where idmarca=$idMarca;"));

if($cont>0)
	header("location:listaMarca.php?verifica=existe");

mysql_query("delete from marca where idmarca=$idMarca;")or die("Erro ao Excluir");
header("location:listaMarca.php?verifica=exclui");
?>