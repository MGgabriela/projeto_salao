<?php
include("../restrito.php"); $nivel = $_SESSION['nivel']; $nome = $_SESSION['nome']; include("../banco/banco.php"); 
$idModelo = $_GET['idModelo'];



mysql_query("delete from materialmodelo where idModelo=$idModelo;")or die("Erro ao Excluir Material Modelo");

mysql_query("delete from modelo where idModelo=$idModelo;")or die("Erro ao Excluir Modelo");


header("location:listaModelo.php?verifica=exclui");
?>