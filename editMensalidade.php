<?php 
require("ligacao.php");
$sql="UPDATE mensalidade SET Valor = '{$_POST['valor']}' WHERE ID = {$_POST['idMensalidade']}";
$resultado = mysqli_query($conn,$sql);
mysqli_close($conn);
if($resultado){
	header("location:entradaAdmin.php?mensalidadeUpdated=true");
}else{
	header("location:entradaAdmin.php?mensalidadeUpdated=false");
}
?>