<?php
include("../restrito.php"); $nivel = $_SESSION['nivel']; $nome = $_SESSION['nome']; include("../banco/banco.php"); 
$idFuncionario = $_GET['idFuncionario'];





mysql_query("delete from telefonefuncionario where idfuncionario=$idFuncionario;")or die("Erro ao Excluir Telefone do Funcionario");

mysql_query("delete from emailfuncionario where idfuncionario=$idFuncionario;")or die("Erro ao Excluir Email do Funcionario");

mysql_query("delete from usuario where idfuncionario=$idFuncionario;")or die("Erro ao Excluir Usuario do Funcionario");

mysql_query("delete from funcionario where idfuncionario=$idFuncionario;")or die("Erro ao Excluir o Funcionario");
header("location:listaFuncionario.php?verifica=exclui");




?>