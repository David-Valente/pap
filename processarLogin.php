<?php 
require("ligacao.php");
$email = $_POST['email'];
$password = $_POST['pass'];
$pass = hash("sha512",$password);
$sql="SELECT * FROM utilizador WHERE Email = '$email' AND Password = '$pass'";
//agarra no sql e faz o query
$resultado = mysqli_query($conn,$sql);

//retorna o numero de linhas do query
$existe = mysqli_num_rows($resultado);

if($existe){

	$row = mysqli_fetch_assoc($resultado);
	
	if($row['isDeleted'] == "0"){
		if($row['Confirmed'] == "1"){
			$tipo = $row['Tipo'];
			session_start();
			$_SESSION['ID'] = $row['ID'];
			$_SESSION['Nome'] = $row['Nome'];
				//entrar como cliente treinador ou admin
			if($tipo == 0){
				header("location:entradaCliente.php");
			}else if($tipo == 1){
				header("location:entradaTreinador.php");
			}else if($tipo == 2){
				header("location:entradaAdmin.php");
			}
		}else{
			//fecha a ligacao
			mysqli_close($conn);
			//redirecionar para a pagina em questao
			header("location:login.php?confirmed=false");
		}
	}else{
		//se a conta não existir
		//fecha a ligacao
		mysqli_close($conn);
		//redirecionar para a pagina em questao
		header("location:login.php?user=deleted");
	}
}else{
	//Se a passe estiver errada
	//fecha a ligacao
	mysqli_close($conn);
	//redirecionar para a pagina em questao
	header("location:login.php?login=false");
}
?>