<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <!-- Definição do conjunto de caracteres e configurações de exibição -->
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <!-- Título da página -->
    <title>Sistema de Aluno da UDF</title>
    <!-- Inclusão do estilo Bootstrap -->
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
            <!-- Botão de alternância para a barra de navegação responsiva -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Itens da barra de navegação -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Menu de Manutenção -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Manutenção
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="lstCidade.php">Cidade</a></li>
                            <!-- Opção de Endereço (link vazio - substitua com o link desejado) -->
                            <li><a class="dropdown-item" href="#">Endereço</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="lstAluno.php">Aluno</a></li>
                            <li><a class="dropdown-item" href="menu.php">Menu</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Botão de alternância duplicado - remova um deles -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Menu de Curso -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Curso
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="lstTurno.php">Turno</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Botão de alternância duplicado - remova um deles -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Container adicional sem propósito - remova se não for necessário -->
                <div class="container-fluid">
                    <!-- Menu de Turno -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Turno
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- Opção de Cidade (link vazio - substitua com o link desejado) -->
                                <li><a class="dropdown-item" href="lstCidade.php">Cidade</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Corpo da página -->
    <div class="container">
        <div class="row justify-content-center">
            <!-- Títulos -->
            <h2 class="text-center">Sistema de Aluno da UDF</h2>
            <h3 class="text-center">Modificação de dados do Aluno</h3>
        </div>
        <?php
        // Conexão com o banco de dados
        include "conexao.php";

        // Obter dados do aluno
        $num_cep = filter_input(INPUT_GET, 'num_cep', FILTER_SANITIZE_STRING);
        $result = $conn->query("SELECT des_nome, cod_genero, num_cep, des_email, cod_curso FROM aluno WHERE cod_matricula = " . $_GET["cod_matricula"]);

        if ($result === false) {
            die("Falha na execução: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>
        <!-- Formulário de modificação -->
        <form method="POST" action="updAluno.php">
            <div class="form-group row">
                <div class="col-md-2">
                    <label for="pcodigo">Matricula:</label>
                    <!-- Campo de leitura apenas para exibir a matrícula -->
                    <input type="number" class="form-control" 
                        value="<?=$_GET["cod_matricula"];?>"
                        id="pcodigo" name="pcodigo" readonly
                        placeholder="Matricula do Aluno"/>
                </div>
                <div class="col-md-6">
                    <label for="pnome">Nome:</label>
                    <!-- Campo para modificar o nome do aluno -->
                    <input type="text" class="form-control" 
                        value="<?=$row["des_nome"];?>"
                        id="pnome" name="pnome" 
                        placeholder="Nome do Aluno"/>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="pcep">CEP:</label>
                        <!-- Campo para modificar o CEP do aluno -->
                        <input type="text" class="form-control" 
                            value="<?=$row["num_cep"];?>"
                            id="pcep" name="pcep" 
                            placeholder="CEP" maxlength="8" />
                        <!-- Campo oculto para armazenar o CEP original -->
                        <input type="hidden" name="original_cep" value="<?=$row["num_cep"];?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="pmail">E-mail:</label>
                    <!-- Campo para modificar o e-mail do aluno -->
                    <input type="text" class="form-control" 
                        value="<?=$row["des_email"];?>"
                        id="pmail" name="pmail"
                        placeholder="E-mail do Aluno"/>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="pcodigocurs">Codigo do Curso:</label>
                        <!-- Dropdown para selecionar o código do curso -->
                        <select class="form-control" id="pcodigocurs" name="pcodigocurs" required>
                            <?php
                                // Consulta para obter códigos e nomes de cursos
                                $query = "SELECT cod_curso, nom_curso FROM curso";
                                $result = $conn->query($query);

                                if ($result->num_rows > 0) {
                                    // Loop para exibir as opções do dropdown
                                    while ($row = $result->fetch_assoc()) {
                                        $option_label = "{$row['cod_curso']}, {$row['nom_curso']}";
                                        echo "<option value='{$row['cod_curso']}'>$option_label</option>";
                                    }
                                } else {
                                    echo "Nenhuma cidade encontrada."; // Mensagem temporária para debug
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>     
            <br />
            <!-- Botão para enviar o formulário de modificação -->
            <button type="submit" class="btn btn-primary">Modificar</button>
        </form>
        <?php
        }
        ?>
    </div>
    <!-- Inclusão do script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
