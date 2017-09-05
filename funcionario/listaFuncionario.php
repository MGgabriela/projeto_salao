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
                            <input placeholder="Buscar Por Nome" name="nome" type="text">
                            <button type="submit" class="btn btn-default">Buscar</button>
                        </div>
                     
                        <div class="form-group">
                                <label for="descricaoCadastrar"></label>  
                                <input type="text" name="tel" placeholder="Buscar Por Telefone"  onKeyPress="return txtBoxFormat(this, '(99)9999-9999', event);" maxlength="13"/>
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

		
      <div class="panel-heading">Funcionários</div>
             <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                      	<th>Matrícula</th>
                        <th>Nome</th>
                        <th>Cargo</th>
                        <th>Telefone</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                     <?php 
					 	$telefones=array();
						$emails=array();
					 	$buscaG1="";
						$buscaG2="";
						if((isset($_GET['nome']) && !empty($_GET['nome']))||(isset($_GET['tel']) && !empty($_GET['tel']) )){
					
						  if(!empty($_GET['nome'])){
							$nome = $_GET['nome'];	
							$buscaG2 = " and f.nome like '%$nome%'";
						  
						  }
						
						  if(!empty($_GET['tel']) ){
							$tel = $_GET['tel'];
							$buscaG1 = ", telefonefuncionario t ";
							$buscaG2 = " and t.idfuncionario=f.idfuncionario and t.tel like '%$tel%'";
						  	
							$buscaG2 = "";
						  }
						  
						  
						}
						
					
						//paginação:
						$numreg = 10; // Quantos registros por página vai ser mostrado
						if( isset( $_GET['pg'] ))
						  $pg =  $_GET['pg'];
						  
						if (!isset($pg)) {
							$pg = 0;
						}
						$inicial = $pg * $numreg;
						
						$b = "select f.matricula, f.nome, c.descricao, f.idfuncionario from funcionario f, cargo c $buscaG1 where c.idcargo=f.idcargo $buscaG2  order by f.nome  LIMIT $inicial, $numreg;";
						
						$busca = mysql_query($b);
						
						
						
						$b = "select f.matricula, f.nome, c.descricao, f.idFuncionario from funcionario f, cargo c $buscaG1 where c.idcargo=f.idcargo $buscaG2";
						
						$sql_conta = mysql_query($b);
						
						$quantreg = mysql_num_rows($sql_conta); // Quantidade de registros para paginação
					
						
						if(mysql_num_rows($busca)>0){
						  while($result = mysql_fetch_array($busca)){
                     ?>
                     <tr>
                     	<td><?php echo($result[0]); ?></td>
                     	<td><a href="#" data-toggle="modal" data-target="#<?php echo($result[3]); ?>"><?php echo($result[1]); ?></a></td>
                        <td><?php echo($result[2]); ?></td>
                        <td>
							<?php  
								$sqlTel = "select tel from telefonefuncionario where idFuncionario=$result[3];";
								
								$buscaTel = mysql_query($sqlTel);
								if(mysql_num_rows($buscaTel)>0){
									while($resultTel = mysql_fetch_array($buscaTel)){
										echo($resultTel[0]."<br>");
										$telefones[]=$resultTel[0];
									}
								}else{
									echo("Não há Telefone");
									$telefones[]="Não há Telefones";
								}
							?>
                        </td>
                        
                          
							<?php  
								$sqlEmail = "select email from emailfuncionario where idFuncionario=$result[3];";
								
								$buscaEmail = mysql_query($sqlEmail);
								if(mysql_num_rows($buscaEmail)>0){
									while($resultEmail = mysql_fetch_array($buscaEmail)){
								   		//echo($resultEmail[0]."<br>");
										$emails[] = $resultEmail[0];
									}
								}else{
									//echo("Não há Email");
									$emails[] = "Não ha Emails";
								}
							?>
                       <td>
                       		 <a  title="Editar Registro" href="alterarFuncionario.php?idFuncionario=<?php echo($result[3]); ?>" class="btn btn-info glyphicon glyphicon-pencil"> Alterar</a>
                       </td>
                       <td>
                       		<a  title="Excluir Registro" href="excluirFuncionario.php?idFuncionario=<?php echo($result[3]); ?>" class="btn btn-danger simpleConfirm glyphicon glyphicon-trash"> Excluir</a>
                       </td>
                        
                     </tr>
                     
                        <!--Inicio da janela modal-->
                            
                            <!-- Modal -->
                            <div class="modal fade" id="<?php echo($result[3]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Dados do Funcionário</h4>
                                  </div>
                                  <div class="modal-body">
                                  	   <div class="form-group"> 
                                       	<label class="form-control">Matrícula: <?php echo($result[0]); ?></label>           
                                  	   </div>
                                   
                                       <div class="form-group"> 
                                           <label class="form-control">Nome: <?php echo($result[1]); ?></label>           
                                       </div>
                                       
                                       <div class="form-group"> 
                                           <label class="form-control">Cargo: <?php echo($result[2]); ?></label> 
                                       </div>
                                       <!--Começo da lista de telefones-->
                                       <div class="form-group"> 
                                           <div class="panel panel-default">
                                              <div class="panel panel-heading"><label>Telefones</label></div>
                                              <div class="panel-body">
                                               <?php
                                                    foreach($telefones as $t){
                                                            echo($t."<br>");
                                                    }
                                                    unset($telefones);
                                               ?>
                                               
                                              </div>
                                           </div>              
                                       </div>
                                       <!--Fim da lista de telefones--> 
                                       
                                        <!--Começo da lista de emails-->
                                       <div class="form-group"> 
                                           <div class="panel panel-default">
                                              <div class="panel panel-heading"><label>Emails</label></div>
                                              <div class="panel-body">
                                               <?php
                                                    foreach($emails as $e){
                                                            echo($e."<br>");
                                                    }
                                                    unset($emails);
                                               ?>
                                               
                                              </div>
                                           </div>              
                                       </div>
                                       <!--Fim da lista de emails-->    
                                      
                                       <!--Começo do Login-->
                                        <?php if($nivel=="1"){ ?>
                                       <div class="form-group"> 
                                           <div class="panel panel-default">
                                              <div class="panel panel-heading"><label>Usuário</label></div>
                                              <div class="panel-body">
                                               <?php
                                                    $buscaLogin = mysql_query("select login, nivel from usuario where idFuncionario=$result[3];");
													if(mysql_num_rows($buscaLogin)>0){
														$resultLogin = mysql_fetch_array($buscaLogin);
														echo("Login: $resultLogin[0]<br>Nível: ");
														if($resultLogin[1]==1){
															echo(" Administrador");
														}else{
															echo(" Comum");
														}
													}else{
														echo("Usuário não Possui Login.");	
													}
                                               ?>
                                               
                                              </div>
                                           </div>              
                                       </div>
                                        <?php } ?>
                                       <!--Fim do Login-->
                                      
                                                                       
                                    </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        
                        
                        <!--Fim da Janela Modal-->
                        
                        
                        
                        
                        
                     
                     
                     <?php }}else{ ?>
                     	<td colspan="5">                        	
                            	<label for="Nao">Não há Funcionários</label>    

                        </td>

                     <?php } ?>
                     
            <td colspan="5"><?php if(mysql_num_rows($busca)>0){ include("../paginacao.php"); }?></td>
                    </tbody>
                  </table>
                  </div>
                </div>
             </div>
            
        </div>
    </div>
        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/main.js"></script>
        
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
        
        <script type="text/javascript"> 
        	$(".simpleConfirm").confirm();
    	</script>
        
        
    </body>
</html>

