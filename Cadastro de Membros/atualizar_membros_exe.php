<?php
    include("tratamento_inatividade.php");
    include("config.php");
    $idMembro = $_POST["idMembro"];
    $documento = $_POST["documento"];
    $nome = $_POST["nome"];
    $dtaNasc = $_POST["date"];
    $categoria = $_POST["categoria"];

    $sql = "SELECT 1 FROM membros
            WHERE cpf = '{$documento}'
            AND idMembro != '{$idMembro}'";
    
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        echo "<script>alert('CPF inserido já está vinculado a outro membro.')</script>";
        echo "<script>window.history.back()</script>";
        $conn->close();
        exit();
    } else {
        if(isset($_POST["idjogador"])){
            $idJogador = $_POST["idjogador"];
            if (isset($_POST["numero"])){
                $numero = $_POST["numero"];
                $sql = "UPDATE cadastro_jogadores SET numero = '{$numero}'
                        WHERE idJogador = '{$idJogador}'";
                $result = $conn->query($sql);
            } else if ($categoria == 1) {
                $numero = 1;
                $sql = "UPDATE cadastro_jogadores SET numero = '{$numero}'
                        WHERE idJogador = '{$idJogador}'";
                $result = $conn->query($sql);
            }
        }
        $sql = "UPDATE membros SET codFuncao = '{$categoria}',
                nome = '{$nome}', cpf = '{$documento}', dtaNasc = '{$dtaNasc}'
                WHERE idMembro = '{$idMembro}' ";
        $result = $conn->query($sql);
        if ($result) {
            echo "<script>alert('Cadastro atualizado com sucesso.')</script>";
        } else {
            echo "<script>alert('Não foi possível atualizar o cadastro.')</script>";
        }
    };
    echo "<script>location.href='gerenciar_membros.php'</script>";
    $conn->close();

   