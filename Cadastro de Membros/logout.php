<?php
    // esse arquivo processa as ações de logout, destruindo a sessão do usuario.
    session_start();
    session_unset();
    session_destroy();
    header("Location: index.php");