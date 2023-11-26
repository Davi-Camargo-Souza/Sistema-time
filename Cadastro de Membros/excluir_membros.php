<?php
    include("tratamento_inatividade.php");
    include("config.php");
    if (isset($_GET["idtecnico"])) {
        $id = $_GET["idtecnico"];
        $tabela = "cadastro_comissao_tecnica";
        $coluna = "idTecnico";

    } else if (isset($_GET["idjogador"])) {
        $id = $_GET["idjogador"];
        $tabela = "cadastro_jogadores";
        $coluna = "idJogador";
    }

    $sql = "SELECT codMembro FROM $tabela
            WHERE '{$id}' = $tabela.$coluna";
    
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $idMembro = $row["codMembro"];

    $sql = "DELETE FROM $tabela
            WHERE '{$id}' = $tabela.$coluna";
    
    $result = $conn->query($sql);

    if ($result) {
        $sql = "DELETE FROM membros
                WHERE '{$idMembro}' = idMembro";
        $result = $conn->query($sql);

        if ($result) {
            print "<script>alert('Exclusão bem sucedida.')</script>";
            print "<script>location.href='gerenciar_membros.php'</script>";
            $conn->close();
            exit();
        } else {
            print "<script>alert('Não foi possível excluir, tente novamente.')</script>";
            print "<script>location.href='gerenciar_membros.php'</script>";
            $conn->close();
            exit();
        }
    } else {
        print "<script>alert('Não foi possível excluir, tente novamente.')</script>";
        print "<script>location.href='gerenciar_membros.php'</script>";
        $conn->close();
        exit();
    }