<?php
// Configurações para conexão com o banco de dados
$servername = "localhost"; // Nome do servidor do banco de dados
$username = "root"; // Nome de usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "ok_curso"; // Nome do banco de dados

// Cria uma nova conexão com o banco de dados usando as configurações fornecidas
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve falha na conexão
if ($conn->connect_error) {
    // Se houver falha, redireciona para a página de índice (index.php) com uma mensagem de erro
    header("Location: index.php?erro=Falha%20de%20conexão.");
    // Encerra o script
    exit();
}
?>
