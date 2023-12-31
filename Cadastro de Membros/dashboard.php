<?php
    include("tratamento_inatividade.php");
?>

<!-- essa é a pagina inicial do nosso site, logo após o úsuario fazer login, ele é redirecionado para ela -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página inicial</title>
    <link rel="shortcut icon" href="imgs/escudo-favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body class="corpo">
    <div>
        <button id="sair-btn" class="btn" onclick="sair()" style="background-color: darkred; color: white"><i class="fa-solid fa-right-to-bracket"></i></button>
    </div>
    <main class="centralizar">
    <div class="container">
        <div class="mb-5" style="text-align: center; color: darkred">
            <h3>Sistema do Time Jaguara</h3>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3" style="border-color: darkred;">
                    <div class="card-body">
                        <h5 class="card-title"><a href="cadastro_membros.php" style="color: darkred">Cadastrar Membros</a></h5>
                        <p class="card-text">Insira os dados e selecione a função do membro do time.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3" style="border-color: darkred;">
                    <div class="card-body">
                        <h5 class="card-title"><a href="gerenciar_membros.php" style="color: darkred">Gerenciar Membros</a></h5>
                        <p class="card-text">Veja todos os membros cadastrados, e altere seus dados.</p>
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