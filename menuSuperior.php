 <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?php
								$urlServer    = $_SERVER['SERVER_NAME'];
								echo("http://$urlServer/senac/");  
							 ?>">Senac-DF</a>
            </div>
        
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
              <ul class="nav navbar-nav navbar-right">
              	<li><a href="#">Olá <?php echo($nome); ?></a></li>
                <li><a href="<?php
								$urlServer    = $_SERVER['SERVER_NAME'];
								echo("http://$urlServer/senac/deslogar.php");  
							 ?>">Sair</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
   </nav>