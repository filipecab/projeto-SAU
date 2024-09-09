<?php
// Verifica se o método da requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclui o arquivo de conexão com o banco de dados
    include "conexao.php";

    // Obtém os dados do formulário
    $codCurso = $_POST["pcodigo"];
    $nomCurso = $_POST["pnome"];
    $cargaHoraria = $_POST["pcarga"];
    $cod_turno = $_POST["pcodigotur"];

    // Prepara a consulta SQL para inserir o curso no banco de dados
    $sql = "INSERT INTO curso (cod_curso, nom_curso, num_cargahoraria, cod_turno) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);

    // Associa os parâmetros e seus tipos à declaração SQL
    $stmt->bind_param("issi", $codCurso, $nomCurso, $cargaHoraria, $cod_turno);

    // Executa a consulta SQL
    if ($stmt->execute()) {
        echo "Curso adicionado com sucesso";
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
