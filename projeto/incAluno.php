<?php
// Inclui o arquivo de conexão com o banco de dados
include "conexao.php";
?>

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
    <!-- Barra de navegação -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SAU</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Itens de navegação -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Dropdown Manutenção -->
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
                
                <!-- Dropdown Curso -->
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
                
                <!-- Dropdown Turno -->
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
    </nav>    

    <!-- Conteúdo da página -->
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-center">Sistema de Aluno da UDF</h2>
            <h3 class="text-center">Inclusão de Aluno</h3>
        </div>
        <!-- Formulário de inclusão de Aluno -->
        <form method="post" action="addAluno.php">
            <div class="form-group row">
                <!-- Campo Matrícula -->
                <div class="col-md-2">
                    <label for="pcodigo">Matricula:</label>
                    <input type="number" class="form-control" id="pcodigo" name="pcodigo" placeholder="Matricula do Aluno"/>
                </div>
                <!-- Campo Nome do Aluno -->
                <div class="col-md-6">
                    <label for="pnome">Nome do Aluno:</label>
                    <input type="text" class="form-control" id="pnome" name="pnome" placeholder="Nome do Aluno"/>
                </div>
                <!-- Campo Gênero -->
                <div class="col-md-6">
                    <label for="pgen">Gênero (F/M):</label>
                    <input type="text" class="form-control" id="pgen" name="pgen" placeholder="F ou M" maxlength="1" pattern="[FfMm]" title="Digite apenas 'F' ou 'M'" required />
                </div>
            </div>    
            <div class="form-group row">
                <!-- Campo CEP -->
                <div class="col-md-6">
                    <label for="pcep">CEP:</label>
                    <input type="text" class="form-control" id="pcep" name="pcep" placeholder="CEP do Aluno" maxlength="8" required />
                    <small id="cepHelp" class="form-text text-muted">Por favor, adicione-o à nossa lista de cidades.</small>
                </div>
                <!-- Campo E-mail -->
                <div class="col-md-6">
                    <label for="pmail">E-mail:</label>
                    <input type="text" class="form-control" id="pmail" name="pmail" placeholder="E-mail"/>
                </div>
            </div>
            <div class="form-group">
                <!-- Dropdown Curso -->
                <div class="col-md-6">
                    <label for="pcodigocurs">Curso:</label>
                    <select class="form-control" id="pcodigocurs" name="pcodigocurs" required>
                        <?php
                            // Consulta ao banco de dados para obter os cursos
                            $query = "SELECT cod_curso, nom_curso FROM curso";
                            $result = $conn->query($query);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // Exibe as opções do dropdown com os cursos
                                    $option_label = "{$row['cod_curso']}, {$row['nom_curso']}";
                                    echo "<option value='{$row['cod_curso']}'>$option_label</option>";
                                }
                            } else {
                                echo "Nenhum curso encontrado."; // Mensagem temporária para debug
                            }
                        ?>
                    </select>
                </div>
            </div>    
            <br />
            <!-- Botão de envio do formulário -->
            <button type="submit" class="btn btn-primary">Incluir</button>
        </form>
    </div>
    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
