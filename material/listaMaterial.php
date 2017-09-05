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
                            <input placeholder="Busca Por Material" name="nome" type="text">
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
						echo("<div id=\"erro\" class=\"alert alert-danger\" role=\"alert\">O item a ser excluido já esta associado. Devido a isso não há como Exclui-lô!!!</div>");
					else
						if($verifica=="alterar")
							echo("<div id=\"mess\" class=\"alert alert-success\" role=\"alert\">Alterado com Sucesso!!!</div>");
		}
	  ?>
   
      <div class="panel-heading">Material</div>
             <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Descrição</th>
                        <th>Quantidade</th>
                        <th>Marca</th>
                        <th>Registrar Entrada</th>
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
							$buscaG = " and m.descricao like '%$nome%' ";
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
						
						$b = "select m.descricao, m.qtd, ma.descricao, u.descricao, m.idMaterial, DATE_FORMAT(m.dataValidade, '%d/%m/%Y') from material m, unidade u, marca ma where m.idunidade=u.idunidade and m.idmarca=ma.idmarca $buscaG order by m.descricao LIMIT $inicial, $numreg;";
						
						$busca = mysql_query($b);
						
						$b = "select m.descricao, m.qtd, ma.descricao, u.descricao, m.idMaterial, DATE_FORMAT(m.dataValidade, '%d/%m/%Y') from material m, unidade u, marca ma where m.idunidade=u.idunidade and m.idmarca=ma.idmarca;";
						
						$sql_conta = mysql_query($b);
						
						$quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação
					
						
						if(mysql_num_rows($busca)>0){
						 
							while($result = mysql_fetch_array($busca)){
                     ?>
                     <tr>
					 	<td><a href="#" data-toggle="modal" data-target="#<?php echo($result[4]); ?>"><?php echo($result[0]); ?></a></td> 
                        <td><?php echo($result[1]); ?></td> 
                        <td><?php echo($result[2]); ?></td> 
                        <td>Registrar Entrada</td>  
                        <td>
                        <a  title="Editar Registro" href="alterarMaterial.php?idMaterial=<?php echo($result[4]); ?>" class="btn btn-info glyphicon glyphicon-pencil"> Alterar</a>
                        </td>
                        <td> <a  title="Ecluir Registro" href="excluirMaterial.php?idMaterial=<?php echo($result[4]); ?>" class="btn btn-danger simpleConfirm glyphicon glyphicon-trash"> Excluir</a> </td>  
                        
                        
                        
                        
                        
                        
                        
                          <!--Inicio da janela modal-->
                            
                            <!-- Modal -->
                            <div class="modal fade" id="<?php echo($result[4]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Dados do Funcionário</h4>
                                  </div>
                                  <div class="modal-body">
                                  	   <div class="form-group"> 
                                       	<label class="form-control">Descrição: <?php echo($result[0]); ?></label>           
                                  	   </div>
                                   
                                       <div class="form-group"> 
                                           <label class="form-control">Quantidade: <?php echo($result[1]); ?></label>           
                                       </div>
                                       
                                       <div class="form-group"> 
                                           <label class="form-control">Descrição Do Material: <?php echo($result[2]); ?></label> 
                                       </div>
                                       
                                       <div class="form-group"> 
                                           <label class="form-control">Descrição Da Unidade: <?php echo($result[3]); ?></label> 
                                       </div>
                                       
                                       <div class="form-group"> 
                                           <label class="form-control">Data de Validade: <?php echo($result[5]); ?></label> 
                                       </div>
                                                                   
                                    </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        
                        
                        <!--Fim da Janela Modal-->
                        
                        
                        
                        
                        
                        
                                             
                     <?php }}else{ ?>
                     
                     <td colspan="3"><label for="Nao">Não há Material</label>  </td> 
                     
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


