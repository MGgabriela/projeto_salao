<?php include("../restrito.php"); $nivel = $_SESSION['nivel']; $nome = $_SESSION['nome']; include("../banco/banco.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Senac</title>
        
        <!-- define a viewport -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
        
        <!-- adicionar CSS Bootstrap -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
        
        <!-- css personalizado -->
        <link href="../css/estilo.css" rel="stylesheet" media="screen">
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width">    
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/main.js"></script>
        <script src="../js/jquery-1.11.2.min.js" type="text/javascript"> </script>



 
    	<!--script da janela modal de exclusão-->
		<script src="../js/jquery.confirm.js"></script>
    	<script src="../js/bootstrap3-0-2.min.js"></script>







		<script type="text/javascript"> 
		   
        $(document).ready(function() { 
    		setTimeout(function() { 
        		$('#mess').fadeOut(); 
 			}, 3000); 
			
			
			setTimeout(function() { 
        		$('#erro').fadeOut(); 
 			}, 7000); 
			
			
		});
        </script>
        
        
   	
   
    </head>
    <body>
    
<!-- Menu Superior -->
<?php include("../menuSuperior.php"); ?>

    <div class="container-fluid">
        <div class="row-fluid">
			<!-- Menu lateral //usa 3 colunas// -->
			<?php include("../menuLateral.php"); ?>
            
            <div class="col-md-9">
            
            
            
            
            
              <!--Painel de Busca-->
           		<div class="panel panel-default">
                	<div class="panel-heading">Pesquisa</div>
                    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="get">
                        <div class="form-group">
                            <label for="descricaoCadastrar"></label>
                            <input placeholder="Busca Por Cargo" name="nome" type="text">
                            <button type="submit" class="btn btn-default">Buscar</button>
                        </div>
        			</form>
           		</div>    
          	<!--Fim Painel de Busca-->
            
            
            
            
            
                 
      
          <div class="panel panel-default">
      <!-- Default panel contents -->
       <?php  
	  	if(isset($_GET['verifica'])){
			$verifica = $_GET['verifica'];
			if($verifica=="cadastro")
				echo("<div id=\"mess\" class=\"alert alert-success\" role=\"alert\">Dados Cadastrados com Sucesso!!!</div>");
			else
				if($verifica=="exclui")
					echo("<div id=\"mess\" class=\"alert alert-success\" role=\"alert\">Dados Excluidos com Sucesso!!!</div>");
				else
					if($verifica=="existe")
						echo("<div id=\"erro\" class=\"alert alert-danger\" role=\"alert\">Esse Cargo tem Funcionários Associados a ele. Devido a isso não há como Exclui-lô!!!</div>");
					else
						if($verifica=="alterar")
							echo("<div id=\"mess\" class=\"alert alert-success\" role=\"alert\">Alterado com Sucesso!!!</div>");
		}
	  ?>
   
      <div class="panel-heading">Cargo</div>
             <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Descrição</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php 
					 
					 
					 	$buscaG="";
						if((isset($_GET['nome']) && !empty($_GET['nome']))){
					
						  if(!empty($_GET['nome'])){
							$nome = $_GET['nome'];	
							$buscaG = " where descricao like '%$nome%'";
						  }
						}
						
					
						//paginação:
						$numreg = 10; // Quantos registros por página será mostrado
						if( isset( $_GET['pg'] ))
						  $pg =  $_GET['pg'];
						  
						if (!isset($pg)) {
							$pg = 0;
						}
						$inicial = $pg * $numreg;
						
						$b = "select idCargo, descricao from cargo $buscaG order by descricao LIMIT $inicial, $numreg;";
						
						
						$busca = mysql_query($b);
						
						$b = "select idCargo, descricao from cargo $buscaG";
						
						$sql_conta = mysql_query($b);
						
						$quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação
					
						
						if(mysql_num_rows($busca)>0){
						 
							while($result = mysql_fetch_array($busca)){
                     ?>
                     <tr>
					 	<td><?php echo($result[1]); ?></td>  
                        <td>
                        <a  title="Editar Registro" href="alterarCargo.php?idCargo=<?php echo($result[0]); ?>" class="btn btn-info glyphicon glyphicon-pencil"> Alterar</a>
                        </td>
                        <td> <a  title="Ecluir Registro" href="excluirCargo.php?idCargo=<?php echo($result[0]); ?>" class="btn btn-danger simpleConfirm glyphicon glyphicon-trash"> Excluir</a> </td>                       
                     <?php }}else{ ?>
                     
                     <td colspan="3"><label for="Nao">Não há Cargos</label>  </td> 
                     
                     <?php } ?>
                     
                    
					
                    
                    </tbody>
                   
                  </table>
                   <label for="Paginacao"> <?php if(mysql_num_rows($busca)>0){ include("../paginacao.php"); }?></label>
                  </div>
                </div>
             </div>
            
        </div>
    </div>
   
   	<script type="text/javascript"> 
        	$(".simpleConfirm").confirm();
    </script>
   
    </body>
</html>


