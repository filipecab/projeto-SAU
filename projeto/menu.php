<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Sistema de Aluno da UDF</title>
    <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" 
    crossorigin="anonymous"/>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Cabeçalho da barra de navegação -->
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SAU</a>
            <!-- Botão de alternância para telas menores -->
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
        </div>    
        <?php
        // Inclui o arquivo de conexão com o banco de dados
        include "conexao.php";

        // Consulta SQL para obter dados de alunos, cursos e turnos
        $query = "SELECT a.cod_matricula, a.des_nome, c.nom_curso, c.num_cargahoraria, t.turno
                  FROM aluno a
                  INNER JOIN curso c ON a.cod_curso = c.cod_curso
                  INNER JOIN turno t ON c.cod_turno = t.cod_turno";  // Adiciona a tabela turno à consulta
        $result = $conn->query($query);

        // Verifica se a consulta foi bem-sucedida
        if ($result === false) {
            die("Falha na execução da consulta: " . $conn->error);
        }
        ?>

        <!-- Tabela para exibir dados dos alunos -->
        <table class="table">
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Nome</th>
                    <th>Curso</th>
                    <th>Carga Horária</th>
                    <th>Turno</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop para exibir dados dos alunos na tabela
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['cod_matricula']}</td>";
                    echo "<td>{$row['des_nome']}</td>";
                    echo "<td>{$row['nom_curso']}</td>";
                    echo "<td>{$row['num_cargahoraria']}</td>";
                    echo "<td>{$row['turno']}</td>"; 
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Inclusão do Bootstrap para funcionalidades JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
