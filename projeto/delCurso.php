<?php
// Inclui o arquivo de conexão com o banco de dados
include "conexao.php";

// Obtém o código do curso via parâmetro GET
$codCurso = $_GET["cod_curso"];

// Prepara a instrução SQL para excluir o curso
$sql = "DELETE FROM curso WHERE cod_curso = ?";

// Prepara a declaração SQL
$stmt = $conn->prepare($sql);

// Vincula o parâmetro à declaração SQL
$stmt->bind_param("i", $codCurso);

// Executa a declaração SQL
if ($stmt->execute()) {
    echo "Curso eliminado com sucesso";
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
