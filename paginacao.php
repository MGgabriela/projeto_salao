<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.pgoff {font-family: Verdana, Arial, Helvetica; font-size: 11px; color: #FF0000; text-decoration: none}
a.pg {font-family: Verdana, Arial, Helvetica; font-size: 11px; color: #003366; text-decoration: none}
a:hover.pg {font-family: Verdana, Arial, Helvetica; font-size: 11px; color: #0066cc; text-decoration:underline}
-->
</style>
<?php
    
	$quant_pg = ceil($quantreg/$numreg);
	$quant_pg++;
	
	$nome="";
	$tel="";
	if((isset($_GET['nome']) && !empty($_GET['nome']))||(isset($_GET['tel']) && !empty($_GET['tel']) )){
	  if(!empty($_GET['nome'])){
	    $nome = $_GET['nome'];	
	  }
      if(!empty($_GET['tel']) ){
	    $tel = $_GET['tel'];
	  }
	}
	
	
	// Verifica se esta na primeira página, se nao estiver ele libera o link para anterior
	if ( $pg > 0) { 
		echo "<a href=".$_SERVER["PHP_SELF"]."?nome=".$nome."&tel=".$tel."&pg=".($pg-1)."class=pg><b>&laquo; anterior</b></a>";
	} else { 
		echo "<font color=#CCCCCC>&laquo; anterior</font>";
	}
	
	// Faz aparecer os numeros das página entre o ANTERIOR e PROXIMO
    $cont = 0;
	for($i_pg=1;$i_pg<$quant_pg;$i_pg++) { 
	    
		$cont = ( $cont + 1 ); 
		if ( ( $cont == 20 ) && ( $i_pg <= 100 ) ) {
		  echo("<br>");
		  $cont = 0;
		}
		
		if( ( ( $i_pg > 100 ) && ( $cont == 15 ) ) || ( ( $i_pg > 100 ) && ( $cont > 15 ) ) ){
		  echo("<br>");
		  $cont = 0;	
		}
		
		

		 
		 
		 
		 
		// Verifica se a página que o navegante esta e retira o link do número para identificar visualmente
		if ($pg == ($i_pg-1)) { 
			echo "&nbsp;<span class=pgoff>[$i_pg]</span>&nbsp;";
		} else {
			$i_pg2 = $i_pg-1;
			echo "&nbsp;<a href=".$_SERVER["PHP_SELF"]."?nome=".$nome."&tel=".$tel."&pg=$i_pg2 class=pg><b>$i_pg</b></a>&nbsp;";
		}
	}
	
	// Verifica se esta na ultima página, se nao estiver ele libera o link para próxima
	if (($pg+2) < $quant_pg) { 
		echo "<a href=".$_SERVER["PHP_SELF"]."?nome=".$nome."&tel=".$tel."&pg=".($pg+1)." class=pg><b>pr&oacute;ximo &gt;&gt;</b></a>";
	} else { 
		echo "<font color=#CCCCCC>pr&oacute;ximo &gt;&gt;</font>";
	}
?>
