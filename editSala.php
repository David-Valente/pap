<?php 
require("ligacao.php");
$sql="UPDATE sala SET Vagas = '{$_POST['valor']}' WHERE ID = {$_POST['idSala']}";
$resultado = mysqli_query($conn,$sql);
mysqli_close($conn);
if($resultado){
	header("location:entradaAdmin.php?salaUpdated=true");
}else{
	header("location:entradaAdmin.php?salaUpdated=false");
}
?>