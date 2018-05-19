<?php 
require("ligacao.php");
$sql="SELECT * FROM mensalidade WHERE Mes = {$_POST['monthMensalidade']} AND Ano = {$_POST['yearMensalidade']}";
$resultado = mysqli_query($conn,$sql);
$row = mysqli_num_rows($resultado);
if($row === 0){
	$sql="INSERT INTO mensalidade(Mes, Ano, Valor) VALUES('{$_POST['monthMensalidade']}','{$_POST['yearMensalidade']}','{$_POST['precoMensalidade']}')";
	$resultado = mysqli_query($conn,$sql);
	mysqli_close($conn);
	if($resultado){
		header("location:entradaAdmin.php?addMensalidade=true");
	}else{
		header("location:entradaAdmin.php?addMensalidade=false");
	}
}else{
	mysqli_close($conn);
	header("location:entradaAdmin.php?addMensalidade=forbidden");
}