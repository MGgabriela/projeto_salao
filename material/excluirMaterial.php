<?php
include("../restrito.php"); $nivel = $_SESSION['nivel']; $nome = $_SESSION['nome']; include("../banco/banco.php"); 
$idMaterial = $_GET['idMaterial'];


mysql_query("delete from material where idMaterial=$idMaterial;")or die("Erro ao Excluir");
header("location:listaMaterial.php?verifica=exclui");
?>