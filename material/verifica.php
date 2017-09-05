<?php
 
     include("../banco/banco.php");

	
	if(isset($_POST['descricaoCadastrar'])){
		$descricaoCadastrar = $_POST['descricaoCadastrar'];
		$marca = $_POST['marca'];
		
		$logins_cadastrados = mysql_num_rows(mysql_query("select idMaterial from material where descricao='$descricaoCadastrar' and idMarca=$marca;"));
		
	}
	else
		if(isset($_POST['descricaoAlterar'])){
			$descricaoAlterar = $_POST['descricaoAlterar'];
			$marcaA = $_POST['marcaA'];
			$marca = $_POST['marca'];
			$descricaoA = $_POST['descricaoA'];
			
			if(($marca!=$marcaA)||($descricaoAlterar!=$descricaoA))
				$logins_cadastrados = mysql_num_rows(mysql_query("select idMaterial from material where descricao='$descricaoAlterar' and idMarca=$marca;"));
			else
				$logins_cadastrados = 0;
			
		}

	if( $logins_cadastrados == 0 )
		echo "true";
	else
		echo "false";
	//exit();
?>