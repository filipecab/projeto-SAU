<?php
// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclui o arquivo de conexão com o banco de dados
    include "conexao.php";

    // Obtém os valores do formulário
    $cod_matricula = $_POST["pcodigo"];
    $des_nome = $_POST["pnome"];
    $num_cep = $_POST["pcep"];
    $des_email = $_POST["pmail"];
    $cod_curso = $_POST["pcodigocurs"];
    $original_cep = $_POST["original_cep"];

    // Verifica se o CEP foi alterado
    if ($num_cep !== $original_cep) {
        // Prepara uma instrução SQL para verificar se o novo CEP existe
        $check_existing_cep = $conn->prepare("SELECT COUNT(*) FROM endereco WHERE num_cep = ?");
        $check_existing_cep->bind_param("s", $num_cep);
        $check_existing_cep->execute();
        $check_existing_cep->bind_result($row_count);
        $check_existing_cep->fetch();
        $check_existing_cep->close();

        // Se o novo CEP existe, atualiza o aluno
        if ($row_count > 0) {
            $sql = "UPDATE aluno SET des_nome = ?, num_cep = ?, des_email = ?, cod_curso = ? WHERE cod_matricula = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssii", $des_nome, $num_cep, $des_email, $cod_curso, $cod_matricula);
        } else {
            // Se o novo CEP não existe, exibe uma mensagem de erro
            echo "Erro: O CEP fornecido não existe na tabela de endereços. Cadastre o novo endereço primeiro.";
            exit;
        }
    } else {
        // Se o CEP não foi alterado, atualiza o aluno sem verificar o CEP
        $sql = "UPDATE aluno SET des_nome = ?, des_email = ?, cod_curso = ? WHERE cod_matricula = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $des_nome, $des_email, $cod_curso, $cod_matricula);
    }

    // Executa a instrução SQL
    if ($stmt->execute()) {
        echo "Aluno modificado com sucesso";
    } else {
        // Exibe mensagem de falha em caso de erro
        echo "Falha na execução: " . $stmt->errno . " - " . $stmt->error;
    }

    // Fecha o statement e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>
<!-- Redireciona para duas páginas atrás no histórico do navegador -->
<script>history.go(-2)</script>
