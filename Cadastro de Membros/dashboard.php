<?php
    session_start();
    if (empty($_SESSION["usuario"])) {
        header("Location: index.php");
        exit();
    };
    
    $inatividade = 1800; // 30 minutos (em segundos)

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
    <title>Página inicial</title>
    <link rel="shortcut icon" href="imgs/escudo-favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body class="corpo">
    <header>
        <ul class="nav nav-fill bg-light">
            <li class="nav-item">
                <a class="nav-link" href="cadastroMembros.php">Cadastrar Membros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">HYpe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">HYpe</a>
            </li>
        </ul>
    </header>
    <main>

    </main>
    <script src="https://kit.fontawesome.com/6f3da5c6b0.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>