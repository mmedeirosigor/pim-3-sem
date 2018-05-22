<?php 
	session_start();
	if(!isset($_SESSION['nickname']) && !isset($_SESSION['pass'])){
		header("Location:exit_sessao.php");
	}
	else{
		if(isset($_POST['submit']))
		{
			$curso = $_POST['curso'];
			$semestre = $_POST['semestre'];
			$periodo = $_POST['periodo'];
			$sala = $_POST['sala'];
			
			require_once('connect.php');
			$query = "INSERT INTO cursos (Nome) VALUES ('$curso');";
			$query_one = "INSERT INTO salas (Nome) VALUES ('$sala');";
			mysqli_query($con,$query);
			mysqli_query($con,$query_one);
			$id_dois = mysqli_query($con,"SELECT idSalas FROM salas ORDER BY idSalas DESC LIMIT 1");
			$id_um = mysqli_query($con,"SELECT idCursos FROM cursos ORDER BY idCursos DESC LIMIT 1");
			if($id_um && $id_dois){
			$id_sala = mysqli_fetch_array($id_dois);
			    $sala = $id_sala['0'];
			$id_curso = mysqli_fetch_array($id_um);
			$curso = $id_curso['0'];
			$query_two = "INSERT INTO turmas (Cursos_idCursos, Salas_idSalas,Periodo,Semestre) VALUES ('$curso','$sala','$periodo','$semestre');";
			mysqli_query($con,$query_two);
			
			mysqli_close($con);
			}
			else{
			    echo "erro";
			}
		}
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
					<div id='se'><li><a href='add_curso.php'>Adicionar Curso</a></li><img src='img/plus.png' width='40' height='40'></div>
					<div id='nse'><li><a href='modificar.php'>Modificar Curso</a></li><img src='img/pen.png' width='40' height='40'></div>
					<div id='nse1'><li><a href='excluir.php'>Excluir Curso</a></li><img src='img/lixo.png' width='36' height='36'></div>
					<div id='nse2'><li><a href='listar.php'>Visualizar</a></li><img src='img/visualizar.png' width='36' height='36'></div>
				</ul>
				<div id='logo_down'><img src='img/empresa.png' alt='M.I.J.H'></div>
			</div>
		</header>
		<main>
			<form method='post' action='<?php echo $_SERVER['PHP_SELF']?>'>
				<label for='curso'>Curso:</label></br>
				<input id='box-curso' type='text' autocomplete='off' name='curso' required></br>
				
				<label for='semestre'>Semestre:</label></br>
				<select id='box-semestre' name='semestre' required>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
				</select></br>
				
				<label for='periodo'>Período:</label></br>
				<select id='box-periodo' name='periodo' required>
					<option>Manhã</option>
					<option>Tarde</option>
					<option>Noite</option>
					<option>Integral</option>
				</select></br>
				
				<label for='sala'>Sala</label></br>
				<input id='box-sala' type='text' autocomplete='off' name='sala' required></br>
				<div id='btn-sub'>
					<img id='img-sub' src='img/add.png' height='90%' width='102%'>
					<input id='sub' type="submit" name="submit">
				</div>
				</form>
		</main>
	</body>
</html>
	<?php } ?>