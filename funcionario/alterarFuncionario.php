<?php include("../restrito.php"); $nivel = $_SESSION['nivel']; $nome = $_SESSION['nome']; include("../banco/banco.php"); 
$idFuncionario = $_GET['idFuncionario']; 
$result = mysql_fetch_array(mysql_query("select f.matricula, f.nome, c.idcargo from funcionario f, cargo c where c.idcargo=f.idcargo and f.idfuncionario=$idFuncionario;"));



?>
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
        
        
        
        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/main.js"></script>
        <script src="../js/jquery.mask.min.js"></script>
        <script src="../js/valida_campos.js"></script>
        <script src="../js/email.js"></script>
        <script type="text/javascript" src="../js/aplicacao.js"></script>
        <script src="../js/jquery.validateFuncionario.js"></script>
        
        
 <script type="text/javascript">
 			
			$().ready(function(){
				
				$('#formularioFuncionario').validate({

					rules:{ 
						nome:{ required: true},
						cargo:{ required: true},
						usuarioCadastrar:{required: true,remote: 'verifica.php'},
						usuarioAlterarA:{required: true},
						usuarioAlterar:{required: true,
						//remote: 'verifica.php'},
						
						 remote: {
							url: "verifica.php",
							type: "post",
							data: {
							  usuarioAlterarA: function() {
								return $( "#usuarioAlterarA" ).val();
								//esse #usuarioAlterarA refere-se ao campo declarado a cima, porem no html TEM que usar o ID no campo, do contrario dará erro
							  }
							}
						  }},
						
						
						senha:{required: true},
						senhar:{equalTo: '#senha',required: true},
						nivel:{required: true}
					},
					messages:{
						nome:{ required: 'Este Campo é obrigatorio'},
						cargo:{ required: 'Este Campo é obrigatorio'},
						usuarioCadastrar:{required: true,remote: 'Este usuário já esta em uso'},
						usuarioAlterarA:{required: 'Este Campo é obrigatorio'},
						usuarioAlterar:{required: 'Este Campo é obrigatorio', 
						remote:'Este usuário já esta em uso'},
						senha:{required: 'Este Campo é obrigatório'},
						senhar:{equalTo:'As senha estão Diferentes',required: 'Este Campo é obrigatório'},
						nivel:{required: 'Este Campo é obrigatorio'}
					}
					
				});
			});
		</script>
        <script type="text/javascript">
			
			$(document).ready(function() {
				$('#painelAdm2').hide();
				$('#painelAdm1').show();
                $('#adm1').click(function() {
    				$("#painelAdm1").toggle(this.checked);
				});
				$('#adm2').click(function() {
    				$("#painelAdm2").toggle(this.checked);
				});
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
                 
				<div class="panel panel-primary">
					<div class="panel-heading">
    					<h3 class="panel-title">Alterar Funcionário</h3>
    				</div>
    				<div class="panel-body">
    					<form id="formularioFuncionario" method="post" action="alterarFuncionarioSalvar.php">
                              <div class="form-group">
                                <label for="matricula">Matrícula</label>
                                <input type="text" name="matricula" class="form-control" placeholder="matricula" value="<?php echo($result[0]); ?>">
                              </div>
                              <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome" value="<?php echo($result[1]); ?>">
                              </div>
                              <div class="form-group">
                                <label for="nome">Cargo</label>
                                <select name="cargo" class="form-control">
                         		<option value="" selected>Selecione</option>        
								  <?php
                                	$busca=(mysql_query("select idCargo, descricao from cargo;"));
									while($resultC=mysql_fetch_array($busca)){
										if($resultC[0]==$result[2])
											echo("<option selected value=\"$resultC[0]\">$resultC[1]</option>");
											else
												echo("<option value=\"$resultC[0]\">$resultC[1]</option>");
									}
								  ?>
                                </select>
                              </div>
                            
                              <div class="form-group">
                              	<div class="panel panel-info">
                                  <div class="panel-heading">Telefone <button type="button" class="adicionarCampo btn btn-default">ADD Telefone</button>
                                  
                                  			
                                  </div>
                                  <div class="panel-body">
                                    <div class="telefones">
                                    
                                    <?php  
												$sqlTel = "select tel from telefonefuncionario where idFuncionario=$idFuncionario;";
												
												$buscaTel = mysql_query($sqlTel);
												if(mysql_num_rows($buscaTel)>0){
													while($resultTel = mysql_fetch_array($buscaTel)){
														echo("
														
														 <p class=\"campoTelefone\">
          <input type=\"text\" name=\"telefone[]\" id=\"telefone\" onKeyPress=\"return txtBoxFormat(this, '(99)9999-99999', event);\" maxlength=\"14\" value=\"$resultTel[0]\"/>
          <button type=\"button\" class=\"removerCampo btn btn-default\">Remover Campo</button>
          </p>
														
														");
														
													}
												}else{
													echo("
													
													<p class=\"campoTelefone\">
          <input type=\"text\" name=\"telefone[]\" id=\"telefone\" onKeyPress=\"return txtBoxFormat(this, '(99)9999-99999', event);\" maxlength=\"14\"/>
          <button type=\"button\" class=\"removerCampo btn btn-default\">Remover Campo</button>
          </p>
													
													");
													
												}
											?>
         
       
      </div>
                                  </div>
                                </div>   
                              </div>
      
                               <div class="form-group">
                              	<div class="panel panel-info">
                                  <div class="panel-heading">Email 
                                   <button type="button" class="adicionarCampoE btn btn-default">ADD Email</button>
                                  </div>
                                  <div class="panel-body">
                                    <div class="emails">
                                    
                                    
                                    <?php  
								$sqlEmail = "select email from emailfuncionario where idFuncionario=$idFuncionario;";
								
								$buscaEmail = mysql_query($sqlEmail);
								if(mysql_num_rows($buscaEmail)>0){
									while($resultEmail = mysql_fetch_array($buscaEmail)){
								   		echo("
										
										<p class=\"campoEmail\">
                                        	<input type=\"text\" class=\"form-control\" name=\"email[]\" value=\"$resultEmail[0]\"/>   
                                            <button type=\"button\" class=\"removerCampoE btn btn-default\">Remover Campo</button>      
										 </p>
										");
										
									}
								}else{
									echo("
									
									<p class=\"campoEmail\">
                                        	<input type=\"text\" class=\"form-control\" name=\"email[]\" />   
                                            <button type=\"button\" class=\"removerCampoE btn btn-default\">Remover Campo</button>      
										 </p>
									
									");
									
								}
							?>
                                             
                                    </div>
                                  </div>
                                </div>   
                              </div>
                                
                              
                              
                             
                                <!--Começo do Login-->
                                <?php 
								if($_SESSION['nivel']=="1"){ 
			 $buscaLogin = mysql_query("select login, nivel from usuario where idFuncionario=$idFuncionario;");
									if(mysql_num_rows($buscaLogin)>0){
										$resultUsuario = mysql_fetch_array($buscaLogin);
								?>
                             
                             	<div class="panel panel-info">
                                  <div class="panel-heading">Administrativo</div>
                                  	<div class="panel-body">
                                    	<div class="checkbox">
                                           <label>
                                              <input id="adm1" name="adm1" type="checkbox" checked>							                                               Usará o Sistema?
                                            </label>
                                        </div>
                                            <div id="painelAdm1">
                                            	
                                                   
                                             
                                                    <div class="form-group">
                                                     <input type="hidden" name="usuarioAlterarA" class="form-control" id="usuarioAlterarA" value="<?php echo($resultUsuario[0]); ?>">
                                                    <label for="usuario">Usuário</label>
                                                    <input type="text" name="usuarioAlterar" class="form-control" value="<?php echo($resultUsuario[0]); ?>">
                                                </div>                    					                                                <div class="form-group">
                                                    <label for="senha">Senha</label>
                                                    <input type="password" name="senha" id="senha" class="form-control" value="●●●●●●●">
                                                </div>
                                                <div class="form-group">
                                                    <label for="senhaR">Repita a Senha</label>
                                                    <input type="password" name="senhar" id="senhar" class="form-control" value="●●●●●●●">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nivel">Nível</label>
                                                        <select name="nivel" class="form-control">
                                                        <option value="2" <?php if($resultUsuario[1]==2) echo("selected") ?>>Comum</option>
                                                        <option value="1" <?php if($resultUsuario[1]==1) echo("selected"); ?>>Administrador</option>
                                                    </select>
                                                </div>
                                            </div>
                                        
                                    </div>
                                </div>
                                 <?php }else{ ?>
                                 
                                 	<div class="panel panel-info">
                                  <div class="panel-heading">Administrativo</div>
                                  	<div class="panel-body">
                                    	<div class="checkbox">
                                           <label>
                                              <input id="adm2" name="adm2" type="checkbox">							                                               Usará o Sistema?
                                            </label>
                                        </div>
                                            <div id="painelAdm2">
                                            	<div class="form-group">
                                                    <label for="usuario">Usuário</label>
                                                    <input type="text" name="usuarioCadastrar" class="form-control">
                                                </div>                    					                                                <div class="form-group">
                                                    <label for="senha">Senha</label>
                                                    <input type="password" name="senha" id="senha" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="senhaR">Repita a Senha</label>
                                                    <input type="password" name="senhar" id="senhar" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nivel">Nível</label>
                                                        <select name="nivel" class="form-control">
                                                        <option value="" selected>Selecione um nível</option>     
                                                        <option value="2">Comum</option>
                                                        <option value="1">Administrador</option>
                                                    </select>
                                                </div>
                                            </div>
                                        
                                    </div>
                                </div>
                                 
                                 <?php }} ?>
                              <!--Fim do Login-->
                             
                              
                              
							  
                              <button type="submit" class="btn btn-default">Alterar</button>
                              <input type="hidden" name="idFuncionario" value="<?php echo($idFuncionario); ?>">
						</form>
    				</div>
				</div>
        
            </div>
        </div>
    </div> 
    </body>
</html>

