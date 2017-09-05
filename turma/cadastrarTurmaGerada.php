<?php include("../restrito.php"); $nivel = $_SESSION['nivel']; $nome = $_SESSION['nome']; include("../banco/banco.php"); 
extract($_GET);
$sql = "select descricao from modelo where idModelo=$idModelo;";
$result1 = mysql_fetch_array(mysql_query($sql));
?>
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
				$('#formularioTurma').validate({

					rules:{ 
						seiCadastrar:{ required: true, remote: 'verifica.php' }
					},
					messages:{
						seiCadastrar:{ required: 'Este Campo é obrigatorio' , remote: 'Este SEI já existe.'}
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
    					<h3 class="panel-title">Cadastrar Turma</h3>
    				</div>
    				<div class="panel-body">
    					<form id="formularioTurma" method="post" action="cadastrarTurmaSalvar.php">
                        
                        
                        	<div class="form-group">
                                <label for="seiCadastrar">SEI</label>
                                <input type="text" name="seiCadastrar" class="form-control" id="seiCadastrar" placeholder="SEI">
                                
                              </div>
                        
                        
                        	 
                        
                        
                              <div class="form-group">
                                <label for="descricaoCadastrar">Descrição</label>
                                <input type="text" value="<?php  echo($result1[0]); ?>" name="descricao" class="form-control" placeholder="Descrição">
                                
                              </div>
                              
                              
                              
                              
                          <div class="form-group">
                                <label for="descricaoCadastrar">Turno</label>
                                <select name="turno" class="form-control">
                                	<option selected disabled>Selecione um Turno</option>
                                    <option value="m">Matutino</option>
                                    <option value="v">Vesprtino</option>
                                    <option value="n">Noturno</option>
                                </select>
                                
                              </div>
                              
                              
                              
                              
                              
                              <div class="form-group">
                                <label for="descricaoCadastrar">Data Inicio</label>
                                <input type="date" name="dataInicio" class="form-control" placeholder="Descrição">
                                
                              </div>
                              
                              
                             <div class="form-group">
                                <label for="descricaoCadastrar">Data Fim</label>
                                <input type="date" name="dataFim" class="form-control" placeholder="Descrição">
                                
                              </div>
                              
                             
                             
                             
                            
                             
                             
                               <div class="form-group">
                              	<div class="panel panel-info">
                                  <div class="panel-heading">Material 
                                   <button type="button" class="adicionarCampoE btn btn-default">ADD Material</button>
                                  </div>
                                  <div class="panel-body">
                                    <div class="emails">
                                    
                                     <?php  
										$sql = "select idMaterial, qtd from materialmodelo where idModelo=$idModelo;";
										
										$busca1 = mysql_query($sql);
										while($resultMaterial = mysql_fetch_array($busca1)){
									 	
										
							 		 ?>
                                    
                                    	<p class="campoEmail">
                                        	
                                            
                                            
                                            
                                            Material
                                            <select name="material[]" class="form-control">
                         		<option value="" selected>Selecione</option>        
								  <?php
                                	$busca=(mysql_query("select idMaterial, descricao from material;"));
									while($result=mysql_fetch_array($busca)){
								  ?>
                                    
										<option  <?php if($resultMaterial[0]==$result[0]) echo(" selected ") ?> value="<?php echo $result[0]; ?>"><?php echo $result[1]; ?></option>
									<?php 
									}
								  ?>
                                </select>
                                          
                                           Quantidade <input type="text" value="<?php echo($resultMaterial[1]); ?>" class="form-control" name="qtd[]"/>   
                                            
                                            <button type="button" class="removerCampoE btn btn-default">Remover Campo</button>  <br><br><br>    
                                        </p>  
                                        
                                        
                                        <?php } ?>    
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

