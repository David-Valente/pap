<?php 
require("ligacao.php");

$nome = $_POST['nome'];
$morada = $_POST['morada'];
$dataNascimento = $_POST['dataNascimento'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$password = $_POST['password'];

$hash = hash("sha512",date("y-m-d H:i:s"));
$pass = hash("sha512",$password);

$sql="INSERT INTO utilizador(Nome,DataNascimento,Morada,Telefone,Tipo,Email,Password,Imagem,Hash,Confirmed,isDeleted)
VALUES('$nome','$dataNascimento','$morada','$telefone',0,'$email','$pass','','$hash',1,0)";//nao esquecer de passar o Confirmed a 0
$resultado = mysqli_query($conn,$sql);

/*Codigo de enviar email*/

if($resultado){
	mysqli_close($conn);
	header("location:confirmaConta.php");
}else{
	mysqli_close($conn);
	header("location:login.php?registo=false");
}
?>