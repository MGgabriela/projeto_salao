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
						senha:{required: true},
						senhar:{equalTo: '#senha',required: true},
						nivel:{required: true}
					},
					messages:{
						nome:{ required: 'Este Campo é obrigatorio'},
						cargo:{ required: 'Este Campo é obrigatorio'},
						usuarioCadastrar:{required: 'Este Campo é obrigatorio', remote:'Este usuário já esta em uso'},
						senha:{required: 'Este Campo é obrigatório'},
						senhar:{equalTo:'As senha estão Diferentes',required: 'Este Campo é obrigatório'},
						nivel:{required: 'Este Campo é obrigatorio'}
					}
					
				});
			});
		</script>
        <script type="text/javascript">
			
			$(document).ready(function() {
				$('#painelAdm').hide();
                $('#adm').click(function() {
    				$("#painelAdm").toggle(this.checked);
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
    					<h3 class="panel-title">Cadastro de Funcionário</h3>
    				</div>
    				<div class="panel-body">
    					<form id="formularioFuncionario" method="post" action="cadastrarFuncionarioSalvar.php">
                              <div class="form-group">
                                <label for="matricula">Matrícula</label>
                                <input type="text" name="matricula" class="form-control" placeholder="matricula">
                              </div>
                              <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome">
                              </div>
                              <div class="form-group">
                                <label for="nome">Cargo</label>
                                <select name="cargo" class="form-control">
                         		<option value="" selected>Selecione</option>        
								  <?php
                                	$busca=(mysql_query("select idCargo, descricao from cargo;"));
									while($result=mysql_fetch_array($busca)){
										echo("<option value=\"$result[0]\">$result[1]</option>");
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
         
        <p class="campoTelefone">
          <input type="text" name="telefone[]" id="telefone" onKeyPress="return txtBoxFormat(this, '(99)9999-99999', event);" maxlength="14"/>
          <button type="button" class="removerCampo btn btn-default">Remover Campo</button>
          </p>
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
                                    	<p class="campoEmail">
                                        	<input type="text" class="form-control" name="email[]"/>   
                                            <button type="button" class="removerCampoE btn btn-default">Remover Campo</button>      
                                        </p>      
                                    </div>
                                  </div>
                                </div>   
                              </div>
                                
                              
                              <!--Começo do Login-->
                                        <?php if($_SESSION['nivel']=="1"){ ?>
                             
                             	<div class="panel panel-info">
                                  <div class="panel-heading">Administrativo</div>
                                  	<div class="panel-body">
                                    	<div class="checkbox">
                                           <label>
                                              <input id="adm" name="adm" type="checkbox">							                                               Usará o Sistema?
                                            </label>
                                        </div>
                                            <div id="painelAdm">
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
                                 <?php } ?>
                              <!--Fim do Login-->
                                      
                              
                              

                              <button type="submit" class="btn btn-default">Cadastrar</button>
						</form>
    				</div>
				</div>
        
            </div>
        </div>
    </div> 
    </body>
</html>

