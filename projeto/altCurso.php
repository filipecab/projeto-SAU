<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <!-- Meta tags para configuração do documento -->
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Sistema de Aluno da UDF</title>
    <!-- Link para o estilo do Bootstrap -->
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
            <!-- Marca da barra de navegação -->
            <a class="navbar-brand" href="#">SAU</a>
            <!-- Botão de alternância para dispositivos pequenos -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Itens de navegação -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Menu de manutenção -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Manutenção
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="lstCidade.php">Cidade</a></li>
                            <li><a class="dropdown-item" href="lstEndereco.php">Endereço</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Aluno</a></li>
                            <li><a class="dropdown-item" href="menu.php">Menu</a></li>
                        </ul>
                    </li>
                </ul>
            
                <!-- Botão de alternância para dispositivos pequenos -->
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
                            <li><a class="dropdown-item" href="lstcursos.php">Curso</a></li>
                        </ul>
                    </li>
                </ul>
                
                <!-- Botão de alternância para dispositivos pequenos -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="container-fluid">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- Menu de Turno -->
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

    <!-- Corpo da página -->
    <div class="container">
        <div class="row justify-content-center">
            <!-- Títulos -->
            <h2 class="text-center">Sistema de Aluno da UDF</h2>
            <h3 class="text-center">Alteração de Curso</h3>
        </div>
        <?php
        // Inclusão do arquivo de conexão com o banco de dados
        include "conexao.php";

        // Busca de informações no banco de dados para preencher o formulário de alteração
        $result = $conn->query(
            "SELECT nom_curso, num_cargahoraria, cod_turno FROM curso WHERE cod_curso = " . $_GET["cod_curso"]);

        if ($result === false) {
            die("Falha na execução: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>
        <!-- Formulário de alteração de Curso -->
        <form method="POST" action="updCurso.php">
            <div class="form-group row">
                <!-- Campo Código -->
                <div class="col-md-2">
                    <label for="pcodigo">Código:</label>
                    <input type="text" class="form-control" 
                        value="<?=$_GET["cod_curso"];?>"
                        id="pcodigo" name="pcodigo" readonly
                        placeholder="Código do Curso"/>
                </div>
                <!-- Campo Nome -->
                <div class="col-md-6">
                    <label for="pnome">Nome:</label>
                    <input type="text" class="form-control" 
                        value="<?=$row["nom_curso"];?>"
                        id="pnome" name="pnome" 
                        placeholder="Nome do Curso"/>
                </div>    
            </div>    
            <div class="form-group">
                <div class="col-md-6">
                    <!-- Campo Carga Horária -->
                    <label for="pcarga">Carga horaria:</label>
                    <input type="text" class="form-control" 
                        value="<?=$row["num_cargahoraria"];?>"
                        id="pcarga" name="pcarga" 
                        placeholder="Carga horaria"/>
                </div>  
                <div class="col-md-6">
                    <!-- Campo Código do Turno -->
                    <label for="pcodigotur">Turno:</label>
                    <input type="number" class="form-control" 
                        value="<?=$row["cod_curso"];?>"
                        id="pcodigotur" name="pcodigotur" 
                        placeholder="Turno"/>
                </div>  
            </div>
            <br />
            <!-- Botão de envio do formulário -->
            <button type="submit" class="btn btn-primary">Modificar</button>
        </form>
        <?php
        }
        ?>
    </div>
    <!-- Scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
