<?php 
    include("config.php");
    $nome = $_POST["nome"];
    $documento = $_POST["documento"];
    $dtaNasc = $_POST["date"];
    $funcao = $_POST["funcao"];
    $categoria = $_POST["categoria"];
    $data = date("Y-m-d");

    $sql = "SELECT 1 FROM cadastromembros.membros
            WHERE cpf = '{$documento}'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        print "<script>alert('CPF já cadastrado como um jogador.')</script>";
        print "<script>location.href='cadastromembros.php'</script>";
        exit();
    }

    $sql = "INSERT INTO cadastromembros.membros
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
        $sql = "INSERT INTO cadastromembros.cadastro_jogadores
            (codMembro, numero, dtaCadastro) VALUES ('{$codMembro}','{$numero}', '{$data}')";
    } else if ($funcao == "Tecnico"){
        $sql = "INSERT INTO cadastromembros.cadastro_comissao_tecnica
                (codMembro, dtaCadastro) VALUES ('{$codMembro}','{$data}')";
    };

    $result = $conn->query($sql);
    if ($result === TRUE) {
        print"<script>alert('Registro cadastrado com sucesso.')</script>";
    }

    $conn->close();
    print "<script>location.href='cadastromembros.php'</script>";
