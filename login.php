<?php
	session_start();

	if(empty($_POST) or (empty($_POST["usuario"]) or (empty($_POST["senha"]) ) ) ){
		print "<script>location.href='index.php';</script>";
	}

	include("config.php");

	$usuario = $_POST["usuario"];
	$senha   = $_POST["senha"];

	$sql = "SELECT * FROM users WHERE usuario = '{$usuario}' AND senha  = '{$senha}' ";

	$res = $conn->query($sql) or die($conn->error);

	$row = $res->fetch_object();

	$qtd = $res->num_rows;

	if($qtd>0){
		$_SESSION["usuario"] = $usuario;
		$_SESSION["nome"] = $row->nome;
		$_SESSION["tipo"] = $row->tipo;
		$_SESSION["id_user"] = $row->id_user;
		print "<script>location.href='dashboard.php';</script>";
	}else{
		unset($usuario);
		print "<script>alert('Usuário e/ou Senha incorretos! ');</script>";
		print "<script>location.href='index.php';</script>";
	}
?>