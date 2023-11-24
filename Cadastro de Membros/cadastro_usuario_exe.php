<?php
    session_start();

    $regex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/';
    if (!preg_match($regex, $_POST["senha"])){
        header("Location: cadastro_usuario.php?error=invalid_password");
        exit();
    };

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
            md5('{$senha}'), '{$dtaNasc}', 
            '{$dtaCadastro}')";

    try {
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            $conn->close();
            exit();
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
    print "<script>location.href='cadastro_usuario.php'</script>";