<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $base = "cadastroMembros";

    try {
        $conn = mysqli_connect($servername, $username, $password);
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }
    } catch (Exception $e) {
        print "<script>alert('Erro ao tentar se conectar ao banco de dados.')</script>";
        print "<script>location.href='index.php'</script>";
    }

    $sql = "CREATE SCHEMA IF NOT EXISTS cadastroMembros";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        $conn = new mysqli($servername, $username, $password, $base);
        $sql = "CREATE TABLE IF NOT EXISTS cadastroMembros.usuarios (
                id INT PRIMARY KEY AUTO_INCREMENT,
                nome VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL UNIQUE,
                senha VARCHAR(255) NOT NULL,
                dtaNasc DATE NOT NULL,
                dtaCadastro DATE NOT NULL);";
        $conn->query($sql);
        $conn = new mysqli($servername, $username, $password, $base);
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }
    } else {
        print "<script>alert('Erro ao criar o banco de dados.')</script>";
    };

    $sql = "CREATE TABLE IF NOT EXISTS cadastromembros.funcoes (
            idFuncao INT PRIMARY KEY NOT NULL,
            nomeFuncao VARCHAR(255) NOT NULL UNIQUE);";
    
    $conn->query($sql);

    $sql = "SELECT 1 FROM cadastromembros.funcoes
            WHERE idFuncao = 1";
    $result = $conn->query($sql);
    if ($result != 1) {
        $sql = "INSERT INTO cadastromembros.funcoes (idFuncao, nomeFuncao)
        VALUES (1, 'Goleiro'), (2,'Zagueiro'), (3,'Lateral'), (4,'Meia'), (5,'Atacante'),
        (6,'Treinador'),(7,'Auxiliar Tecnico'),(8,'Preparador Fisico'), (9,'Fisioterapeuta');";
    
        $conn->query($sql);
    }
   
    $sql = "CREATE TABLE IF NOT EXISTS cadastromembros.membros (
            idMembro INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            codFuncao INT NOT NULL,
            nome VARCHAR(255) NOT NULL,
            cpf VARCHAR(11) NOT NULL,
            dtaNasc DATE,
            FOREIGN KEY (codFuncao) REFERENCES funcoes(idFuncao));";
    
    $conn->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS cadastromembros.cadastro_jogadores (
            idJogador INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            codMembro INT NOT NULL,
            numero INT NOT NULL,
            FOREIGN KEY (codMembro) REFERENCES membros(idMembro));";
        
    $conn->query($sql);
    
    $sql = "CREATE TABLE IF NOT EXISTS cadastromembros.cadastro_comissao_tecnica (
            idTecnico INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            codMembro INT NOT NULL,
            FOREIGN KEY (codMembro) REFERENCES membros(idMembro));";

    $conn->query($sql);
    
        
