<?php include("../restrito.php"); $nivel = $_SESSION['nivel']; $nome = $_SESSION['nome']; include("../banco/banco.php");
$idMaterial = $_GET['idMaterial'];
$result=mysql_fetch_array(mysql_query("select m.descricao, m.qtd, ma.idMarca, u.idUnidade, m.idMaterial, DATE_FORMAT(m.dataValidade, '%d/%m/%Y') from material m, unidade u, marca ma where m.idunidade=u.idunidade and m.idmarca=ma.idmarca and m.idMaterial=$idMaterial;"));
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
			  
			  
			$( "#descricaoAlterar" ).autocomplete({
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
				$('#formularioMaterial').validate({

					rules:{ 
						descricaoAlterar:{ required: true},
						qtd:{ number: true, required: true },
						unidade:{required: true},
						marcaA:{required: true},
						descricaoA:{required: true},
						marca:{required: true,
						remote: {
							url: "verifica.php",
							type: "post",
							data: {
							  descricaoAlterar: function() {
								return $( "#descricaoAlterar" ).val();
							  },
							  
							  marcaA: function() {
								return $( "#marcaA" ).val();
							  },
							  
							   descricaoA: function() {
								return $( "#descricaoA" ).val();
							  }
							  
							}
						  }
						
						}
						
					},
					messages:{
						descricaoAlterar:{ required: 'Campo Obrigatório'},
						qtd:{ number: 'Campo numérico', required: 'Este Campo é obrigatorio' },
						unidade:{required: 'Campo Obrigatório'},
						marcaA:{required: 'Campo Obrigatório'},
						descricaoA:{required: 'Campo Obrigatório'},
						marca:{required: 'Campo Obrigatório', remote:'Essa combinação de Descrição e Marca já existe.'}	
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
    					<h3 class="panel-title">Alterar Material</h3>
    				</div>
    				<div class="panel-body">
    					<form id="formularioMaterial" method="post" action="alterarMaterialSalvar.php">
                              <div class="form-group">
                                <label for="descricaoCadastrar">Descrição</label>
                                <input type="text" id="descricaoAlterar" name="descricaoAlterar" class="form-control" placeholder="Descrição" value="<?php echo($result[0]); ?>">                                
                              </div>
                              
                              <div class="form-group">
                                <label for="quantidade">Quantidade</label>
                                <input type="text" name="qtd" class="form-control" placeholder="Quantidade" value="<?php echo($result[1]); ?>">                                
                              </div>
                              
                              
                              <div class="form-group">
                                <label for="descricaoCadastrar">Data de Validade</label>
                               <input type="text" class="data form-control" name="dataValidade" placeholder="Data de Validade" value="<?php echo($result[5]); ?>">                                
                              </div>
                              
                              
                               <div class="form-group">
                                <label for="quantidade">Marca</label>
                                <select name="marca" id="marca" class="form-control">
                         		<option value="" selected>Selecione</option>        
								  <?php
                                	$busca=(mysql_query("select idMarca, descricao from marca order by descricao;"));
									while($resultM=mysql_fetch_array($busca)){
										if($result[2]==$resultM[0])
										echo("<option selected value=\"$resultM[0]\">$resultM[1]</option>");
										else
											echo("<option value=\"$resultM[0]\">$resultM[1]</option>");
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
									while($resultU=mysql_fetch_array($busca)){
										if($result[3]==$resultU[0])
										echo("<option selected value=\"$resultU[0]\">$resultU[1]</option>");
										else
											echo("<option value=\"$resultU[0]\">$resultU[1]</option>");
									}
								  ?>
                                </select>                         
                              </div>
                              
                            
                              <button type="submit" class="btn btn-default">Alterar</button>
                              <input type="hidden" id="marcaA" name="marcaA" value="<?php echo($result[2]); ?>">
                              
                              <input type="hidden" id="descricaoA" name="descricaoA" value="<?php echo($result[0]); ?>"> 
                              
                               <input type="hidden" id="idMaterial" name="idMaterial" value="<?php echo($idMaterial); ?>">  
                                                         
						</form>
    				</div>
				</div>
        
            </div>
        </div>
    </div>
    </body>
</html>

