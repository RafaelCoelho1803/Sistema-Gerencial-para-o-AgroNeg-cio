<?php
session_start();
if (empty($_SESSION)) {
    header("Location: index.php");
    exit();
}

include('config.php'); // Conexão com o banco de dados




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retirada de Produtos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
</head>
<body style="background-color: #E2E2E2;">
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
                print "<a href='logout.php' class='btn btn-danger'>Sair </a> ";
                ?>
            </nav>
        </div>
    </div>
