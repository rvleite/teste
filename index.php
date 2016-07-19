<?php
ob_start();
session_start();
if(isset($_SESSION['usuarilog'])&&(isset($_SESSION['senhalog']))){
header("Location:home.php");
}

include ("conexao.php");
?>

<!DOCTYPE html>
<html lang="br">
  
<head>
    <meta charset="utf-8">
    
    <title>Login - Clube</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

<link href="css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/pages/signin.css" rel="stylesheet" type="text/css">

</head>

<body>
	
	<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">

		<a class="brand pull-left"><img src="img/logo.jpg" width="90" height="30"/></a>
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<a class="brand" href="index.php">
				Login - Clube			
			</a>		
			
			
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->



<div class="account-container">
	<?php
	
	if(isset($_GET['acao'])){
		if(!isset($_POST['logar'])){
	$acao = $_GET['acao'];
	if($acao=='negado'){
		
			echo '<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Erro ao acessar!</strong> você precisa estar logado para acessar o sistema!  </div>';
		
	}
	}
	
	}
	
	if(isset($_POST['logar'])){
	//recuperar dadosform
	$usuario = trim(strip_tags($_POST['usuario']));
	$senha = trim(strip_tags($_POST['senha']));
	//selecionar banco de dados
	
	$select = "SELECT * from usuarios where login = '$usuario' AND senha = '$senha' LIMIT 1";
	
	try {
	$result = $conn->prepare($select);
	$result->bindParam(':usuario',$usuario,PDO::PARAM_STR);
	$result->bindParam(':senha',$senha,PDO::PARAM_STR);
	$result->execute();
	$contar = $result->rowCount();

		if($contar==1){
			$usuario = $_POST ['usuario'];
			$senha = $_POST ['senha'];
			$_SESSION['usuarilog'] = $usuario;
			$_SESSION['senhalog'] = $senha;
			
			echo '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Logado com Sucesso!</strong> Acessando o sistema!   </div>';
			
			header ("Refresh: 1, home.php?acao=welcome");
		}else{
		echo '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Dados digitado incorretos!</strong> Digite o dados corretos!  </div>';
		header ("Refresh: 1, index.php");
	 }
	}catch (Exception $e) {
	echo $e;
}
	}
	
	?>
	<div class="content clearfix">
		
		<form action="#" method="post" enctype "multipart/form-data">
		
			<h1>Faça seu Login</h1>		
			
			<div class="login-fields">
				
				<p>Entre com seus dados:</p>
				
				<div class="field">
					<label for="username">Usuário</label>
					<input type="text" id="usuario" name="usuario" value="" placeholder="Usuário" class="login username-field" />
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Senha:</label>
					<input type="password" id="senha" name="senha" value="" placeholder="Senha" class="login password-field"/>
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
			
									
				<button class="button btn btn-success btn-large" name="logar" type="submit">Entrar no Sistema</button>
				
			</div> <!-- .actions -->
			
			
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->


<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/bootstrap.js"></script>

<script src="js/signin.js"></script>

</body>

</html>
