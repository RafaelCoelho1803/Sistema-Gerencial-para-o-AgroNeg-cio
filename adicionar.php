<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (empty($_SESSION)) {
    header("Location: index.php");
    exit();
}

include("config.php");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        .form-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .form-card h2 {
            margin-bottom: 20px;
        }
        .form-control, .form-select {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .message {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }
        .message.success {
            color: green;
        }
        .message.error {
            color: red;
        }
        .table-container {
            max-height: 600px;
            overflow-y: auto;
            overflow-x: hidden;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: center;
        }
        img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>

<body>
<div class="Top-side">
    <div class="pos-f-t">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-dark p-4">
                <h5 class="text-white h4">Fazenda Alvorada</h5>
                <span class="text-muted"><a href="/site/dashboard.php">Home</a></span>
            </div>
        </div>
        <nav class="navbar navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div style="color: white;">
                <?php
                print "Olá, " . $_SESSION["nome"];
                ?>
            </div>
            <?php
            print "<a href='/site/' class='btn btn-danger'>Sair </a> ";
            ?>
        </nav>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="form-card">
                <h2>Adicionar Produto</h2>
                <form action="adicionar-back.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="produto">Produto</label>
                        <select id="produto" name="produto" class="form-control" required onchange="atualizarProduto()">
                            <option value="">Selecione um produto</option>
                            <?php
                            $sql = "SELECT id_produto, Nome, Marca FROM produto ORDER BY Nome";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['id_produto']}'>{$row['Nome']} - {$row['Marca']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" required>
                    </div>
                    <div class="form-group">
                        <label for="produto-imagem"></label>
                        <div id="produto-imagem">
                            
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </form>
                <?php if (!empty($_GET['message'])) { ?>
                    <div class="message <?php echo $_GET['messageColor']; ?>">
                        <?php echo $_GET['message']; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-card">
                <h2>Produtos Registrados</h2>
                <form method="post" class="form-inline mb-3">
                    <input type="text" name="search" class="form-control mr-2" placeholder="Pesquisar por nome ou marca">
                    <button type="submit" class="btn btn-outline-success">Pesquisar</button>
                </form>
                <div class="table-container">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Quantidade</th>
                                <th>Marca</th>
                                <th>Validade</th>
                                <th>Imagem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Conexão com o banco de dados
                            include 'config.php';

                            $search = $_POST['search'] ?? '';

                            $sql = "SELECT * FROM produto WHERE Nome LIKE ? OR Marca LIKE ? ORDER BY Nome";
                            $stmt = $conn->prepare($sql);
                            $searchTerm = '%' . $search . '%';
                            $stmt->bind_param("ss", $searchTerm, $searchTerm);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['Nome']}</td>
                                    <td>{$row['Quantidade']} {$row['UnidadeMedida']}</td>
                                    <td>{$row['Marca']}</td>
                                    <td>{$row['Validade']}</td>
                                    <td><img src='{$row['imagem_path']}' alt='{$row['Nome']}' style='width: 100px; height: auto;'></td>
                                </tr>";
                            }

                            $stmt->close();
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
function atualizarProduto() {
    var produtoId = document.getElementById('produto').value;
    
    if (produtoId) {
        fetch('get_produto_info.php?id=' + produtoId)
        .then(response => response.json())
        .then(data => {
            document.getElementById('produto-imagem-src').src = data.imagem_path;
            document.getElementById('produto-nome').textContent = "Nome: " + data.Nome;
            document.getElementById('produto-quantidade').textContent = "Quantidade: " + data.Quantidade + " " + data.UnidadeMedida;
        });
    }
}
</script>
</body>
</html>
