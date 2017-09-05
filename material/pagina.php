<?php
include("../banco/banco.php");
$sql = "select descricao from material;";
$res=mysql_query($sql);
$cont = mysql_num_rows($res);


for($i=0;$i<$cont;$i++){
    
	$dados[] =	mysql_fetch_assoc($res);

}

echo json_encode($dados);

?>