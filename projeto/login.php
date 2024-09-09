<?php
// Define o tipo de conteúdo da página como HTML com codificação UTF-8
header("Content-Type: text/html; charset=UTF-8");

// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores de login e senha do formulário
    $login = $_POST["login"];
    $senha = $_POST["senha"];

    // Inclui o arquivo de conexão com o banco de dados
    include "conexao.php";

    // Encripta a senha usando o algoritmo SHA-256
    $senhaencriptada = hash('sha256', $senha);

    // Monta a consulta SQL para verificar as credenciais do usuário
    $sql = "SELECT * FROM usuario WHERE des_login = '$login' " .
           "AND des_senha = '$senhaencriptada'";
    
    // Executa a consulta no banco de dados
    $result = $conn->query($sql);

    // Verifica se há exatamente um registro correspondente
    if ($result->num_rows == 1) {
        // Redireciona para a página de menu em caso de sucesso
        header("Location: menu.php");
        exit();
    } else {
        // Redireciona de volta para a página de login com uma mensagem de erro em caso de credenciais inválidas
        header("Location: index.php?erro=Login%20ou%20senha%20inválido.");
        exit();
    }
}
?>
