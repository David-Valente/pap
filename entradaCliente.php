<?php require("protecaoLogin.php"); ?>
<?php require("navbar.php"); ?>
<style type="text/css">
	body{
		background-color: black;
	}
</style>
<br><br><br><br><br><br><br><br><br>

<?php require("verificaMensalidade.php") ?>


<?php if($_SESSION["mensalidade"] === true) {?>
<div class="container">

	<h2>Minhas aulas</h2>
	<table class="table">
		<thead>
			<tr><th>Aula</th><th>Categoria</th><th>Treinador</th><th>Numero de Telemovel</th><th>Sala</th></tr>
		</thead>
		<tbody>
			<?php 
				$minhasAulas = array();
				$sql="SELECT a.Nome as aula , a.ID as idaula, ca.Nome as categoria, u.Nome as treinador, u.Telefone as telemovel, s.Nome as sala FROM aulas a 
				INNER JOIN categoria_aula ca ON ca.ID = a.ID_Categoria
				INNER JOIN utilizador u ON u.ID = a.ID_Treinador
				INNER JOIN sala s ON s.ID = a.ID_Sala
				INNER JOIN utilizador_aula ua ON ua.ID_Aula = a.ID
				WHERE ua.ID_Utilizador = ".$_SESSION['ID'];
				$resultado = mysqli_query($conn,$sql);
				while ($row = mysqli_fetch_assoc($resultado)) {
					array_push($minhasAulas, $row['idaula']);
					echo "<tr>";
					echo "<td>".$row['aula']."</td><td>".$row['categoria']."</td><td>".$row['treinador']."</td><td>".$row['telemovel']."</td><td>".$row['sala']."</td>";
					echo "</tr>";
				}
			 ?>
		</tbody>
	</table>

	<br><br>
	<div id="confirm" style="display: none">
		<h3>Deseja mesmo marcar esta mensalidade ?</h3>
		<a id="url"><button class="btn btn-info">Marcar</button></a>
	</div>
	<br><br>
	<h2>Aulas Disponiveis</h2>
	<table class="table">
		<thead>
			<tr><th>Aula</th><th>Categoria</th><th>Treinador</th><th>Numero de Telemovel</th><th>Sala</th></tr>
		</thead>
		<tbody>
			<?php 
				$sql="SELECT a.ID as id , a.Nome as aula , ca.Nome as categoria, u.Nome as treinador, u.Telefone as telemovel, s.Nome as sala FROM aulas a 
				INNER JOIN categoria_aula ca ON ca.ID = a.ID_Categoria
				INNER JOIN utilizador u ON u.ID = a.ID_Treinador
				INNER JOIN sala s ON s.ID = a.ID_Sala";
				$resultado = mysqli_query($conn,$sql);
				while ($row = mysqli_fetch_assoc($resultado)) {

					$sql="SELECT * FROM utilizador_aula ua WHERE ua.ID_Aula =".$row['id'];
					$resultado2 = mysqli_query($conn,$sql);
					$nAlunos = mysqli_num_rows($resultado2);

					$sql="SELECT Vagas FROM sala INNER JOIN aulas ON sala.ID = aulas.ID_Sala WHERE aulas.ID = ".$row['id'];
					$resultado3 = mysqli_query($conn,$sql);
					$row2 = mysqli_fetch_assoc($resultado3);
					$capacidade = $row2['Vagas'];

					echo "<tr>";
					echo "<td>".$row['aula']."</td><td>".$row['categoria']."</td><td>".$row['treinador']."</td><td>".$row['telemovel']."</td><td>".$row['sala']."</td>";
					if(!in_array($row['id'], $minhasAulas))
						echo "<td><button href='marcarAula.php?idAula=".$row['id']."' class='btn btn-info hiperlink'>Marcar Aula</button></td>";
					else if($nAlunos >= $capacidade){
						echo "<td>Sala Cheia</td>";
					}else{
						echo "Aula Marcada";
					}
					echo "</tr>";
				}
				mysqli_close($conn);
			 ?>
		</tbody>
	</table>
</div>
<?php } ?>

<script>
	$(".hiperlink").on("click",function(){
		$("#confirm").show();
		$("#url").attr("href",$(this).attr("href"));
	});
</script>

<?php if($_SESSION["mensalidade"] === false){ ?>

<div class="row" align="center">
	<div class="col-lg-12">
		<div class="alert alert-info" style="width:600px ">Nao tem a mensalidade deste mês paga ! Pode conferir <a href="mensalidades.php">aqui !</a></div>
	</div>
</div>

<?php } ?>


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
