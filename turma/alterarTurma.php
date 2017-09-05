<?php include("../restrito.php"); $nivel = $_SESSION['nivel']; $nome = $_SESSION['nome']; include("../banco/banco.php"); 
extract($_GET);
$resul = mysql_fetch_array(mysql_query("select descricao from turma where idTurma=$idTurma;"));
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
						
						descricaoAlterar:{required: true,
						remote: {
							url: "verifica.php",
							type: "get",
							data: {
							  descricaoAlterar: function() {
								return $( "#descricaoAlterar" ).val();
							  },
							  
							  descricaoAlterarA: function() {
								return $( "#descricaoAlterarA" ).val();
							  }
							}
						  }
						
						}
						
						
						
						
					},
					messages:{
						descricaoAlterar:{ required: 'Este Campo é obrigatorio' , remote: 'Esta Turma já existe.'}
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
    					<h3 class="panel-title">Alterar Turma</h3>
    				</div>
    				<div class="panel-body">
    					<form id="formularioTurma" method="post" action="alterarTurmaSalvar.php">
                              <div class="form-group">
                                <label for="descricaoAlterar">Descrição</label>
                                <input type="hidden" value="<?php echo($resul[0]); ?>" name="descricaoAlterarA" id="descricaoAlterarA" class="form-control" placeholder="Descrição">
                                
                                <input type="text" value="<?php echo($resul[0]); ?>" name="descricaoAlterar" id="descricaoAlterar" class="form-control" placeholder="Descrição">
                                
                              </div>
                              
                              
                              
                              
                              
                              
                              
   
   
   
   
   
   
   
   
   
                               
                             
                               <div class="form-group">
                              	<div class="panel panel-info">
                                  <div class="panel-heading">Material 
                                   <button type="button" class="adicionarCampoE btn btn-default">ADD Material</button>
                                  </div>
                                  <div class="panel-body">
                                    <div class="emails">
                                    <?php 
									
									$sql = "select mm.idMaterial ,m.descricao, mm.qtd from material m, materialturma mm
									         where m.idMaterial=mm.idMaterial and mm.idTurma=$idTurma;";
									$buscaMaterialTurma = mysql_query($sql);
									$cont = mysql_num_rows($buscaMaterialTurma);
									
									if($cont>0){
										while($resultMaterialTurma=mysql_fetch_array($buscaMaterialTurma)){
									
									?>
                                    	<p class="campoEmail">
                                        
                                            Material
                                            <select name="material[]" class="form-control">
                         		<option value="">Selecione</option>        
								  <?php
                                	$busca=(mysql_query("select idMaterial, descricao from material;"));
									while($result=mysql_fetch_array($busca)){
										if($resultMaterialTurma[0]==$result[0])
											echo("<option selected value=\"$result[0]\">$result[1]</option>");
										else
											echo("<option value=\"$result[0]\">$result[1]</option>");
									}
								  ?>
                                </select>
                                   
                                           Quantidade <input type="text" class="form-control" name="qtd[]" value="<?php echo($resultMaterialTurma[2]) ?>"/>   
                                            
                                            <button type="button" class="removerCampoE btn btn-default">Remover Campo</button>  <br><br><br>    
                                        </p> 
                                        
                                        
                                        <?php }}else{ ?>
                                        
                                        
                                        
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
                                        
                                        
                                        <?php } ?>     
                                    </div>
                                  </div>
                                </div>   
                              </div>
                             
        
   
   
   
   
   
   
   
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                            
                              <button type="submit" class="btn btn-default">Alterar</button>
                              <input type="hidden" name="descricaoAntigo" value="<?php echo($idTurma); ?>">
						</form>
    				</div>
				</div>
        
            </div>
        </div>
    </div>
	
    </body>
</html>

