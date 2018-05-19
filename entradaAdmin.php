<?php require("protecaoLogin.php"); ?>
<?php require("navbar.php"); ?>
<style type="text/css">
	body{
		background-color: black;
	}
	input{
	    display: block;
	    width: 100%;
	    height: 42px;
	    padding: 10px 20px;
	    font-size: 14px;
	    line-height: 1.42857;
	    color: #555555;
	    background-color: #fff;
	    background-image: none;
	    border: 1px solid #ccc;
	    border-radius: 4px;
	    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
	    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
	    -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
	    -o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
	    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
	}
</style>
<br><br><br><br><br><br><br><br><br>

<script>
	$(document).on("click","#ulCategorias li",function(){
		$("#ulCategorias .active").removeClass("active");
		$(this).addClass("active");
		$("#container > div").hide();
		$("#"+$(this).attr("tab")).show();
	});
</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/html-table-search.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#tableUser').tableSearch({
			searchText:'Find a user',
			searchPlaceHolder:''
		});
	});
</script>
<div class="container" style="top: 200px;position: absolute; width: 100%;">
	<ul class="nav nav-tabs nav-justified" id="ulCategorias">
	  <li role="presentation" tab="divUser" class="active"><a>User</a></li>
	  <li role="presentation" tab="divAulas"><a>Aulas</a></li>
	  <li role="presentation" tab="divMensalidades"><a>Mensalidades</a></li>
	  <li role="presentation" tab="divSala"><a>Sala</a></li>
	</ul>
	<div id="container">
		<div id="divUser">
			<div id="userAll">
				<table class="table" id="tableUser">
					<thead><tr><th>ID</th><th>Nome</th><th>Data Nascimento</th><th>Morada</th><th>Telefone</th><th>Tipo</th><th>Email</th><th>Validado</th><th>Apagado</th><th>Data</th><th>Delete</th></tr></thead>
					<tbody>
						<?php
							require("ligacao.php");
							$sql = "SELECT * FROM utilizador";
							$resultado = mysqli_query($conn,$sql);
							while($row = mysqli_fetch_assoc($resultado)){
								if($row["Tipo"] != "2"){
									echo "<tr>";
									echo "<td>{$row['ID']}</td>";
									echo "<td>{$row['Nome']}</td>";
									echo "<td>{$row['DataNascimento']}</td>";
									echo "<td>{$row['Morada']}</td>";
									echo "<td>{$row['Telefone']}</td>";
									if($row["Tipo"] == "0")
										echo "<td>Aluno</td>";
									else if($row['Tipo'] == "1")
										echo "<td>Professor</td>";
									echo "<td>{$row['Email']}</td>";

									if($row['Confirmed'] == "0")
										echo "<td>Nao</td>";
									else
										echo "<td>Sim</td>";

									if($row['isDeleted'] == "0")
										echo "<td>Nao</td>";
									else
										echo "<td>Sim</td>";

									echo "<td>{$row['Data']}</td>";
									if($row['isDeleted'] == "0")
										echo "<td><a href='apagarUser.php?id={$row['ID']}'><img style='width:30px; height:30px;' src='http://icons.iconarchive.com/icons/visualpharm/must-have/256/Delete-icon.png'></a></td>";
									else
										echo "<td><a href='restaurarUser.php?id={$row['ID']}'><img style='width:30px; height:30px;' src='https://www.yodot.com/images/recover-deleted-folders-on-mac.png'></a></td>";

									echo "</tr>";
								}
							}
							mysqli_close($conn);
						 ?>
					</tbody>
				</table>
			</div>
		</div>
		<div id="divAulas" style="display: none;">
			<br>
			<ul class="nav nav-tabs nav-justified">
				<li role="presentation" class="active"><a>All</a></li>
				<li role="presentation"><a>Add</a></li>
			</ul>
			<div id="aulaAll">
				<table class="table">
					<thead><tr><td>ID</td><td>Nome</td><td>Sala</td><td>Treinador</td><td>Tipo</td><td>Marcada</td><td>Data</td><th>Ver alunos</th></tr></thead>
					<tbody>
						<?php 
							require("ligacao.php");
							$sql="SELECT aulas.ID as idAula, aulas.Nome as nomeAula, aulas.Data as marcada, aulas.DataRegister as data, sala.Nome as sala, utilizador.Nome as treinador, categoria_aula.Nome as categoria FROM aulas INNER JOIN sala ON aulas.ID_Sala = sala.ID INNER JOIN utilizador ON aulas.ID_Treinador = utilizador.ID INNER JOIN categoria_aula ON aulas.ID_Categoria = categoria_aula.ID";
							$resultado = mysqli_query($conn,$sql);
							while($row = mysqli_fetch_assoc($resultado)){
								echo "<tr>";
								echo "<td>{$row['idAula']}</td>";
								echo "<td>{$row['nomeAula']}</td>";
								echo "<td>{$row['sala']}</td>";
								echo "<td>{$row['treinador']}</td>";
								echo "<td>{$row['categoria']}</td>";
								echo "<td>{$row['marcada']}</td>";
								echo "<td>{$row['data']}</td>";
								echo "<td><a target='_black' href='verAulaAluno.php?id={$row['idAula']}'>Aqui</a></td>";
								echo "</tr>";
							}
							mysqli_close($conn);
						?>
					</tbody>
				</table>
			</div>
			<div id="aulaAdd"></div>
		</div>		
		<div id="divMensalidades" style="display: none;">
			
		</div>
		<div id="divSala" style="display: none;">
			
		</div>
	</div>

</div>


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>