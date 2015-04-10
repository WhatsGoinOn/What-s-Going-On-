<?php
require_once('login/config/db.php');

if(isset($_GET['id'])) {
	try {
		$pdo = new PDO(DB_PDOHOST, DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		$sql = $pdo->prepare("SELECT Name, Image, Type, Size FROM images WHERE ID = :id");
		$sql->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
		$sql->execute();
		$result = $sql->fetch();
		
		header("Content-length: " . $result['Size']);
		header("Content-type: " . $result['Type']);
		header('Content-Disposition: inline; filename="' . $result['Name'] . '"');
		echo $result['Image'];
	} catch(PDOException $e) {
		echo('DATABASE ERROR: ' . $e->getMessage());
	}
	
	$pdo = null;
}