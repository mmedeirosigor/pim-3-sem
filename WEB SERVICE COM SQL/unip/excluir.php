<?php 
	session_start();
	if(!isset($_SESSION['nickname']) && !isset($_SESSION['pass'])){
		header("Location:exit_sessao.php");
	}
	else{
	    require_once('connect.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>M.I.J.H - Systems</title>
		<link rel="shortcut icon" type="imgage/x-icon" href="img/empresa.png">
		<link rel='stylesheet' href='estilo.css' type='text/css'>
		<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
	</head>
	<body background="img/background.png">
		<div id='btn-sair'>
			<a href='exit_sessao.php'>Sair</a>
		</div>
		<header>
			<div id='cabeca'>
				<ul>
					<div id='nse'><li><a href='add_curso.php'>Adicionar Curso</a></li><img src='img/plus.png' width='40' height='40'></div>
					<div id='nse'><li><a href='modificar.php'>Modificar Curso</a></li><img src='img/pen.png' width='40' height='40'></div>
					<div id='se'><li><a href='excluir.php'>Excluir Curso</a></li><img src='img/lixo.png' width='36' height='36'></div>
					<div id='nse2'><li><a href='listar.php'>Visualizar</a></li><img src='img/visualizar.png' width='36' height='36'></div>
				</ul>
				<div id='logo_down'><img src='img/empresa.png' alt='M.I.J.H'></div>
			</div>
		</header>
		<main>
			<div id='form-curso-mostrar'>
				<form method='post' action='<?php echo $_SERVER['PHP_SELF'] ?>'>
					<table>
						<tr>
							<td><h2>Selecione o curso:</h2></td>
							</br>
						</tr>
						<tr>
							<td>
							<select name='curso' id='curso-btn-mostrar' onchange="this.form.submit()">
							    <option>Selecione</option>
								<?php 
								$req="SELECT * FROM cursos";
								$dados=mysqli_query($con,$req);
								while($row=mysqli_fetch_array($dados)){
									echo "<option>" . $row[1] . "</option>";
								}
							?>
							</select>
							</td>
						</tr>
					</table>
					</br>
				</form>
			</div>
			<?php 
			if(isset($_POST['curso']))
			{
				$nome_curso = $_POST['curso'];
					$pegar_id_curso = mysqli_query($con,"SELECT * FROM cursos WHERE Nome = '$nome_curso'");
				if($pegar_id_curso){
				    $dcp = mysqli_fetch_array($pegar_id_curso);
				    $id_curso = $dcp[0];
				}
				else{
				    echo "erro linha 68";
				}
				$pegar_dados_turma = mysqli_query($con, "SELECT * FROM turmas WHERE Cursos_idCursos = '$id_curso'");
				if($pegar_dados_turma){
				    $dtp = mysqli_fetch_array($pegar_dados_turma);
				    $id_turma = $dtp[0];
				    $id_salas = $dtp[2];
				    $periodo = $dtp[3];
				    $semestre = $dtp[4];
				}
				else{
				    echo "erro linha 79";
				}
				$pegar_dados_sala = mysqli_query($con, "SELECT * FROM salas WHERE idSalas = '$id_salas'");
				if($pegar_dados_sala){
				    $dsp = mysqli_fetch_array($pegar_dados_sala);
				    $sala = $dsp[1];
				}
				else{
				    echo "erro linha 87";
				}
				
				echo "<div id='info'><b>Curso:</b> $nome_curso
						</br>
						<b>Semestre:</b> $semestre
						</br>
						<b>Período:</b> $periodo
						</br>
						<b>Sala:</b>    $sala
						</br>
					<form method='post' action='excluir_sucesso.php'>
					    <input type='submit' value='Excluir' name='excluir'>
					    <input type='hidden' name='idsala' value='$id_salas'>
					    <input type='hidden' name='idturma' value='$id_turma'>
					    <input type='hidden' name='idcurso' value='$id_curso'>
					</form>
				</div>";
			}
		?>
		</main>
	</body>
</html>
	<?php } ?>