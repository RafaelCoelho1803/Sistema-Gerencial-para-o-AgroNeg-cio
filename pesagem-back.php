<?php
session_start();

if (empty($_SESSION)) {
    print "<script>location.href='index.php';</script>";
    exit;
}

include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obter os dados do formulário
    $user_id = $_SESSION["id_user"];
    $peso_bruto = $_POST["peso_bruto"];
    $desconto = $_POST["desconto"];
    $ano = $_POST["ano"];
    $talhao = $_POST["talhao"];
    $frete_data = explode(',', $_POST["frete"]);
    $placa_frete = $frete_data[0];
    $cor_frete = $frete_data[1];
    $produto = $_POST["produto"];

    // Calcular o peso líquido
    $consulta_peso_caminhao = "SELECT peso FROM frete WHERE placa = '$placa_frete' AND cor = '$cor_frete'";
    $resultado_peso_caminhao = mysqli_query($conn, $consulta_peso_caminhao);
    $peso_caminhao = mysqli_fetch_assoc($resultado_peso_caminhao)['peso'];
    $desconto_porcentagem = 1 - ($desconto / 100);
    $peso_liquido = ($peso_bruto - $peso_caminhao) * $desconto_porcentagem  ;


    // Preparar e executar a consulta de inserção
    $query_insert = "INSERT INTO pesagem (talhao_id, frete_id, ano, peso_bruto, peso_liquido, desconto, user_id, produto, hora) 
                SELECT '$talhao', id_frete, '$ano', '$peso_bruto','$peso_liquido', '$desconto', '$user_id', '$produto', NOW() 
                FROM frete 
                WHERE placa = '$placa_frete' AND cor = '$cor_frete' 
                LIMIT 1";


    if (mysqli_query($conn, $query_insert)) {
        $_SESSION['mensagem'] = "Dados inseridos com sucesso.";
    } else {
        $_SESSION['mensagem'] = "Erro ao inserir dados: " . mysqli_error($conn);
    }

    // Redirecionar de volta para a página de registro de pesagem
    header("Location: pesagem.php");
    exit;
}
?>
