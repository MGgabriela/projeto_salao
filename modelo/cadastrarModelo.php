<?php include("../restrito.php"); $nivel = $_SESSION['nivel']; $nome = $_SESSION['nome']; include("../banco/banco.php"); ?>
<!DOCTYPE html>
<html><head>    
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
				$('#formularioModelo').validate({

					rules:{ 
						descricaoCadastrar:{ required: true, remote: 'verifica.php' }
					},
					messages:{
						descricaoCadastrar:{ required: 'Este Campo é obrigatorio' , remote: 'Este Modelo já existe.'}
					}
					
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
    					<h3 class="panel-title">Cadastrar Modelo</h3>
    				</div>
    				<div class="panel-body">
    					<form id="formularioModelo" method="post" action="cadastrarModeloSalvar.php">
                              <div class="form-group">
                                <label for="descricaoCadastrar">Descrição</label>
                                <input type="text" name="descricaoCadastrar" class="form-control" placeholder="Descrição">
                                
                              </div>
                              
                             
                             
                             
                             
                             
                             
                               <div class="form-group">
                              	<div class="panel panel-info">
                                  <div class="panel-heading">Material 
                                   <button type="button" class="adicionarCampoE btn btn-default">ADD Material</button>
                                  </div>
                                  <div class="panel-body">
                                    <div class="emails">
                                    	<p class="campoEmail">
                                        	
                                            
                                            
                                            
                                            Material
                                            <select name="material[]" class="form-control">
                         		<option value="" selected>Selecione</option>        
								  <?php
                                	$busca=(mysql_query("select idMaterial, descricao from material;"));
									while($result=mysql_fetch_array($busca)){
										echo("<option value=\"$result[0]\">$result[1]</option>");
									}
								  ?>
                                </select>
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                           Quantidade <input type="text" class="form-control" name="qtd[]"/>   
                                            
                                            <button type="button" class="removerCampoE btn btn-default">Remover Campo</button>  <br><br><br>    
                                        </p>      
                                    </div>
                                  </div>
                                </div>   
                              </div>
                             
                             
                             
                             
                             
                             
                             
                              
                            
                              <button type="submit" class="btn btn-default">Cadastrar</button>
						</form>
    				</div>
				</div>
        
            </div>
        </div>
    </div>

    </body>
</html>

