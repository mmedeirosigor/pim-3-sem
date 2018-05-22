<?php 
	session_start();
	if(!isset($_SESSION['nickname']) && !isset($_SESSION['pass'])){
		header("Location:exit_sessao.php");
	}
	else{
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
		    <?php 
		        if(isset($_POST['excluir'])){
		            $idcurso = $_POST['idcurso'];
		            $idsala = $_POST['idsala'];
		            $idturma = $_POST['idturma'];
		            require_once('connect.php');
		            $um = mysqli_query($con, "DELETE FROM cursos WHERE idCursos = '$idcurso'");
		            $dois = mysqli_query($con,"DELETE FROM salas WHERE idSalas = '$idsala'");
		            $tres = mysqli_query($con,"DELETE FROM turmas WHERE idTurmas = '$idturma'");
		            mysqli_close($con);
		            if($um && $dois && $tres){
		                echo "<h1>sucesso!</h1><a href='excluir.php'>Voltar</a>";
		            }
		            else{
		                echo "<h1>Erro de carregamento...Selecione o curso a ser excluido novamente</h1>";
		                echo "<meta http-equiv=\"refresh\" content=\"2;URL=excluir.php\">";
		            }
		        }
		    ?>
		</main>
	</body>
</html>
	<?php } ?>