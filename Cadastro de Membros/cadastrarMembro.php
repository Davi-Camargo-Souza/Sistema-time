<?php 
    include("config.php");
    $nome = $_POST["nome"];
    $documento = $_POST["documento"];
    $dtaNasc = $_POST["date"];
    $funcao = $_POST["funcao"];
    $categoria = $_POST["categoria"];
    $data = date("Y-m-d");

    if ($funcao == "Jogador") {
        if ($categoria == "1"){
            $numero = 1;
        } else {
            $numero = $_POST["numero"];
        }
    };

    $sql = "INSERT INTO cadastromembros.membros
            (nome, cpf, dtaNasc, codFuncao)
            VALUES ('{$nome}', '{$documento}',
            '{$dtaNasc}','{$categoria}')";
    
    $conn->query($sql);
    $codMembro = $conn->insert_id;

    $sql = "INSERT INTO cadastromembros.cadastro_jogadores
            (codMembro, numero, dtaCadastro) VALUES ('{$codMembro}','{$numero}', '{$data}')";
    
    $result = $conn->query($sql);

    if ($result === TRUE) {
        print"<script>alert('Registro cadastrado com sucesso.')</script>";
    }

    $conn->close();


    

