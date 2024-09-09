<?php
// Inclui o arquivo de conexão
include "conexao.php";
?>

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
            <h3 class="text-center">Inclusão de Endereço</h3>
        </div>
        <!-- Formulário de inclusão de endereço -->
        <form method="post" action="addEndereco.php">
            <!-- Linha do formulário com duas colunas -->
            <div class="form-group row">
                <div class="col-md-2">
                    <label for="pcodigo">Código:</label>
                    
                    <input type="text" class="form-control" id="pcodigo" name="pcodigo" placeholder="Código do Endereco" maxlength="8"/>
                </div>


                <div class="col-md-6">
                    <label for="plog">Logradouro:</label>
                    <input type="text" class="form-control" id="plog" name="plog" placeholder="Logradouro"/>
                </div>    
            </div>    
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="prua">Rua:</label>
                    <input type="text" class="form-control" id="prua" name="prua" placeholder="Rua"/>    
                </div>
                <div class="col-md-6">
                    <label for="pbairro">Bairro:</label>
                    <input type="text" class="form-control" id="pbairro" name="pbairro" placeholder="Bairro"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <label for="pcodigocid">Cidade:</label>
                    <!-- Dropdown de seleção da cidade -->
                    <select class="form-control" id="pcodigocid" name="pcodigocid" required>
                    <?php
                        // Recupera cidades do banco de dados
                        $query = "SELECT cod_cidade, nom_cidade, sig_uf FROM cidade";
                        $result = $conn->query($query);

                        // Verifica se há cidades e exibe no dropdown
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $option_label = "{$row['cod_cidade']}, {$row['nom_cidade']}, {$row['sig_uf']}";
                                echo "<option value='{$row['cod_cidade']}'>$option_label</option>";
                            }
                        } else {
                            echo "Nenhuma cidade encontrada."; 
                        }
                    ?>
                    </select>
                </div>
            </div>    
            <br />
            <!-- Botão de submissão do formulário -->
            <button type="submit" class="btn btn-primary">Incluir</button>
        </form>
    </div>
    <!-- Script Bootstrap para funcionalidades JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
