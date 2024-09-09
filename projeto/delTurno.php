<?php
// Inclui o arquivo de conexão com o banco de dados
include "conexao.php";

// Obtém o código do turno via parâmetro GET
$codturno = $_GET["cod_turno"];

// Prepara a instrução SQL para excluir o turno
$sql = "DELETE FROM turno WHERE cod_turno = ?";

// Prepara a declaração SQL
$stmt = $conn->prepare($sql);

// Vincula o parâmetro à declaração SQL
$stmt->bind_param("i", $codturno);

// Executa a declaração SQL
if ($stmt->execute()) {
    echo "Turno eliminado com sucesso";
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
