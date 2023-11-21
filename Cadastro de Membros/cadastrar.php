<?php
    session_start();
    include("config.php");
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $dtaNasc = $_POST["date"];
    $dtaCadastro = date("Y-m-d");

    $sql = "INSERT INTO usuarios
            (nome, email, senha, 
            dtaNasc, dtaCadastro)
            VALUES ('{$nome}', '{$email}',
            '{$senha}', '{$dtaNasc}', 
            '{$dtaCadastro}')";

    try {
        if ($conn->query($sql) === TRUE) {
            print "<script>location.href='index.php'</script>";
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            print "<script>alert('E-mail já cadastrado.')</script>";
        }
    } catch (Exception $e) {
        print "<script>alert('Cadastro não realizado')</script>";
    } finally {
        $conn->close();
    };
    print "<script>location.href='cadastro.php'</script>";