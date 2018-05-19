<?php 
require("protecaoLogin.php");
require("ligacao.php");
$idAula = (int) $_GET['idAula'];
$user = $_SESSION['ID'];
$sql="INSERT INTO `utilizador_aula`(`ID_Utilizador`, `ID_Aula`) VALUES ($user,$idAula)";
$resultado = mysqli_query($conn,$sql);
mysqli_close($conn);
if($resultado)
	header("location:entradaCliente.php?marcar=true");
else
	header("location:entradaCliente.php?marcar=false");