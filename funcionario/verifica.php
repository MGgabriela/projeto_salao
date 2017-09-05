<?php
 
     include("../banco/banco.php");

	
	if(isset($_GET['usuarioCadastrar'])){
		$campo = $_GET['usuarioCadastrar'];
		
		$logins_cadastrados = mysql_num_rows(mysql_query("select login from usuario where login='$campo'"));
		
	}
	else
		if(isset($_POST['usuarioAlterar'])){
			$usuarioAlterar = $_POST['usuarioAlterar'];
			$usuarioAlterarA = $_POST['usuarioAlterarA'];
			
			if($usuarioAlterar==$usuarioAlterarA){
				$logins_cadastrados=0;
			}else{
				$logins_cadastrados = mysql_num_rows(mysql_query("select login from usuario where login='$usuarioAlterar';"));
			}

			
		}
		
	if( $logins_cadastrados == 0 )
		echo "true";
	else
		echo "false";
	//exit();
?>