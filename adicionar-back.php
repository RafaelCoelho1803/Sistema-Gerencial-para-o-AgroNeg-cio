<?php 
session_start();

// Verifica se o usuário está logado
if (empty($_SESSION)) {
    header("Location: index.php");
    exit();
}

include 'config.php';

$message = "";
$messageColor = "";

$user_id = $_SESSION['id_user'];

if (isset($_POST['produto']) && isset($_POST['quantidade'])) {
    $produto_id = $_POST['produto'];
    $quantidade = $_POST['quantidade'];

    // Busca o caminho da imagem do produto
    $sqlProduto = "SELECT Nome, Quantidade, UnidadeMedida, Marca, Validade, imagem_path 
                   FROM produto 
                   WHERE id_produto = ?";
    $stmtProduto = $conn->prepare($sqlProduto);
    if ($stmtProduto === false) {
        $message = "Erro na preparação da consulta do produto.";
        $messageColor = "error";
    } else {
        $stmtProduto->bind_param("i", $produto_id);
        $stmtProduto->execute();
        $resultProduto = $stmtProduto->get_result();
        $produto = $resultProduto->fetch_assoc();

        if ($produto) {
            // Atualiza ou insere na tabela 'estoque'
            $sqlEstoque = "SELECT quantidade_atual FROM estoque WHERE produto_id = ?";
            $stmtEstoque = $conn->prepare($sqlEstoque);
            if ($stmtEstoque === false) {
                $message = "Erro na preparação da consulta de estoque.";
                $messageColor = "error";
            } else {
                $stmtEstoque->bind_param("i", $produto_id);
                $stmtEstoque->execute();
                $resultEstoque = $stmtEstoque->get_result();
                if ($resultEstoque->num_rows > 0) {
                    // Produto já está no estoque, somar a quantidade
                    $estoque = $resultEstoque->fetch_assoc();
                    $quantidade_nova = $estoque['quantidade_atual'] + $quantidade;

                    $sqlUpdateEstoque = "UPDATE estoque SET quantidade_atual = ? WHERE produto_id = ?";
                    $stmtUpdateEstoque = $conn->prepare($sqlUpdateEstoque);
                    $stmtUpdateEstoque->bind_param("ii", $quantidade_nova, $produto_id);
                    $stmtUpdateEstoque->execute();
                    $stmtUpdateEstoque->close();
                } else {
                    // Produto não está no estoque, inserir novo registro
                    $sqlInsertEstoque = "INSERT INTO estoque (produto_id, quantidade_atual) VALUES (?, ?)";
                    $stmtInsertEstoque = $conn->prepare($sqlInsertEstoque);
                    $stmtInsertEstoque->bind_param("ii", $produto_id, $quantidade);
                    $stmtInsertEstoque->execute();
                    $stmtInsertEstoque->close();
                }
                $stmtEstoque->close();
            }

            // Inserção na tabela 'adicao'
            $sqlAdicao = "INSERT INTO adicao (produto_id, quantidade, hora_adicao, user_id)
                          VALUES (?, ?, NOW(), ?)";
            $stmtAdicao = $conn->prepare($sqlAdicao);
            if ($stmtAdicao === false) {
                $message = "Erro na preparação da consulta de adição.";
                $messageColor = "error";
            } else {
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
        } else {
            $message = "Produto não encontrado.";
            $messageColor = "error";
        }

        $stmtProduto->close();
    }
}

$conn->close();

header("Location: adicionar.php?message=$message&messageColor=$messageColor&imagem_path=" . urlencode($produto['imagem_path']) . "&produto_nome=" . urlencode($produto['Nome']) . "&produto_marca=" . urlencode($produto['Marca']));
exit();
?>
