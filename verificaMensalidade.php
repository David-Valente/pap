<?php 
require("ligacao.php");
$month = date("m");
$year = date("y");

$sql = "SELECT u.ID FROM utilizador u 
INNER JOIN utilizador_mensalidade um ON u.ID = um.ID_Utilizador 
INNER JOIN mensalidade m ON m.ID = um.ID_Mensalidade
WHERE m.Mes = $month AND m.Ano = $year AND u.ID =".$_SESSION['ID'];

$resultado = mysqli_query($conn,$sql);
$numRows = mysqli_num_rows($resultado);

if($numRows === 0)
	$_SESSION["mensalidade"] = false;
else 
	$_SESSION["mensalidade"] = true;