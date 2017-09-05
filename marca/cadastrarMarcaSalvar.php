<?php
header('Content-type: text/html; charset=ISO-8859-1');

extract($_POST);

include("../banco/banco.php");

mysql_query("insert into marca values(null, '$descricaoCadastrar');")or die("Erro ao Cadastrar!!!");

header("location:listaMarca.php?verifica=cadastro");

?>