<!DOCTYPE html>
<html>
    <head>
        <title>Senac</title>
        
        <!-- define a viewport -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
        
        <!-- adicionar CSS Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        
        <!-- css personalizado -->
        <link href="css/estilo.css" rel="stylesheet" media="screen">
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body id="login">
    <div class="container-fluid">
        
        <div class="row-fluid">
        	<div class="col-xs-12">
            	<img src="imgs/SENAC-DF.jpg" width="173" height="116" alt="Senac"> 
            </div>
        </div>      
        
        <div class="row-fluid">
            <div class="col-xs-12">
                
                <div class="form-login">
                	<?php 
					 
						if(isset($_GET['verifica'])){
							$verifica = $_GET['verifica'];
							if($verifica=="false")
								echo('<div class="alert alert-danger" role="alert">Efetue seu Login</div>');
							else
							
								if($verifica=="dados")
									echo('<div class="alert alert-danger" role="alert">Dados Incorretos</div>');
								else
							
									if($verifica=="deslogou")
										echo('<div class="alert alert-success" role="alert">Volte Sempre</div>');
									
						 	
						}
						
					?>
                	
                    
                    <h2>Efetue Login</h2>
                    
                    <form action="logar.php" method="post">
                        <label class="sr-only" for="inputEmail">E-mail:</label>
                        <input type="text" id="login" name="login" class="form-control input-lg" placeholder="Seu E-mail" maxlength="50" required />
                        <label class="sr-only" for="inputPass">Senha:</label>
                        <input type="password" id="senha" name="senha" class="form-control input-lg" placeholder="Sua senha" maxlength="15" required />
                        
                      
                        
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            <span class="glyphicon glyphicon-ok"></span>                            
                            Acessar
                        </button>
                        
                    </form>
                </div>
               
            </div>
        </div>
      </div>
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>