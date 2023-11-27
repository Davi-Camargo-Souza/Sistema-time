<?php 
    // processa o cadastro dos membros do time
    include("tratamento_inatividade.php");
    include("config.php");
    $documento = $_POST["documento"];
    $nome = $_POST["nome"];

    if (strlen($documento) < 11) {
        print "<script>alert('Por favor, digite um CPF com 11 digítos.')</script>";
        print "<script>location.href='cadastro_membros.php'</script>";
        exit();
    }

    $sql = "SELECT 1 FROM membros
            WHERE cpf = '{$documento}'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        print "<script>alert('CPF já cadastrado.')</script>";
        print "<script>location.href='cadastro_membros.php'</script>";
        exit();
    }

    $dtaNasc = $_POST["date"];
    $funcao = $_POST["funcao"];
    $categoria = $_POST["categoria"];
    $data = date("Y-m-d");

    $sql = "INSERT INTO membros
            (nome, cpf, dtaNasc, codFuncao)
            VALUES ('{$nome}', '{$documento}',
            '{$dtaNasc}','{$categoria}')";
    
    $conn->query($sql);
    $codMembro = $conn->insert_id;

    if ($funcao == "Jogador") {
        if ($categoria == "1"){
            $numero = 1;
        } else {
            $numero = $_POST["numero"];
        }
        $sql = "INSERT INTO cadastro_jogadores
            (codMembro, numero, dtaCadastro) VALUES ('{$codMembro}','{$numero}', '{$data}')";
    } else if ($funcao == "Tecnico"){
        $sql = "INSERT INTO cadastro_comissao_tecnica
                (codMembro, dtaCadastro) VALUES ('{$codMembro}','{$data}')";
    };

    $result = $conn->query($sql);
    if ($result === TRUE) {
        print"<script>alert('Registro cadastrado com sucesso.')</script>";
    }

    $conn->close();
    print "<script>location.href='cadastro_membros.php'</script>";
