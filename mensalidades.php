<?php require("protecaoLogin.php"); ?>
<?php require("navbar.php"); ?>
<style type="text/css">
	body{
		background-color: black;
	}
</style>
<br><br><br><br><br><br><br>
<div class="container" align="center">
	<h2 align="center">Mensalidades</h2>

	<div id="confirm" style="display: none">
		<h3>Deseja mesmo pagar esta mensalidade ?</h3>
		<a id="url"><button class="btn btn-info">Pagar</button></a>
	</div>
<table class="table"><thead><tr><td>Mes</td><td>Ano</td><td>Valor</td><td>Pago</td></tr></thead><tbody>
<?php 
	require("ligacao.php");
	$month = date("m");
	$year = date("y");

	$sql = "SELECT * FROM mensalidade";
	$resultado = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($resultado)){
		echo "<tr>";

		echo "<td>".$row['Mes']."</td><td>".$row['Ano']."</td><td>".$row['Valor']."</td>";

		$sql = "SELECT u.ID FROM utilizador u 
		INNER JOIN utilizador_mensalidade um ON u.ID = um.ID_Utilizador 
		INNER JOIN mensalidade m ON m.ID = um.ID_Mensalidade
		WHERE m.ID =".$row['ID'];

		$resultado2 = mysqli_query($conn,$sql);

		$numRow = mysqli_num_rows($resultado2);

		if($numRow === 0)
			echo "<td><button href='pagarMensalidade.php?idMensalidade=".$row['ID']."' class='btn btn-info hiperlink'>Pagar</button></td>";
		else
			echo "<td>Pago</td>";

		echo "</tr>";
	}
	mysqli_close($conn);
 ?>
</tbody></table>
<script>
	
$(".hiperlink").on("click",function(){
	$("#confirm").show();
	$("#url").attr("href",$(this).attr("href"));
});

</script>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
