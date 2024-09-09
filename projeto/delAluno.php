<?php
// Inclui o arquivo de conexão com o banco de dados
include "conexao.php";

// Obtém o código do aluno via parâmetro GET
$codAluno = $_GET["cod_matricula"];

// Prepara a instrução SQL para excluir o aluno
$sql = "DELETE FROM aluno WHERE cod_matricula = ?";

// Prepara a declaração SQL
$stmt = $conn->prepare($sql);

// Vincula o parâmetro à declaração SQL
$stmt->bind_param("i", $codAluno);

// Executa a declaração SQL
if ($stmt->execute()) {
    echo "Aluno eliminado com sucesso";
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
