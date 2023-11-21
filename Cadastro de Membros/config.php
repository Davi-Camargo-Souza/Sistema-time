<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $base = "cadastroMembros";

    try {
        $conn = mysqli_connect($servername, $username, $password);
    } catch (Exception $e) {
        print "<script>alert('Erro ao tentar se conectar ao banco de dados.')</script>";
        print "<script>location.href='index.php'</script>";
    }

    $sql = "CREATE SCHEMA IF NOT EXISTS cadastroMembros";
    $result = $conn->query($sql);

    if ($result == TRUE) {
        $conn = new mysqli($servername, $username, $password, $base);
        $sql = "CREATE TABLE IF NOT EXISTS cadastroMembros.usuarios (
                id INT PRIMARY KEY AUTO_INCREMENT,
                nome VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL UNIQUE,
                senha VARCHAR(255) NOT NULL,
                dtaNasc DATE NOT NULL,
                dtaCadastro DATE NOT NULL);";
        $result = $conn->query($sql);
    } if ($result->num_rows == 0) {
        $conn = new mysqli($servername, $username, $password, $base);
    } else {
        print "<script>alert('Erro ao criar o banco de dados.')</script>";
    };
