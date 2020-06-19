<?php
require 'banco.php';

//Validação dos erros
// Validar somente quando tenha uma chamada POST
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$nomeErro = null;
	$enderecoErro = null;
	$telefoneErro = null;
	$emailErro = null;
	$sexoErro = null;

	if(!empty($_POST)){
		$validacao = True;
		$novoUsuario = False;
		if(!empty($_POST['nome'])){
			$nome = $_POST['nome'];
		}else{
			$nomeErro = 'Por favor digite o seu nome!';
			$validacao = False;
		}

		if(!empty($_POST['endereco'])){
			$endereco = $_POST['endereco'];
		}else{
			$enderecoErro = 'Por favor digite o seu endereço!';
			$validacao = False;
		}

		if(!empty($_POST['telefone'])){
			$telefone = $_POST['telefone'];
		}else{
			$telefoneErro = 'Por favor digite o número do telefone';
			$validacao = False;
		}

		if(!empty($_POST['email'])){
			$email = $_POST['email'];
			if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
				$emailErro = 'Por favor digite um endereço de email VÁLIDO!';
				$validacao = False;
			}
		}else{
			$emailErro = 'Por favor digite um endereço de email!';
			$validacao = False;
		}

		if(!empty($_POST['sexo'])){
			$sexo = $_POST['sexo'];
		}else{
			$sexoErro = 'Por favor selecione um campo!';
			$validacao = False;
		}
	}

//Inserindo no Banco de dados
	if($validacao){
		$pdo = Banco::conectar();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO pessoa (nome, endereco, telefone, email, sexo) VALUES (?,?,?,?,?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($nome, $endereco, $telefone, $email, $sexo));
		Banco::desconectar();
		header("Location: index.php");
	}	
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Adicionar Contato</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<div class="span10 offset1">
				<div class="card">
					<div class="card-header">
						<h3 class="well">Adicionar Contato</h3>
					</div>
					<div class="card-box">	
						<form class="form-horizontal" action="create.php">	
							<div class="control-group <?php echo !empty($nomeErro) ? 'error ' :''; ?>">
								<label class="control-label">Nome</label>
								<div class="controls">
									<input size="50" class="form-control" name="nome" type="text" placeholder="Nome" value="<?php echo !empty($nome) ? $nome : '';?>">
									<?php if (!empty($nomeErro)): ?>
									 	<span class="text-danger"><?php echo $nomeErro; ?></span> 
									 <?php endif; ?>
								</div>
							</div>		 	
						</form>	

	</body>
</html>