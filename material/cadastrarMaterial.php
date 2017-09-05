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
        

        
        <script src="../js/jquery-1.11.2.min.js" type="text/javascript"> </script>
        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/main.js"></script>
        
        
        <!-- Inclusão do Jquery -->
		<script type="text/javascript" src="../js/jquery-1.4.js" ></script>
		<!-- Inclusão do Jquery Validate -->
		<script type="text/javascript" src="../js/jquery-validade.js" ></script>
        <!-- Inclusão do Jquery mask -->
        <script type="text/javascript" src="../js/jquery.mask.min.js" ></script>
    	
		<script type="text/javascript" src="../js/script/site1.js"></script>
        <script type="text/javascript" src="../js/script/site.js"></script>
 
 
         <!-- auto complete -->
         <link rel="stylesheet" href="../css/jquery-ui.css">
  		 <script src="../js/jquery-ui.js"></script>
        <!-- Fim auto complete -->	
 
 
        <!-- Inclusão da mascara de data -->
      
	    <!-- Fim da Inclusão da mascara de data -->

        
                   <script>
		  $(document).ready(function() {
			  var url = "pagina.php";
			  var dados = Array();
			  $.ajax({
				url : url ,
				dataType:"json",
				
				success: function(retorno){
					for(var i = 0 ; i < retorno.length ; i++){
						//alert(retorno[i].nome);
						dados[i] = retorno[i].descricao;
					}
					
				}
				  
			  });
			  
			  
			$( "#descricaoCadastrar" ).autocomplete({
			  source: dados
			});  
		  }); 
  </script>
     
     
      
      <script type="text/javascript">
	$(document).ready(function() {
		jQuery.noConflict();
		  (function($) {
		  $(function() {
		  $('.data').mask('99/99/9999'); //data
		  $('.tel').mask('(99) 9999-9999'); //telefone
		  $('.cpf').mask('999.999.999-99'); //cpf
		});
		})(jQuery);
		
		$(function(){
			$('#num').bind('keydown',soNums); // o "#input" é o input que vc quer aplicar a funcionalidade
		});
		 
		function soNums(e){
		 
			//teclas adicionais permitidas (tab,delete,backspace,setas direita e esquerda)
			keyCodesPermitidos = new Array(8,9,37,39,46);
			 
			//numeros e 0 a 9 do teclado alfanumerico
			for(x=48;x<=57;x++){
				keyCodesPermitidos.push(x);
			}
			 
			//numeros e 0 a 9 do teclado numerico
			for(x=96;x<=105;x++){
				keyCodesPermitidos.push(x);
			}
			 
			//Pega a tecla digitada
			keyCode = e.which;
			 
			//Verifica se a tecla digitada é permitida
			if ($.inArray(keyCode,keyCodesPermitidos) != -1){
				return true;
			}   
			return false;
		}
	});
		</script>
        
        
        
        
        
    
      <script type="text/javascript">
			$().ready(function(){
				$('#formularioCargo').validate({

					rules:{ 
						descricaoCadastrar:{ required: true},
						qtd:{ number: true, required: true },
						unidade:{required: true},
						marca:{required: true,
						
						 remote: {
							url: "verifica.php",
							type: "post",
							data: {
							  descricaoCadastrar: function() {
								return $( "#descricaoCadastrar" ).val();
								//esse #descricaoCadastrar refere-se ao campo declarado a cima, porem no html TEM que usar o ID no campo, do contrario dará erro
							  }
							}
						  }
						
						}
					},
					messages:{
						descricaoCadastrar:{ required: 'Este Campo é obrigatorio'},
						qtd:{ number: 'Campo numérico', required: 'Este Campo é obrigatorio' },
						unidade:{required: 'Este Campo é obrigatorio'},
						marca:{required: 'Este Campo é obrigatorio',remote: 'Essa combinação de Descrição e Marca já existe.'}
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
    					<h3 class="panel-title">Cadastrar Material</h3>
    				</div>
    				<div class="panel-body">
    					<form id="formularioCargo" method="post" action="cadastrarMaterialSalvar.php">
                              <div class="form-group">
                                <label for="descricaoCadastrar">Descrição</label>
                                <input type="text" id="descricaoCadastrar" name="descricaoCadastrar" class="form-control" placeholder="Descrição">
                                
                                
                              </div>
                              
                              <div class="form-group">
                                <label for="quantidade">Quantidade</label>
                                <input type="text" name="qtd" class="form-control" placeholder="Quantidade">                                
                              </div>
                              
                              
                              <div class="form-group">
                                <label for="descricaoCadastrar">Data de Validade</label>
                               <input type="text" class="data form-control" name="dataValidade" placeholder="Data de Validade">                                
                              </div>
                              
                              
                               <div class="form-group">
                                <label for="quantidade">Marca</label>
                                <select name="marca" class="form-control">
                         		<option value="" selected>Selecione</option>        
								  <?php
                                	$busca=(mysql_query("select idMarca, descricao from marca order by descricao;"));
									while($result=mysql_fetch_array($busca)){
										echo("<option value=\"$result[0]\">$result[1]</option>");
									}
								  ?>
                                </select>                         
                              </div>

                              
                              <div class="form-group">
                                <label for="quantidade">Unidade</label>
                                <select name="unidade" class="form-control">
                         		<option value="" selected>Selecione</option>        
								  <?php
                                	$busca=(mysql_query("select idUnidade, descricao from unidade order by descricao;"));
									while($result=mysql_fetch_array($busca)){
										echo("<option value=\"$result[0]\">$result[1]</option>");
									}
								  ?>
                                </select>                         
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

