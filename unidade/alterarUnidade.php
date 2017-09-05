<?php include("../restrito.php"); $nivel = $_SESSION['nivel']; $nome = $_SESSION['nome']; include("../banco/banco.php"); 
extract($_GET);
$resul = mysql_fetch_array(mysql_query("select descricao from unidade where idunidade=$idUnidade;"));
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
        <script src="../js/jquery-1.11.2.min.js" type="text/javascript"> </script>
        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/main.js"></script>
        
        
        <!-- Inclusão do Jquery -->
		<script type="text/javascript" src="../js/jquery-1.4.js" ></script>
		<!-- Inclusão do Jquery Validate -->
		<script type="text/javascript" src="../js/jquery-validade.js" ></script>
        
        
      <script type="text/javascript">
			$().ready(function(){
				$('#formularioUnidade').validate({

					rules:{ 
						descricaoAlterar:{ required: true, remote: 'verifica.php' }
					},
					messages:{
						descricaoAlterar:{ required: 'Este Campo é obrigatorio' , remote: 'Esta Unidade já existe.'}
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
    					<h3 class="panel-title">Alterar Unidade</h3>
    				</div>
    				<div class="panel-body">
    					<form id="formularioUnidade" method="post" action="alterarUnidadeSalvar.php">
                              <div class="form-group">
                                <label for="descricaoAlterar">Descrição</label>
                                <input type="text" value="<?php echo($resul[0]); ?>" name="descricaoAlterar" class="form-control" placeholder="Descrição">
                                
                              </div>
                              
                            
                              <button type="submit" class="btn btn-default">Alterar</button>
                              <input type="hidden" name="descricaoAntigo" value="<?php echo($idUnidade); ?>">
						</form>
    				</div>
				</div>
        
            </div>
        </div>
    </div>

    </body>
</html>

