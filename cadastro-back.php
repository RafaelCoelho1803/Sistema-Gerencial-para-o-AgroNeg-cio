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

// Processa o upload da imagem e o registro do produto
if (isset($_FILES['imagem'])) {
    $arquivoTmp = $_FILES['imagem']['tmp_name'];
    $nomeArquivo = $_FILES['imagem']['name'];
    $diretorioDestino = 'upload/' . $nomeArquivo;

    // Verifica se o diretório de upload existe, senão, cria
    if (!is_dir('upload')) {
        mkdir('upload', 0777, true);
    }

    // Move o arquivo para o diretório de upload
    if (move_uploaded_file($arquivoTmp, $diretorioDestino)) {
        $nomeProduto = $_POST['nome_produto']; // Adicionado
        $quantidade = $_POST['quantidade'];
        $unidadeMedida = $_POST['unidade_medida'];
        $marca = $_POST['marca'];
        $validade = $_POST['validade'];
        $classificacao = $_POST['classificacao'];
        $fornecedor = $_POST['fornecedor'];

        // Inserindo o caminho da imagem e o nome do produto na tabela
        $sql = "INSERT INTO produto (Nome, Quantidade, UnidadeMedida, Marca, Validade, Classificacao, Fornecedor, imagem_path)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare a query e execute com os dados do formulário, incluindo o caminho da imagem
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sissssss", $nomeProduto, $quantidade, $unidadeMedida, $marca, $validade, $classificacao, $fornecedor, $diretorioDestino);

        if ($stmt->execute()) {
            $message = "Produto registrado com sucesso!";
            $messageColor = "green";
        } else {
            $message = "Erro ao registrar o produto.";
            $messageColor = "red";
        }

        $stmt->close();
    } else {
        $message = "Erro ao enviar o arquivo.";
        $messageColor = "red";
    }
}

// Processa a pesquisa de produtos
if (isset($_POST['search'])) {
    $searchQuery = $_POST['search'];
    $stmt = $conn->prepare("SELECT id_produto, Nome, Marca, imagem_path FROM produto WHERE Nome LIKE ? OR Marca LIKE ?");
    $searchParam = "%$searchQuery%";
    $stmt->bind_param("ss", $searchParam, $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();

    $productRows = ''; // Certifique-se de inicializar $productRows como uma string vazia

    while ($row = $result->fetch_assoc()) {
        $productRows .= "<tr>
            <td><img src='{$row['imagem_path']}' alt='Imagem' style='width: 100px; height: auto;'></td>
            <td>{$row['Nome']}</td>
            <td>{$row['Marca']}</td>
        </tr>";
    }

    $stmt->close();
}

$conn->close();

// Redireciona para a página de cadastro com a mensagem e os produtos encontrados
header("Location: cadastro.php?message=$message&messageColor=$messageColor");
exit();
?>
