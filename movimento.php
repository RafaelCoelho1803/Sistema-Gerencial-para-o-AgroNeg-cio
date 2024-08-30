<?php
	session_start();
	if(empty($_SESSION) ){
		print "<script>location.href='index.php';</script>";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazenda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .Button-column {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-around;
        }

        .Button-column .card {
            width: 18rem;
            margin: 15px 0;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .material-symbols-outlined {
            font-size: 70px;
            color: #28a745;
        }

        .card-title {
            font-size: 20px;
            color: #28a745;
            margin-top: 10px;
        }

        .navbar {
            margin-bottom: 20px;
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
                print "<a href='logout.php' class='btn btn-danger'>Sair </a> ";
                ?>
            </nav>
        </div>
    </div>


    <div class="container">
    <div class="row justify-content-between">
        <div class="col-md-3 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <span class="material-symbols-outlined">add_circle_outline</span>
                    <h5 class="card-title">ADICIONAR</h5>
                    <button onclick="redirectToAdicionar()" type="button" class="btn btn-outline-success">Adicionar Produto</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <span class="material-symbols-outlined">inventory</span>
                    <h5 class="card-title">RETIRADA </h5>
                    <button onclick="redirectToRetirada()" type="button" class="btn btn-outline-success">Ir para Retirada</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <span class="material-symbols-outlined">agriculture</span>
                    <h5 class="card-title">APLICAÇÃO DE INSUMOS</h5>
                    <button onclick="redirectToAplicacao()" type="button" class="btn btn-outline-success">Ir para Aplicação</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <span class="material-symbols-outlined">calendar_today</span>
                    <h5 class="card-title">PLANEJAMENTO</h5>
                    <button onclick="redirectToPlanejamento()" type="button" class="btn btn-outline-success">Ir para Planejamento</button>
                </div>
            </div>
        </div>

    


    </div>

</div>

   




    <script>
        function redirectToAdicionar() {
            window.location.href = 'adicionar.php';
        }
        function redirectToRetirada() {
            window.location.href = 'retirada.php';
        }
        function redirectToAplicacao() {
            window.location.href = 'frete.php';
        }
        function redirectToPlanejamento() {
            window.location.href = 'resultados.php';
        }
    </script> 

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>        
</body>
</html>
