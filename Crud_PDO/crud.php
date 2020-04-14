<?php 
//--------------------------CONEXAO--------------------------------------
try {
  	  	$pdo = new PDO("mysql:dbname=crudpdo;host=localhost","root","");	
//dbneme,host,usuario e senha

} catch (PDOException $e) {
  	echo "Erro com banco de dados: ".$e->getMessage();
}  
catch(Exception $e){
	echo "Erro generico ".$e->getMessage();
}
//---------------------------------INSERT-------------------------------------------
//1 forma com paramentro:
/*$res = $pdo->prepare("INSERT INTO pessoa(nome,telefone,email) VALUES (:n,:t,:e)");
$res->bindValue(":n","Miriam");
$res->bindValue(":t","00000000");
$res->bindValue(":e","Teste@gmail.com");
$res->execute();

//2 forma passa sem parametro
//$res = $pdo->query("INSERT INTO pessoa(nome, telefone, email)VALUES('Mir','00000000','teste@gmail.com')");

//---------------------------------Delete --------------------------------
// 1 Forma
$res = $pdo->prepare("DELETE FROM pessoa WHERE id = :id");
$id = 2;
$res->bindValue(":id",$id);
$res->execute();

// 2 forma
//$res = $pdo->query("DELETE FROM pessoa WHERE id = '1'");

//------------------------------------update-------------------------------------------
//1 forma
$res = $pdo->prepare("UPDATE pessoa SET email = :e WHERE id = :id");
$res->bindValue(":e","merie@gmail.com");
$res->bindValue(":id",1);
$res->execute();

//2 forma
$res = $pdo->query("UPDATE pessoa SET email = 'paulo@gmail.com' WHERE id = '4'");

//---------------------------------select-------------------------------------------
//1fomar
$res = $pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
$res->bindValue(":id",1);
$res->execute();
$resultado = $res->fetch(PDO::FETCH_ASSOC);//uma unica resgistro do banco de dados 
//ou
//$resultado = $res->fetchAll();//todas os registro do banco de dados

foreach ($resultado as $key => $value) {
	echo $key.": ".$value."<br>";
}*/
/*echo "<pre>";
print_r($resultado);
echo "</pre>";*/

//2 forma
/*$res = $pdo->query("SELECT * FROM pessoa WHERE id = '4'");
$resultado = $res->fetch(PDO::FETCH_ASSOC);//uma unica resgistro do banco de dados 
var_dump($resultado);//mostrando o resultado do array feito pelo fetch*/


?>