<?php
    // aqui estamos verificando se o usuario é autenticado
    session_start();
    if (empty($_SESSION["usuario"])) {
        header("Location: index.php");
        exit();
    };
    
    $inatividade = 1800; // 30 minutos

    // aqui é feito a verificação da última atividade do úsuario, caso ele esteja ocioso por muito tempo a sessão é destruida e vai para o login
    if (isset($_SESSION['ultima_atividade']) && (time() - $_SESSION['ultima_atividade']) > $inatividade) {
        session_unset();
        session_destroy();
        
        print "<script>alert('Sessão expirada, faça login novamente.')</script>";
        print "<script>location.href='index.php'</script>";
        exit();
    }

    $_SESSION['ultima_atividade'] = time();