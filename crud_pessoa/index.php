<?php
	require_once 'classPessoa.php';
	$p = new Pessoa("crudpdo","localhost","root","");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>CRUD PDO</title>
	<link rel="stylesheet"  href="estilo.css">
</head>
<body>
	<head>
		<div class="titulo1">
			<h2>CRUD EM PDO</h2>
		</div>
	</head>
	<?php 
		if(isset($_POST['cadastro'])){//clicou no botão cadastar ou editar
			//editar
			if(isset($_GET['id_up'])&& !empty($_GET['id_up'])){
			$id_upd = addslashes($_GET['id_up']);
			$nome = addslashes($_POST['nome']);
			$telefone = addslashes($_POST['telefone']);
			$email = addslashes($_POST['email']);
			
				if(!empty($nome) && !empty($telefone) && !empty($email)){
					//editar-atualizar
					$p->atualizarDados($id_upd,$nome,$telefone,$email);
					header("location:index.php");

				}else{
					?>
						<div class="aviso">
							<h4>Preencha todos os campos !!</h4>
						</div>
					<?php
				}

		}else{//cadastrar
			$nome = addslashes($_POST['nome']);
			$telefone = addslashes($_POST['telefone']);
			$email = addslashes($_POST['email']);
		}
			if(!empty($nome) && !empty($telefone) && !empty($email)){
				//cadastrar
				if(!$p->cadastarPessoa($nome,$telefone,$email)){
				?>
					<div class="aviso">
						<h4>Email ja esta cadastrado !!</h4>
					</div>
				<?php
				}

			}else{
				?>
					<div class="aviso">
						<h4>Preencha todos os campos !!</h4>
					</div>
				<?php
			}
		}


	if(isset($_GET['id_up'])){//se a pessoa clicou no batão editar
			$id_update = addslashes($_GET['id_up']);
			$res = $p->buscarDadosPessoa($id_update);
			//echo "<script >window.location='index.php';</script>";
		}
	//metodo excluir
	if(isset($_GET['id'])){
		$id_pessoa = addslashes($_GET['id']);
		$p->excluirPessoa($id_pessoa);
		echo "<script >window.location='index.php';</script>";
	}
	?>
	<section id="esquerda">
		<form method="POST">
			<h2>CADASTRO PESSOA</h2>
			<label for="nome">NOME</label>
			<input type="text" name="nome" id="nome" value="<?php if(isset($res)){echo $res['nome'];} ?>">

			<label for="telefone">TELEFONE</label>
			<input type="text" name="telefone" id="telefone" value="<?php if(isset($res)){echo $res['telefone'];} ?>">

			<label for="email">EMAIL</label>
			<input type="email" name="email" id="email" value="<?php if(isset($res)){echo $res['email'];} ?>">

			<input type="submit" value="<?php if(isset($res)){echo"Atualizar";}else{echo"Cadastar";} ?>" name="cadastro" >
		</form>
	</section>
	<section id="direita">
	<table>
	<tr id="titulo">
		<td>Nome</td>
		<td>Telefone</td>
		<td colspan="2">Email</td>
				<?php
					$dados = $p->buscarDados();
					/*echo "<pre>";
					var_dump($dados);
					echo "</pre>";*/
					if(count($dados) > 0){//tem pessoa cadastrada no banco
						for ($i=0; $i < count($dados); $i++) { 
							echo "<tr>";
							foreach ($dados[$i] as $k => $v) {
								if($k != "id"){
									echo "<td>".$v."</td>";

								}
							}
							?>
								<td>
									<a href="index.php?id_up=<?php echo $dados[$i]['id']; ?>">Editar</a>

									<a href="index.php?id=<?php echo $dados[$i]['id']; ?>">Excluir</a><!-- passando o id da pessoa pela metodo get q vem do select dodos[$!]['id'] -->
								</td>
							<?php
							echo "</tr>";
						}
					}else{

					?>
			</tr>
		</table>
					<div class="aviso">
						<h4>Não há Pessoas cadastradas !!</h4>
					</div>
				<?php
					}
				?>
	</section>
<footer>
    <p>&copy; Crud em Pdo</p>
</footer>

</body>
</html>
