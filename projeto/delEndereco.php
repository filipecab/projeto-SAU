<?php
// Inclui o arquivo de conexão com o banco de dados
include "conexao.php";

// Obtém o código do endereço via parâmetro GET
$codEnd = $_GET["num_cep"];

// Prepara a instrução SQL para excluir o endereço
$sql = "DELETE FROM endereco WHERE num_cep = ?";

// Prepara a declaração SQL
$stmt = $conn->prepare($sql);

// Vincula o parâmetro à declaração SQL
$stmt->bind_param("i", $codEnd);

// Executa a declaração SQL
if ($stmt->execute()) {
    echo "Endereço eliminado com sucesso";
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
