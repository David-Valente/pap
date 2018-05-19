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
	.toSubmit{
		cursor: pointer;
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


	$(document).on("click","#ulAulas li",function(){
		$("#ulAulas .active").removeClass("active");
		$(this).addClass("active");
		$("#containerAulas > div").hide();
		$("#"+$(this).attr("tab")).show();
	});

	$(document).on("click","#ulMensalidade li",function(){
		$("#ulMensalidade .active").removeClass("active");
		$(this).addClass("active");
		$("#containerMensalidade > div").hide();
		$("#"+$(this).attr("tab")).show();
	});

	$(document).on("click","#ulSala li",function(){
		$("#ulSala .active").removeClass("active");
		$(this).addClass("active");
		$("#containerSala > div").hide();
		$("#"+$(this).attr("tab")).show();
	});

	$(document).on("click",".toSubmit",function(){
		$(this).parent().parent().find("form").submit();
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
			<ul class="nav nav-tabs nav-justified" id="ulAulas">
				<li role="presentation" tab="aulaAll" class="active"><a>All</a></li>
				<li role="presentation" tab="aulaAdd"><a>Add</a></li>
			</ul>
			<div id="containerAulas">
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
				<div id="aulaAdd" style="display: none;">
					<form action="addAula.php" method="post">
						<table class="table">
							<thead><th>Nome</th><th>Sala</th><th>Treinador</th><th>Tipo</th><th>Marcado</th></thead>
							<tbody>
								<tr>
									<td><input type="text" class="form-control" name="nomeAula"></td>
									<td>
										<select class="form-control" name="salaAula">
											<?php 
												require("ligacao.php");
												$sql="SELECT * FROM sala";
												$resultado = mysqli_query($conn,$sql);
												while($row = mysqli_fetch_assoc($resultado)){
													echo "<option value='{$row['ID']}'>{$row['Nome']}</option>";
												}
												mysqli_close($conn);
											 ?>
										</select>
									</td>
									<td>
										<select class="form-control" name="treinadorAula">
											<?php 
												require("ligacao.php");
												$sql="SELECT * FROM utilizador WHERE tipo = 1";
												$resultado = mysqli_query($conn,$sql);
												while($row = mysqli_fetch_assoc($resultado)){
													echo "<option value='{$row['ID']}'>{$row['Nome']}</option>";
												}
												mysqli_close($conn);
											 ?>
										</select>
									</td>
									<td>
										<select class="form-control" name="categoriaAula">
											<?php 
												require("ligacao.php");
												$sql="SELECT * FROM categoria_aula";
												$resultado = mysqli_query($conn,$sql);
												while($row = mysqli_fetch_assoc($resultado)){
													echo "<option value='{$row['ID']}'>{$row['Nome']}</option>";
												}
												mysqli_close($conn);
											 ?>
										</select>
									</td>
									<td><input type="date" name="dateAula" class="form-control"></td>
									<td><input type="submit" class="btn btn-primary"></td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
			</div>
		</div>		
		<div id="divMensalidades" style="display: none;">
			<br>
			<ul class="nav nav-tabs nav-justified" id="ulMensalidade">
				<li role="presentation" tab="mensalidadeAll" class="active"><a>All</a></li>
				<li role="presentation" tab="mensalidadeAdd"><a>Add</a></li>
			</ul>
			<div id="containerMensalidade">
				<div id="mensalidadeAll">
					<table class="table">
						<br>
						<thead><tr><td></td><td>ID</td><td>Mes</td><td>Ano</td><td>Pago</td><th>Ver pagantes</th><th>Edit</th></tr></thead>
						<tbody>
							<?php 
								require("ligacao.php");
								$sql="SELECT * FROM mensalidade";
								$resultado = mysqli_query($conn,$sql);
								$mes = date("m");
								$year = date("y");
								while($row = mysqli_fetch_assoc($resultado)){
								
									echo "<tr>";
									echo "<form action='editMensalidade.php?id={$row['ID']}' method='post'>";
									echo "<td><input type='hidden' name='idMensalidade' value='{$row['ID']}'></td>";
									echo "<td>{$row['ID']}</td>";
									echo "<td>{$row['Mes']}</td>";
									echo "<td>{$row['Ano']}</td>";
									if($mes <= $row['Mes'] && $year == $row['Ano'])
										echo "<td><input class='form-control' name='valor' value='{$row['Valor']}'></td>";
									else
										echo "<td>{$row['Valor']}</td>";
									echo "<td><a target='_black' href='verPagantes.php?id={$row['ID']}'>Aqui</a></td>";
									if($mes <= $row['Mes'] && $year == $row['Ano'])
										echo "<td><a class='toSubmit'><img style='width:30px; height:30px;' src='https://vignette.wikia.nocookie.net/hungry-shark/images/4/42/512px-Edit_font_awesome.svg.png'></a></td>";
									else
										echo "<td>Nao editavel</td>";
									echo "</form>";
									echo "</tr>";
									
								}
								mysqli_close($conn);
							?>
						</tbody>
					</table>
				</div>
				<div id="mensalidadeAdd" style="display: none;">
					<br>
					<form action="addMensalidade.php" method="post">
						<table class="table">
							<thead><th>Mes</th><th>Ano</th><th>Valor</th></thead>
							<tr>
								<td><input type="number" name="monthMensalidade"></td>
								<td><input type="number" name="yearMensalidade"></td>
								<td><input type="number" name="precoMensalidade"></td>
								<td><input type="submit" class="btn btn-primary"></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
		<div id="divSala" style="display: none;">
			<br>
			<ul class="nav nav-tabs nav-justified" id="ulSala">
				<li role="presentation" tab="salaAll" class="active"><a>All</a></li>
				<li role="presentation" tab="salaAdd"><a>Add</a></li>
			</ul>
			<div id="containerSala">
				<div id="salaAll">
					<table class="table">
						<br>
						<thead><tr><th>ID</th><th>Nome</th><th>Vagas</th><th>Edit</th></tr></thead>
						<tbody>
							<?php 
								require("ligacao.php");
								$sql="SELECT * FROM sala";
								$resultado = mysqli_query($conn,$sql);
								while($row = mysqli_fetch_assoc($resultado)){
									echo "<tr>";
									echo "<form action='editSala.php?id={$row['ID']}' method='post'>";
									echo "<td style='display:none;'><input type='hidden' name='idSala' value='{$row['ID']}'></td>";
									echo "<td>{$row['ID']}</td>";
									echo "<td>{$row['Nome']}</td>";
									echo "<td><input class='form-control' name='valor' value='{$row['Vagas']}'></td>";
									echo "<td><a class='toSubmit'><img style='width:30px; height:30px;' src='https://vignette.wikia.nocookie.net/hungry-shark/images/4/42/512px-Edit_font_awesome.svg.png'></a></td>";
									echo "</form>";
									echo "</tr>";
								}
								mysqli_close($conn);
							?>
						</tbody>
					</table>
				</div>
				<div id="salaAdd" style="display: none;">
					<br>
					<form action="addSala.php" method="post">
						<table class="table">
							<thead><th>Nome</th><th>Vagas</th></thead>
							<tr>
								<td><input type="text" name="nomeSala"></td>
								<td><input type="number" name="vagasSala"></td> <td><input type="submit" class="btn btn-primary"></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>

</div>


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>