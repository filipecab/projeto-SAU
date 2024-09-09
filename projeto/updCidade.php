<?php
// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclui o arquivo de conexão com o banco de dados
    include "conexao.php";

    // Obtém os valores do formulário
    $codCidade = $_POST["pcodigo"];
    $nomCidade = $_POST["pnome"];
    $sigCidade = $_POST["psigla"];

    // Prepara a instrução SQL para atualizar a cidade
    $sql = "UPDATE cidade SET nom_cidade = ?, sig_uf = ? WHERE cod_cidade = ?";
    $stmt = $conn->prepare($sql);

    // Liga os parâmetros da instrução SQL às variáveis
    $stmt->bind_param("ssi", $nomCidade, $sigCidade, $codCidade);

    // Executa a instrução SQL
    if ($stmt->execute()) {
        echo "Cidade modificada com sucesso";
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
