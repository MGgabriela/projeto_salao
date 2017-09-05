<?php
 
     include("../banco/banco.php");

	
	if(isset($_GET['seiCadastrar'])){
		$seiCadastrar = $_GET['seiCadastrar'];
		
		$logins_cadastrados = mysql_num_rows(mysql_query("select sei from turma where sei='$seiCadastrar'"));
		
	}
	else
		if(isset($_GET['descricaoAlterar'])){
			$descricaoAlterar = $_GET['descricaoAlterar'];
			$descricaoAlterarA = $_GET['descricaoAlterarA'];
			
			if($descricaoAlterar != $descricaoAlterarA)
				$logins_cadastrados = mysql_num_rows(mysql_query("select descricao from turma where descricao='$descricaoAlterar'"));
			else
				$logins_cadastrados=0;
	}
			

	if( $logins_cadastrados == 0 )
		echo "true";
	else
		echo "false";
	//exit();
?>