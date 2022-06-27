<?php
	try{
		$conexao = new PDO('mysql:host=localhost;dbname=jornal', 'root', '');
		$conexao ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo 'ERROR: ' . $e->getMessage();
	}
?>