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
    <!-- Container Bootstrap com margem superior (mt-5) -->
    <div class="container mt-5">
        <?php
            // Verifica se há uma mensagem de erro na URL
            if (isset($_GET["erro"])) {
                $erro = $_GET["erro"];
                // Exibe a mensagem de erro em um alerta Bootstrap
                echo "<div class='alert alert-danger' role='alert'>{$erro}</div>";
            }
        ?>
        <!-- Row Bootstrap com conteúdo centralizado -->
        <div class="row justify-content-center">
            <!-- Coluna Bootstrap com largura média (col-md-6) -->
            <div class="col-md-6">
                <!-- Título centralizado -->
                <h2 class="text-center">Sistema de Aluno da UDF</h2>
                <!-- Card Bootstrap -->
                <div class="card">
                    <!-- Cabeçalho do card -->
                    <div class="card-header">
                        Entrada do Sistema
                    </div>    
                    <!-- Corpo do card -->
                    <div class="card-body">
                        <!-- Formulário de login com método POST -->
                        <form action="login.php" method="POST">
                            <!-- Campo de entrada para o login -->
                            <div class="form-group">
                                <label for="login">Login:</label>
                                <input type="text" name="login" class="form-control" id="login">
                            </div>    
                            <!-- Campo de entrada para a senha -->
                            <div class="form-group">
                                <label for="senha">Senha:</label>
                                <input type="password" name="senha" class="form-control" id="senha">
                            </div>
                            <br/>
                            <!-- Botão de submissão do formulário -->
                            <button type="submit" class="btn btn-primary">Entrar</button>    
                        </form>    
                    </div>    
                </div>
            </div>    
        </div>
    </div>
</body>
</html>
