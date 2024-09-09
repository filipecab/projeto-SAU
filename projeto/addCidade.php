<?php
// Verifica se o método da requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclui o arquivo de conexão com o banco de dados
    include "conexao.php";

    // Obtém os dados do formulário
    $codCidade = $_POST["pcodigo"];
    $nomCidade = $_POST["pnome"];
    $sigCidade = $_POST["psigla"];

    // Prepara a consulta SQL para inserir a cidade no banco de dados
    $sql = "INSERT INTO cidade (cod_cidade, nom_cidade, sig_uf) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);

    // Associa os parâmetros e seus tipos à declaração SQL
    $stmt->bind_param("iss", $codCidade, $nomCidade, $sigCidade);

    // Executa a consulta SQL
    if ($stmt->execute()) {
        echo "Cidade adicionada com sucesso";
    } else {
        // Encerra o script em caso de falha na execução da consulta SQL
        die("Falha na execução: " . $conn->error);
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
