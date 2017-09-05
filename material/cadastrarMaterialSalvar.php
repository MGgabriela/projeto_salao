<?php
header('Content-type: text/html; charset=ISO-8859-1');

extract($_POST);

include("../banco/banco.php");
$dataValidade = implode("-",array_reverse(explode("/",$dataValidade)));
echo("insert into material values(null, '$descricaoCadastrar',$qtd,'$dataValidade',$marca,$unidade);");
mysql_query("insert into material values(null, '$descricaoCadastrar',$qtd,'$dataValidade',$marca,$unidade);")or die("Erro ao Cadastrar!!!".mysql_error());

header("location:listaMaterial.php?verifica=cadastro");

?>