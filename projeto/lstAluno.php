<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Sistema de Aluno da UDF</title>
    <!-- Link para o Bootstrap -->
    <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" 
    crossorigin="anonymous"/>
</head>
<body>
    <!-- Barra de navegação Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Marca na barra de navegação -->
            <a class="navbar-brand" href="#">SAU</a>
            <!-- Botão de alternância para dispositivos pequenos -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Itens da barra de navegação -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Dropdown Manutenção -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Manutenção
                        </a>
                        <!-- Itens do dropdown Manutenção -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="lstCidade.php">Cidade</a></li>
                            <li><a class="dropdown-item" href="lstEndereco.php">Endereço</a></li>
                            <li><hr class="dropdown-divider"></hr></li>
                            <li><a class="dropdown-item" href="lstAluno.php">Aluno</a></li>
                            <li><a class="dropdown-item" href="menu.php">Menu</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Botão de alternância novamente para dispositivos pequenos -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Dropdown Curso -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Curso
                        </a>
                        <!-- Itens do dropdown Curso -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="lstcursos.php">Curso</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Botão de alternância novamente para dispositivos pequenos -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Container fluido para itens da barra de navegação -->
                <div class="container-fluid">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- Dropdown Turno -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Turno
                            </a>
                            <!-- Itens do dropdown Turno -->
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="lstTurno.php">Turno</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Container Bootstrap -->
    <div class="container">
        <div class="row justify-content-center">
            <!-- Títulos -->
            <h2 class="text-center">Sistema de Aluno da UDF</h2>
            <h3 class="text-center">Manutenção Alunos</h3>
            <?php
            // Inclui o arquivo de conexão
            include "conexao.php";

            // Query para selecionar os dados dos alunos
            $select = "SELECT cod_matricula, des_nome, cod_genero, num_cep, des_email, cod_curso FROM aluno";
            
            // Executa a query
            $result = $conn->query($select);

            // Verifica se a query foi executada com sucesso
            if ($result === false) {
                die("Falha na execução: " . $conn->error);
            }

            // Verifica se há registros
            if ($result->num_rows > 0) {
?>
                <!-- Tabela para exibir os dados -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Matricula</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Genero</th>
                            <th scope="col">CEP</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Curso</th>
                        </tr>
                    </thead>
<?php
                // Loop através dos resultados
                while ($row = $result->fetch_assoc()) {
?>
                    <tbody>
                        <tr>
                            <td scope="row"><?= $row["cod_matricula"] ?></td>    
                            <td><?= $row["des_nome"] ?></td>
                            <td><?= $row["cod_genero"] ?></td>
                            <td><?= $row["num_cep"] ?></td>
                            <td><?= $row["des_email"] ?></td>
                            <td><?= $row["cod_curso"] ?></td>
                            <!-- Botões de Alterar e Excluir -->
                            <td>
                                <a href="altAluno.php?cod_matricula=<?= $row["cod_matricula"] ?>">
                                    <button type="button" class="btn btn-primary">Alterar</button>
                                </a>
                                <a href="delAluno.php?cod_matricula=<?= $row["cod_matricula"] ?>">
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
            // Fecha a conexão com o banco de dados
            $conn->close();
            ?>
        </div>
        <!-- Botão para adicionar aluno -->
        <p class="text-center">
            <a href="incAluno.php" class="btn btn-success">&nbsp; Adicionar Aluno &nbsp;</a>
        </p>
    </div>
    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
