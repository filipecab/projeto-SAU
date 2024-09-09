<?php
// Inclui o arquivo de conexão
include "conexao.php";

// Define a consulta SQL para selecionar os cursos
$select = "SELECT cod_curso, nom_curso, num_cargahoraria, cod_turno FROM curso";

// Executa a consulta
$result = $conn->query($select);

// Verifica se houve erro na execução da consulta
if ($result === false) {
    die("Falha na execução: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Sistema de Aluno da UDF</title>
    <!-- Inclui o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"/>
</head>
<body>
    <!-- Barra de navegação -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SAU</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Itens da barra de navegação -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Dropdown para Manutenção -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Manutenção
                        </a>
                        <!-- Opções do dropdown -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="lstCidade.php">Cidade</a></li>
                            <li><a class="dropdown-item" href="lstEndereco.php">Endereço</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="lstAluno.php">Aluno</a></li>
                            <li><a class="dropdown-item" href="menu.php">Menu</a></li>
                        </ul>
                    </li>
                </ul>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Dropdown para Curso -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Curso
                        </a>
                        <!-- Opções do dropdown -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="lstcursos.php">Curso</a></li>
                        </ul>
                    </li>
                </ul>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="container-fluid">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- Dropdown para Turno -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Turno
                            </a>
                            <!-- Opções do dropdown -->
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="lstTurno.php">Turno</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-center">Sistema de Aluno da UDF</h2>
            <h3 class="text-center">Cursos</h3>
            <?php
            // Verifica se há cursos cadastrados
            if ($result->num_rows > 0) {
                ?>
                <!-- Tabela para exibir os cursos -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Curso</th>
                            <th scope="col">Carga Horaria</th>
                            <th scope="col">Turno</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <?php
                    // Loop para exibir os cursos na tabela
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tbody>
                            <tr>
                                <td scope="row"><?= $row["cod_curso"] ?></td>
                                <td><?= $row["nom_curso"] ?></td>
                                <td><?= $row["num_cargahoraria"] ?></td>
                                <td><?= $row["cod_turno"] ?></td>
                                <td>
                                    <!-- Links para alterar e excluir o curso -->
                                    <a href="altCurso.php?cod_curso=<?= $row["cod_curso"] ?>">
                                        <button type="button" class="btn btn-primary">Alterar</button>
                                    </a>
                                    <a href="delCurso.php?cod_curso=<?= $row["cod_curso"] ?>">
                                        <button type="button" class="btn btn-danger">Excluir</button>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <?php
                    }
                    echo "</table>";
                } else {
                    echo "Nenhum registro encontrado<br/><br/>";
                }
                // Fecha a conexão
                $conn->close();
                ?>
            </div>
            <!-- Botão para adicionar curso -->
            <p class="text-center">
                <a href="incCurso.php" class="btn btn-success">&nbsp; Adicionar Curso &nbsp;</a>
            </p>
        </div>
        <!-- Inclui o JavaScript do Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
    </html>
