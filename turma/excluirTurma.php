<?php
include("../restrito.php"); $nivel = $_SESSION['nivel']; $nome = $_SESSION['nome']; include("../banco/banco.php"); 
$idTurma = $_GET['idTurma'];



mysql_query("delete from materialturma where idTurma=$idTurma;")or die("Erro ao Excluir Material Turma");

mysql_query("delete from turma where idTurma=$idTurma;")or die("Erro ao Excluir Turma");


header("location:listaTurma.php?verifica=exclui");
?>