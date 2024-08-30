<?php
session_start();

// Verifica se o usuário está logado
if (empty($_SESSION)) {
    header("Location: index.php");
    exit();
}

// Inclui o arquivo de configuração para conectar ao banco de dados
include 'config.php';

// Inicializa as variáveis de mensagem
$message = "";
$messageColor = "";

// Obtém o ID do usuário logado
$user_id = $_SESSION['user_id'];

// Processa o upload da imagem e o registro do produto
if (isset($_POST['produto']) && isset($_POST['quantidade'])) {
    $produto_id = $_POST['produto'];
    $quantidade = $_POST['quantidade'];

    // Verifica se o diretório de upload existe, senão, cria
    if (!is_dir('upload')) {
        mkdir('upload', 0777, true);
    }

    // Insere o registro na tabela adicao
    $sqlAdicao = "INSERT INTO adicao (produto_id, quantidade, hora_adicao, user_id)
                  VALUES (?, ?, NOW(), ?)";
    $stmtAdicao = $conn->prepare($sqlAdicao);
    $stmtAdicao->bind_param("iis", $produto_id, $quantidade, $user_id);

    if ($stmtAdicao->execute()) {
        $message = "Adição registrada com sucesso!";
        $messageColor = "success";
    } else {
        $message = "Erro ao registrar adição do produto.";
        $messageColor = "error";
    }

    $stmtAdicao->close();
}

$conn->close();

// Redireciona para a página de cadastro com a mensagem e os produtos encontrados
header("Location: adicionar.php?message=$message&messageColor=$messageColor");
exit();
?>
