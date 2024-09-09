<?php
// Verifica se o método da requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclui o arquivo de conexão com o banco de dados
    include "conexao.php";

    // Obtém os dados do formulário
    $codEnd = $_POST["pcodigo"];
    $des_logradouro = $_POST["plog"];
    $des_rua = $_POST["prua"];
    $des_bairro = $_POST["pbairro"];
    $cod_cidade = $_POST["pcodigocid"];

    // Prepara a consulta SQL para inserir o endereço no banco de dados
    $sql = "INSERT INTO endereco (num_cep, des_logradouro, des_rua, des_bairro, cod_cidade ) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);

    // Associa os parâmetros e seus tipos à declaração SQL
    $stmt->bind_param("issss", $codEnd, $des_logradouro, $des_rua, $des_bairro, $cod_cidade);

    // Executa a consulta SQL
    if ($stmt->execute()) {
        echo "Endereço adicionado com sucesso";
    } else {
        // Encerra o script em caso de falha na execução da consulta SQL
        die("Falha na execução: " . $stmt->error);
    }

    // Fecha a declaração preparada e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}

// Script JavaScript para voltar duas páginas no histórico do navegador
?>
<script>
    history.go(-2);
</script>
