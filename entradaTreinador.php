<?php 
require ("ligacao.php");
require ("navbar.php");
?>

<style type="text/css">
	body{
		background-color: black;
	}
</style>
<br><br><br><br><br><br><br><br><br>

 <?php 

 <h2>Minhas aulas</h2>
	<table class="table">
		<thead>
			<tr><th>Aula</th><th>Categoria</th><th>Cliente</th><th>Numero de Telemovel</th><th>Sala</th></tr>
		</thead>
		<tbody>
			<?php 
				$minhasAulas = array();
				$sql="SELECT s.Nome as sla , s.ID as idsala, s.Nome as nome, s.Vagas as vagas, u.Telefone as telemovel, s.Nome as sala FROM aulas a 
				INNER JOIN categoria_aula ca ON ca.ID = a.ID_Categoria
			 ?>
		</tbody>
	</table>

	 ?>