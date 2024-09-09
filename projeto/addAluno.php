<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclui o arquivo de conexão com o banco de dados
    include "conexao.php";

    // Validar e filtrar os dados de entrada
    $cod_matricula = filter_var($_POST["pcodigo"], FILTER_SANITIZE_NUMBER_INT);
    $des_nome = filter_var($_POST["pnome"], FILTER_SANITIZE_STRING);
    $cod_genero = filter_var($_POST["pgen"], FILTER_SANITIZE_STRING);
    $num_cep = filter_var($_POST["pcep"], FILTER_SANITIZE_STRING);
    $des_email = filter_var($_POST["pmail"], FILTER_SANITIZE_STRING);
    $cod_curso = filter_var($_POST["pcodigocurs"], FILTER_SANITIZE_NUMBER_INT);

    // Prepara a consulta SQL para inserir aluno no banco de dados
    $sql = "INSERT INTO aluno (cod_matricula, des_nome, cod_genero, num_cep, des_email, cod_curso) VALUES (?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);

    // Associa os parâmetros e seus tipos à declaração SQL
    $stmt->bind_param("issssi", $cod_matricula, $des_nome, $cod_genero, $num_cep, $des_email, $cod_curso);

    // Executa a consulta SQL
    if ($stmt->execute()) {
        echo "Aluno adicionado com sucesso";
    } else {
        // Encerra o script em caso de falha na execução da consulta SQL
        die("Falha na execução: " . $stmt->error);
    }

    // Fecha a declaração preparada e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>

<!-- Script JavaScript para voltar duas páginas no histórico do navegador -->
<script>
    history.go(-2);
</script>
