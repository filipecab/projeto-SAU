<?php
// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclui o arquivo de conexão com o banco de dados
    include "conexao.php";

    // Obtém os valores do formulário
    $des_logradouro = $_POST["plog"];
    $des_rua = $_POST["prua"];
    $des_bairro = $_POST["pbairro"];
    $num_cep = filter_input(INPUT_POST, 'pcodigo', FILTER_SANITIZE_STRING);

    // Depura os dados recebidos do formulário (pode ser removido em produção)
    var_dump($_POST);

    // Prepara a instrução SQL para atualizar o endereço
    $sql = "UPDATE endereco SET des_logradouro = ?, des_rua = ?, des_bairro = ? WHERE num_cep = ?";
    $stmt = $conn->prepare($sql);

    // Liga os parâmetros da instrução SQL às variáveis
    $stmt->bind_param("ssss", $des_logradouro, $des_rua, $des_bairro, $num_cep);

    // Executa a instrução SQL
    if ($stmt->execute()) {
        echo "Endereço modificado com sucesso";
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
