<?php 
require("ligacao.php");
$sql="INSERT INTO sala(Nome, Vagas) VALUES('{$_POST['nomeSala']}','{$_POST['vagasSala']}')";
$resultado = mysqli_query($conn,$sql);
mysqli_close($conn);
if($resultado){
	header("location:entradaAdmin.php?addSala=true");
}else{
	header("location:entradaAdmin.php?addSala=false");
}