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
                    <!-- Menu de Manutenção -->
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
            <h3 class="text-center">Modificação de Cidade</h3>
        </div>
        <?php
        // Inclusão do arquivo de conexão com o banco de dados
        include "conexao.php";

        // Busca de informações no banco de dados para preencher o formulário de modificação
        $result = $conn->query(
            "SELECT nom_cidade, sig_uf FROM cidade WHERE cod_cidade = " . $_GET["cod_cidade"]);

        // Verifica se a execução da consulta foi bem-sucedida
        if ($result === false) {
            die("Falha na execução: " . $conn->error);
        }

        // Verifica se há resultados na consulta
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>
        <!-- Formulário de modificação de Cidade -->
        <form method="POST" action="updCidade.php">
            <div class="form-group row">
                <!-- Campo para exibir e manter o código da cidade -->
                <div class="col-md-2">
                    <label for="pcodigo">Código:</label>
                    <input type="text" class="form-control" 
                        value="<?=$_GET["cod_cidade"];?>"
                        id="pcodigo" name="pcodigo" readonly
                        placeholder="Código da Cidade"/>
                </div>
                <!-- Campo para modificar ou manter o nome da cidade -->
                <div class="col-md-6">
                    <label for="pnome">Nome:</label>
                    <input type="text" class="form-control" 
                        value="<?=$row["nom_cidade"];?>"
                        id="pnome" name="pnome" 
                        placeholder="Nome da Cidade"/>
                </div>    
            </div>    
            <div class="form-group">
                <!-- Campo para modificar ou manter a sigla do estado -->
                <div class="col-md-6">
                    <label for="psigla">Sigla:</label>
                    <select class="form-control" id="psigla" name="psigla">
                        <option value="AC" <?php if ($row["sig_uf"] == "AC") echo "selected";?>>Acre</option>
                        <option value="AL" <?php if ($row["sig_uf"] == "AL") echo "selected";?>>Alagoas</option>
                        <option value="AP" <?php if ($row["sig_uf"] == "AP") echo "selected";?>>Amapá</option>
                        <option value="AM" <?php if ($row["sig_uf"] == "AM") echo "selected";?>>Amazonas</option>
                        <option value="BA" <?php if ($row["sig_uf"] == "BA") echo "selected";?>>Bahia</option>
                        <option value="CE" <?php if ($row["sig_uf"] == "CE") echo "selected";?>>Ceará</option>
                        <option value="DF" <?php if ($row["sig_uf"] == "DF") echo "selected";?>>Distrito Federal</option>
                        <option value="ES" <?php if ($row["sig_uf"] == "ES") echo "selected";?>>Espírito Santo</option>
                        <option value="GO" <?php if ($row["sig_uf"] == "GO") echo "selected";?>>Goiás</option>
                        <option value="MA" <?php if ($row["sig_uf"] == "MA") echo "selected";?>>Maranhão</option>
                        <option value="MT" <?php if ($row["sig_uf"] == "MT") echo "selected";?>>Mato Grosso</option>
                        <option value="MS" <?php if ($row["sig_uf"] == "MS") echo "selected";?>>Mato Grosso do Sul</option>
                        <option value="MG" <?php if ($row["sig_uf"] == "MG") echo "selected";?>>Minas Gerais</option>
                        <option value="PA" <?php if ($row["sig_uf"] == "PA") echo "selected";?>>Pará</option>
                        <option value="PB" <?php if ($row["sig_uf"] == "PB") echo "selected";?>>Paraíba</option>
                        <option value="PR" <?php if ($row["sig_uf"] == "PR") echo "selected";?>>Paraná</option>
                        <option value="PE" <?php if ($row["sig_uf"] == "PE") echo "selected";?>>Pernambuco</option>
                        <option value="PI" <?php if ($row["sig_uf"] == "PI") echo "selected";?>>Piauí</option>
                        <option value="RJ" <?php if ($row["sig_uf"] == "RJ") echo "selected";?>>Rio de Janeiro</option>
                        <option value="RN" <?php if ($row["sig_uf"] == "RN") echo "selected";?>>Rio Grande do Norte</option>
                        <option value="RS" <?php if ($row["sig_uf"] == "RS") echo "selected";?>>Rio Grande do Sul</option>
                        <option value="RO" <?php if ($row["sig_uf"] == "RO") echo "selected";?>>Rondônia</option>
                        <option value="RR" <?php if ($row["sig_uf"] == "RR") echo "selected";?>>Roraima</option>
                        <option value="SC" <?php if ($row["sig_uf"] == "SC") echo "selected";?>>Santa Catarina</option>
                        <option value="SP" <?php if ($row["sig_uf"] == "SP") echo "selected";?>>São Paulo</option>
                        <option value="SE" <?php if ($row["sig_uf"] == "SE") echo "selected";?>>Sergipe</option>
                        <option value="TO" <?php if ($row["sig_uf"] == "TO") echo "selected";?>>Tocantins</option>

                    </select>
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
