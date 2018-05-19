<?php 
require("ligacao.php");
$sql="INSERT INTO aulas(Nome, ID_Sala, ID_Treinador, ID_Categoria, Data) VALUES('{$_POST['nomeAula']}','{$_POST['salaAula']}','{$_POST['treinadorAula']}','{$_POST['categoriaAula']}','{$_POST['Data']}')";
$resultado = mysqli_query($conn,$sql);
mysqli_close($conn);
if($resultado){
	header("location:entradaAdmin.php?addAula=true");
}else{
	header("location:entradaAdmin.php?addAula=false");
}