<?php 
	/**
	 * 
	 */
	class Pessoa{
		
		private $pdo;

	//6 função
		//conexao com o banco de dados
		public  function __construct($dbname,$host,$user,$senha){
			try {
				$this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
			} catch (PDOException $e) {
				echo "erro com o banco".$e->getMessage();
				exit();
			}
			catch(Exception $e){
				echo "erro generico".$e->getMessage();
			}

		}
		//Busca dos registros do banco
		public function buscarDados(){

			$res = array();
			$cmd = $this->pdo->query("SELECT * FROM pessoa ORDER BY nome");
			$res = $cmd->fetchAll(PDO::FETCH_ASSOC);
			return $res;

		}
		//cadastar pessoas no banco de dados
		public function cadastarPessoa($nome,$telefone,$email){
			//Antes de cadastrar verificaremos se ja esta cadastrada
			$cmd = $this->pdo->prepare("SELECT id FROM pessoa WHERE email = :e");
			$cmd->bindValue(":e",$email);
			$cmd->execute();

				if($cmd->rowCount() > 0){//email ja cadastrado
					return false;
				}else{
				//se não encontro ira cadastrar
					$cmd = $this->pdo->prepare("INSERT INTO pessoa(nome,telefone,email)VALUES(:n,:t,:e)");
					$cmd->bindValue(":n",$nome);
					$cmd->bindValue(":t",$telefone);
					$cmd->bindValue(":e",$email);
					$cmd->execute();
					return true;
				}
		}
		//delete dados do banco
		public function excluirPessoa($id){
			$cmd = $this->pdo->prepare("DELETE FROM pessoa WHERE id = :id");
			$cmd->bindValue(":id",$id);
			$cmd->execute();
		}

		//Buscar os dados da pessoa no banco
		public function buscarDadosPessoa($id){
			$res = array();
			$cmd = $this->pdo->prepare("SELECT * FROM pessoa WHERE id =:id");
			$cmd->bindValue(":id",$id);
			$cmd->execute();
			$res = $cmd->fetch(PDO::FETCH_ASSOC);
			return $res;
		}



		//atualizar os dados no banco
		public function atualizarDados($id,$nome,$telefone,$email){

		$cmd = $this->pdo->prepare("UPDATE pessoa SET nome =:n, telefone =:t, email =:e WHERE id =:id");
			$cmd->bindValue(":n",$nome);
			$cmd->bindValue(":t",$telefone);
			$cmd->bindValue(":e",$email);
			$cmd->bindValue(":id",$id);
			$cmd->execute();

		}
	}
 ?>