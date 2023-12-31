<!-- pagina inicial, onde o usuario faz login para ter acesso as outras paginas da aplicação -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Jaguara</title>
    <link rel="shortcut icon" href="imgs/escudo-favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body class="corpo">
    <div class="centralizar">
        <div class="conteiner">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="card" style="border-color: darkred">
                        <div class="card-body" style="color: darkred">
                            <h2>Faça login para continuar!</h2>
                        </div>
                        <div class="card-body">
                            <form action="login.php" method="POST">
                                <div>
                                    <div class="mb-3">
                                        <label for="usuario">Usuário</label>
                                        <input id="usuario" type="email" name="usuario" class="form-control" title="Insira seu E-mail." required>
                                    </div>
                                </div>
                                <div class="conteiner">
                                    <div class="mb-3 row">
                                        <div class="col-sm-8">
                                            <label for="senha">Senha</label>
                                            <input id="senha" type="password" name="senha" class="form-control mb-3" title="Insira sua senha." required>
                                        </div>
                                        <div class="col-sm-4">
                                            <br>
                                            <button id="verSenhaButton" type="button" class="btn mt-md-2" onclick="mostrarSenha()"><i class="fa-solid fa-eye"></i></button>                                           
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-3">
                                        <button id="botaoEnviar" type="submit" class="btn" style="background-color: darkred; color: white">Enviar</button>
                                        <a href="cadastro_usuario.php" class="btn" style="background-color: darkred; color: white">Cadastrar-se</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/6f3da5c6b0.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="scripts/script.js"></script>
</body>
</html>