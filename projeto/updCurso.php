<?php
// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclui o arquivo de conexão com o banco de dados
    include "conexao.php";

    // Obtém os valores do formulário
    $codCurso = $_POST["pcodigo"];
    $nomCurso = $_POST["pnome"];
    $cargaHoraria = $_POST["pcarga"];
    $cod_turno = $_POST["pcodigotur"];

    // Prepara a instrução SQL para atualizar o curso
    $sql = "UPDATE curso SET nom_curso = ?, num_cargahoraria = ?, cod_turno = ? WHERE cod_curso = ?";
    $stmt = $conn->prepare($sql);

    // Liga os parâmetros da instrução SQL às variáveis
    $stmt->bind_param("ssii", $nomCurso, $nomCurso, $cod_turno, $codCurso);

    // Executa a instrução SQL
    if ($stmt->execute()) {
        echo "Curso modificado com sucesso";
    } else {
        // Exibe mensagem de falha em caso de erro
        echo "Falha na execução: " . $conn->error;
    }

    // Fecha o statement e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>
<!-- Redireciona para duas páginas atrás no histórico do navegador -->
<script>history.go(-2)</script>
