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
    <!-- Código de navegação -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">SAU</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
      </nav>    
      <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-center">Sistema de Aluno da UDF</h2>
            <h3 class="text-center">Alteração de Endereço</h3>
        </div>
        <?php
        // Inclui o arquivo de conexão com o banco de dados
        include "conexao.php";

        // Obtém o número do CEP da URL e filtra para evitar possíveis problemas de segurança
        $num_cep = filter_input(INPUT_GET, 'num_cep', FILTER_SANITIZE_STRING);

        // Verifica se o número do CEP foi fornecido e não está vazio
        if (isset($num_cep) && !empty($num_cep)) {
            // Prepara e executa a consulta para obter informações do endereço com base no número do CEP
            $stmt = $conn->prepare("SELECT des_logradouro, des_rua, des_bairro, cod_cidade FROM endereco WHERE num_cep = ?");
            $stmt->bind_param("s", $num_cep);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verifica se houve erro na execução da consulta
            if ($result === false) {
                die("Falha na execução: " . $conn->error);
            }

            // Verifica se foram encontrados resultados na consulta
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
        <!-- Formulário para modificar as informações do endereço -->
        <form method="POST" action="updEndereco.php">
            <div class="form-group row">
                <div class="col-md-2">
                    <label for="pcodigo">Código:</label>
                    <!-- Campo de input para exibir e permitir a modificação do código do endereço -->
                    <input type="text" class="form-control" 
                        value="<?=$num_cep;?>"
                        id="pcodigo" name="pcodigo" 
                        placeholder="Código do Endereço" maxlength="8"/>
                </div>
                <div class="col-md-6">
                    <label for="plog">Logradouro:</label>
                    <!-- Campo de input para exibir e permitir a modificação do logradouro -->
                    <input type="text" class="form-control" 
                        value="<?=$row["des_logradouro"];?>"
                        id="plog" name="plog" 
                        placeholder="Logradouro"/>
                </div>
                <div class="col-md-6">
                    <label for="prua">Rua:</label>
                    <!-- Campo de input para exibir e permitir a modificação da rua -->
                    <input type="text" class="form-control" 
                        value="<?=$row["des_rua"];?>"
                        id="prua" name="prua" 
                        placeholder="Rua"/>
                </div> 

                <div class="col-md-6">
                    <label for="pbairro">Bairro:</label>
                    <!-- Campo de input para exibir e permitir a modificação do bairro -->
                    <input type="text" class="form-control" 
                        value="<?=$row["des_bairro"];?>"
                        id="pbairro" name="pbairro" 
                        placeholder="Bairro"/>   
                </div>    
                <div class="col-md-6">
                    <label for="pcodigocid">Código da Cidade:</label>
                    <!-- Campo de input apenas para exibir o código da cidade (readonly) -->
                    <input type="text" class="form-control" 
                        value="<?=$row["cod_cidade"];?>"
                        id="pcodigocid" name="pcodigocid" readonly
                        placeholder="Código da Cidade"/>
                </div>
            </div>
            <br />
            <!-- Botão para enviar o formulário e realizar a modificação no banco de dados -->
            <button type="submit" class="btn btn-primary">Modificar</button>
        </form>
        <?php
            }
        } 
        ?>
    </div>
    <!-- Inclui o script Bootstrap para funcionalidades JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
