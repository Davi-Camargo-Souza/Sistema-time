<?php 
    session_start();
    include("config.php");
    $usuario = $_POST["usuario"];
    $senha = md5($_POST["senha"]);

    $sql = "SELECT * FROM usuarios
            WHERE email = '{$usuario}'
            AND senha = '{$senha}'";

    $result = $conn->query($sql) or die($conn->error);
    $row = $result->fetch_object();
    $qtd = $result->num_rows;

    if ($qtd == 1) {
        $_SESSION["usuario"] = $usuario;
        $_SESSION["nome"] = $row->nome;
        print "<script>location.href='dashboard.php';</script>";
    } else {
        print "<script>alert('Usuário e/ou senha incorreto(s)');</script>";
        print "<script>location.href='index.php';</script>";
    };