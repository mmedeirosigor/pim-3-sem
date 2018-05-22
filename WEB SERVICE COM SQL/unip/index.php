<?php
	require_once('connect.php');
	
	if(isset($_POST['submit']))
	{
		$nick = $_POST['nickname'];
		$pass = $_POST['senha'];
		if($nick==LOGIN && $pass==SENHA)
		{
			session_start();
			$_SESSION['nickname'] = LOGIN;
			$_SESSION['pass'] = SENHA;
			echo "<center><h1>Login feito com sucesso!</h1>
					<img src='img/carregando.gif' height='30%' width='20%'></center>";
		echo "<script>
			function ap(){	setTimeout(\"window.location='add_curso.php'\", 100);
			}
		ap()</script>";
		}
		else{
			echo "<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>M.I.J.H - Systems</title>
		<link rel='shortcut icon' type='imgage/x-icon' href='img/empresa_mini_logo.png'>
		<link rel='stylesheet' type='text/css' href='estilo_login.css'>
		<link href='https://fonts.googleapis.com/css?family=Cabin' rel='stylesheet'>
	</head>
	<body background='img/background.png'>
	<center>
		<img src='img/login.png'>
		<div id='form'>
			<form method='post' action=" . $_SERVER['PHP_SELF'] . ">
			<table>
			<tr>
				<td>Nickname</td>
				<td><input id='box-nick' type='text' name='nickname' value='$nick' autocomplete='off' required></td>
			</tr>
			</br>
				<tr>
					<td id='senha'>Senha</td>
					<td><input id='box-pass' type='password' name='senha' value='$pass' required></td>
				</tr>
			</table>
			</br>
				<input id='btn-login' type='submit' name='submit' value='Login'>
			</form>
		</div>
		<div id = 'wrong'>
			<p>Senha incorreta!!</br> Tente novamente.</p>
		</div>
		</center>
	</body>
</html> ";
		}
	}
	else
	{
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>M.I.J.H - Systems</title>
		<link rel="shortcut icon" type="imgage/x-icon" href="img/empresa_mini_logo.png" sizes="6x10">
		<link rel='stylesheet' type='text/css' href='estilo_login.css'>
		<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet"> 
	</head>
	<body background="img/background.png">
	<center>
		<img src='img/login.png'>
		<div id='form'>
			<form method='post' action="<?php echo $_SERVER['PHP_SELF'] ?>">
			<table>
			<tr>
				<td>Nickname</td>
				<td><input id='box-nick' type='text' name="nickname" autocomplete='off' value='<?php if(isset($nick)){echo $nick;} ?>' required></td>
			</tr>
			</br>
				<tr>
					<td>Senha</td>
					<td><input id='box-pass' type='password' name='senha' value='<?php if(isset($pass)){echo $pass;} ?>' required></td>
				</tr>
				</table>
			</br>
				<input id='btn-login' type='submit' name='submit' value='Login'>
			</form>
		</div>
		</center>
	</body>
</html>
	<?php 
	    
	} 
	?>