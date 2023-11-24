<?php
    session_start();
    if (empty($_SESSION["usuario"])) {
        header("Location: index.php");
        exit();
    };
    
    $inatividade = 1800; // 30 minutos

    if (isset($_SESSION['ultima_atividade']) && (time() - $_SESSION['ultima_atividade']) > $inatividade) {
        session_unset();
        session_destroy();
        
        print "<script>alert('Sessão expirada, faça login novamente.')</script>";
        print "<script>location.href='index.php'</script>";
        exit();
    }

    $_SESSION['ultima_atividade'] = time();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Membros</title>
    <link rel="shortcut icon" href="imgs/escudo-favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body class="corpo">
    <main>
        <div>
            <button id="voltar-btn" class="btn btn-danger" onclick="voltarPagina()"><i class="fa-solid fa-arrow-left"></i></button>
            <button id="sair-btn" class="btn btn-danger" onclick="sair()"><i class="fa-solid fa-right-to-bracket"></i></button>
        </div>
        <div class="centralizar">
            <div class="conteiner">
                <div class="row">
                    <div class="col-lg-4 offset-lg-4">
                        <div class="card border-danger">
                            <div class="card-body">
                                <h2>Tela de cadastros</h2>
                            </div>
                            <div class="card-body">
                                <form action="cadastrarMembro.php" method="POST">
                                    <div>
                                        <div class="mb-3">
                                            <label for="Nome Completo">Nome Completo</label>
                                            <input id="nome" type="text" name="nome" class="form-control" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" title="Nome entre 10 e 100 letras." required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-3">
                                            <label for="cpf">CPF</label>
                                            <input id="cpf" type="text" name="documento" class="form-control mb-3" title="CPF do membro." maxlength="11" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-3">
                                            <label for="Birthday">Data de Nascimento</label>
                                            <input id="dtaNasc" type="date" name="date" class="form-control" title="Data de nascimento do membro." required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-3">
                                            <label for="funcao">Função</label>
                                            <br>
                                            <input id="jogadorRadio" onclick="mudarOpcoes('jogador','cadastro')" type="radio" name="funcao" value="Jogador" id="jogador">Jogador
                                            <input id="tecnicoRadio" onclick="mudarOpcoes('tecnico','cadastro')" type="radio" name="funcao" value="Tecnico" id="tecnico">Técnico
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-3">
                                            <label for="categoria">Categoria</label>
                                            <select id="categorias" class="custom-select" name="categoria" onchange="selecionarCamisa()">
                                            </select>
                                        </div>
                                    </div>
                                    <div id="selecaoNumeros">
                                    </div>
                                    <div>
                                        <div class="mb-3">
                                            <button id="botaoEnviar" type="submit" class="btn btn-danger">Enviar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="scripts/script.js"></script>
    <script src="https://kit.fontawesome.com/6f3da5c6b0.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>