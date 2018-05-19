<?php 
require("ligacao.php");
$sql="UPDATE utilizador SET isDeleted = 0 WHERE ID = {$_GET['id']}";
$resultado = mysqli_query($conn,$sql);
mysqli_close($conn);
if($resultado){
	header("location:entradaAdmin.php?userRestaurado=true");
}else{
	header("location:entradaAdmin.php?userRestaurado=false");
}
?>