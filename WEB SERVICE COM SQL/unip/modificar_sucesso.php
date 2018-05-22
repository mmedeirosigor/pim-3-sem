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
					<div id='se'><li><a href='modificar.php'>Modificar Curso</a></li><img src='img/pen.png' width='40' height='40'></div>
					<div id='nse1'><li><a href='excluir.php'>Excluir Curso</a></li><img src='img/lixo.png' width='36' height='36'></div>
					<div id='nse2'><li><a href='listar.php'>Visualizar</a></li><img src='img/visualizar.png' width='36' height='36'></div>
				</ul>
				<div id='logo_down'><img src='img/empresa.png' alt='M.I.J.H'></div>
			</div>
		</header>
		<main>
			<?php 
			    if(isset($_POST['edit'])){
			        $curso_old = $_POST['curso_select'];
			        
			        $curso_new = $_POST['curso'];
			        $semestre_new = $_POST['semestre'];
			        $periodo_new = $_POST['periodo'];
			        $sala_new = $_POST['sala'];
			        
			        require_once('connect.php');
			        $pegar_id_curso = mysqli_query($con , "SELECT idCursos FROM cursos WHERE Nome = '$curso_old'");
			        if($pegar_id_curso){
			            $dd_curso = mysqli_fetch_array($pegar_id_curso);
			            $id_curso = $dd_curso[0]; 
			        }
			        else{
			            echo "erro na linha 50";
			        }
			        $dados_old_turma = mysqli_query($con, "SELECT * FROM turmas WHERE Cursos_idCursos = '$id_curso'");
			        
			        if($dados_old_turma){
			            $req_turma = mysqli_fetch_array($dados_old_turma);
			            $idturma = $req_turma[0];
			            $idsala = $req_turma[2];
			            $periodo = $req_turma[3];
			            $semestre = $req_turma[4];
			        }
			        else{
			            echo "Erro na linha 62";
			        }
			            
			            $um = mysqli_query($con, "UPDATE turmas SET Periodo = '$periodo_new', Semestre = '$semestre_new' WHERE idTurmas = '$idturma' AND Cursos_idCursos = '$id_curso'");
			            
			            $dois = mysqli_query($con, "UPDATE salas SET Nome = '$sala_new' WHERE idSalas = '$idsala'");
			            
			            $tres = mysqli_query($con, "UPDATE cursos SET Nome = '$curso_new' WHERE idCursos = '$id_curso'");
			            if($um && $dois && $tres){
			                 echo "Sucesso";
			            }
			            else{
			                echo "erro linha 74";
			            }
			    }
			?>
		</main>
	</body>
</html>
	<?php } ?>