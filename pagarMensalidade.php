<?php 
require("protecaoLogin.php"); 
require("ligacao.php");
$id = (int) $_GET['idMensalidade'];
$idUser = $_SESSION['ID'];
$sql = "INSERT INTO utilizador_mensalidade(ID_Utilizador, ID_Mensalidade) VALUES($idUser,$id)";
$resultado = mysqli_query($conn,$sql);
mysqli_close($conn);
if($resultado)
	header("location:mensalidades.php?pagar=true");
else
	header("location:mensalidades.php?pagar=false");
exit();