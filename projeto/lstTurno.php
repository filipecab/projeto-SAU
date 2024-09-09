<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Sistema de Aluno da UDF</title>
    <!-- Inclusão do Bootstrap -->
    <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" 
    crossorigin="anonymous"/>
</head>
<body>
    <!-- Barra de navegação -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Logo e botão de alternância para telas menores -->
            <a class="navbar-brand" href="#">SAU</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Itens da barra de navegação -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Menu Manutenção -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Manutenção
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="lstCidade.php">Cidade</a></li>
                            <li><a class="dropdown-item" href="lstEndereco.php">Endereço</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="lstAluno.php">Aluno</a></li>
                            <li><a class="dropdown-item" href="menu.php">Menu</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Menu Curso -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Curso
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="lstcursos.php">Curso</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Menu Turno -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="container-fluid">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Turno
                            </a>
                            <!-- Submenu de Turno -->
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="lstTurno.php">Turno</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>    
    <!-- Conteúdo da página -->
    <div class="container">
        <!-- Título da página -->
        <div class="row justify-content-center">
            <h2 class="text-center">Sistema de Aluno da UDF</h2>
            <h3 class="text-center">Turno</h3>
            <?php
            // Inclui o arquivo de conexão com o banco de dados
            include "conexao.php";

            // Consulta SQL para obter dados dos turnos
            $select = "SELECT cod_turno, turno FROM turno";

            // Executa a consulta
            $result = $conn->query($select);

            // Verifica se a consulta foi bem-sucedida
            if ($result === false) {
                die("Falha na execução: " . $conn->error);
            }

            // Verifica se há registros
            if ($result->num_rows > 0) {
?>
                <!-- Tabela para exibir dados dos turnos -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Codigo do Turno</th>
                            <th scope="col">Turno</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
<?php
                // Loop para exibir dados dos turnos na tabela
                while ($row = $result->fetch_assoc()) {
?>
                    <tbody>
                        <tr>
                            <td scope="row"><?= $row["cod_turno"] ?></td>    
                            <td><?= $row["turno"] ?></td>
                            <!-- Botão para excluir turno -->
                            <td>
                                <a href="delTurno.php?cod_turno=<?= $row["cod_turno"] ?>">
                                    <button type="button" class="btn btn-danger">Excluir</button>
                                </a>
                            </td> 
                        </tr>
                    </tbody>                        
<?php
                }
                echo "</table>";
            } else {
                // Mensagem se não houver registros
                echo "Nenhum registro encontrado<br/><br/>";
            }
            $conn->close();
?>
        </div>
        <!-- Botão para adicionar turno -->
        <p class="text-center">
            <a href="incTurno.html" class="btn btn-success">&nbsp; Adicionar Turno &nbsp;</a>
        </p>
    </div>
    <!-- Inclusão do Bootstrap para funcionalidades JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
