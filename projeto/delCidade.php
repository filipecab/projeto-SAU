<?php
// Inclui o arquivo de conexão com o banco de dados
include "conexao.php";

// Obtém o código da cidade via parâmetro GET
$codCidade = $_GET["cod_cidade"];

// Prepara a instrução SQL para excluir a cidade
$sql = "DELETE FROM cidade WHERE cod_cidade = ?";

// Prepara a declaração SQL
$stmt = $conn->prepare($sql);

// Vincula o parâmetro à declaração SQL
$stmt->bind_param("i", $codCidade);

// Executa a declaração SQL
if ($stmt->execute()) {
    echo "Cidade eliminada com sucesso";
} else {
    echo "Falha na execução: " . $conn->error;
}

// Fecha a declaração SQL
$stmt->close();

// Fecha a conexão com o banco de dados
$conn->close();
?>

<!-- Script JavaScript para voltar à página anterior -->
<script>history.go(-1)</script>
