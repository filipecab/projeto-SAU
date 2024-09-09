<?php
// Verifica se o método da requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclui o arquivo de conexão com o banco de dados
    include "conexao.php";

    // Obtém os dados do formulário
    $cod_turno = $_POST["pcodigo"];
    $turno = $_POST["pturno"];

    // Converte o valor do turno para o código correspondente
    switch ($turno) {
        case 'M':
            $codigo_turno = 1;
            break;
        case 'V':
            $codigo_turno = 2;
            break;
        case 'N':
            $codigo_turno = 3;
            break;
        default:
            // Encerra o script se o valor do turno for inválido
            die("Erro: Valor inválido para o turno.");
    }

    // Prepara a consulta SQL para inserir o turno no banco de dados
    $sql = "INSERT INTO turno (cod_turno, turno) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    // Associa os parâmetros e seus tipos à declaração SQL
    $stmt->bind_param("is", $codigo_turno, $turno);

    // Executa a consulta SQL
    if ($stmt->execute()) {
        echo "Turno adicionado com sucesso";
    } else {
        // Encerra o script em caso de falha na execução da consulta SQL
        die("Falha na execução: " . $stmt->error);
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
