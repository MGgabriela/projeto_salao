<?php
 
     include("../banco/banco.php");

	
	if(isset($_GET['descricaoCadastrar'])){
		$campo = $_GET['descricaoCadastrar'];
		
		$logins_cadastrados = mysql_num_rows(mysql_query("select descricao from cargo where descricao='$campo'"));
		
	}
	else
		if(isset($_GET['descricaoAlterar'])){
			$campo = $_GET['descricaoAlterar'];
			$logins_cadastrados = mysql_num_rows(mysql_query("select descricao from cargo where descricao='$campo';"));	
		}

	if( $logins_cadastrados == 0 )
		echo "true";
	else
		echo "false";
	//exit();
?>