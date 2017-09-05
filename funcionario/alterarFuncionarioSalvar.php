<?php
include("../restrito.php"); $nivel = $_SESSION['nivel']; $nome = $_SESSION['nome']; include("../banco/banco.php");





header('Content-type: text/html; charset=ISO-8859-1');

extract($_POST);


mysql_query("update funcionario set matricula='$matricula', nome='$nome', idcargo=$cargo where idfuncionario=$idFuncionario;")or die("Erro ao Alterar Funcionario!");
$id = mysql_insert_id();




mysql_query("delete from telefonefuncionario where idfuncionario=$idFuncionario;")or die("Erro ao Excluir Telefone do Funcionario");

$telefone = array_unique($telefone);
$telefone = array_filter($telefone);
$telefone = array_values($telefone);


foreach($telefone as $tel){

	mysql_query("insert into telefonefuncionario values($idFuncionario, '$tel');")or die("Erro ao cadastrar o Telefone!".mysql_error());
	
}





mysql_query("delete from emailfuncionario where idfuncionario=$idFuncionario;")or die("Erro ao Excluir Email do Funcionario");
$email = array_unique($email);
$email = array_filter($email);
$email = array_values($email);


foreach($email as $e){
	
	mysql_query("insert into emailfuncionario values($idFuncionario, '$e');")or die("Erro ao cadastrar o Email!".mysql_error());
	
}


if(isset($adm1)){
	
	
	$sql="";
	if($usuarioAlterar!=$usuarioAlterarA){
    	$sql = " login='$usuarioAlterar', ";
		
	}
		
	if($senha!="●●●●●●●"){
		$senha = md5($senha);
		$sql .= " senha='$senha', ";
		
	}
		
	mysql_query("update usuario set $sql nivel=$nivel where idfuncionario=$idFuncionario;")or die("Erro ao Altear o Usuario!".mysql_error());
}else{
	if(isset($adm2)){
		$senha = md5($senha);
		
		mysql_query("insert into usuario values('$usuarioCadastrar', '$senha', $nivel ,$idFuncionario);")or die("Erro ao Cadastrar o Usuario!".mysql_error());
	}}


header('location:listaFuncionario.php?verifica=alterar');



?>