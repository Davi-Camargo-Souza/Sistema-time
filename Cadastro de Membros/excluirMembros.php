<?php
    include("config.php");
    if (isset($_POST["idtecnico"])) {
        $id = $_POST["idtecnico"];
        $tabela = "cadastro_comissao_tecnica";
        $coluna = "idTecnico";

    } else if (isset($_POST["idjogador"])) {
        $id = $_POST["idjogador"];
        $tabela = "cadastro_jogadores";
        $coluna = "idJogador";
    }

    $sql = "SELECT codMembro FROM cadastromembros.$tabela
            WHERE $id = cadastromembros.$tabela.$coluna";
    
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $idMembro = $row["codMembro"];

    $sql = "DELETE FROM cadastromembros.$tabela
            WHERE $id = cadastromembros.$tabela.$coluna";
    
    $result = $conn->query($sql);

    if ($result) {
        $sql = "DELETE FROM cadastromembros.membros
                WHERE '{$idMembro}' = idMembro";
        $result = $conn->query($sql);

        if ($result) {
            print "<script>alert('Exclusão bem sucedida.')</script>";
            print "<script>location.href='gerenciarMembros.php'</script>";
        } else {
            print "<script>alert('Não foi possível excluir, tente novamente.')</script>";
            print "<script>location.href='gerenciarMembros.php'</script>";
            $conn->close();
            exit();
        }
    } else {
        print "<script>alert('Não foi possível excluir, tente novamente.')</script>";
        print "<script>location.href='gerenciarMembros.php'</script>";
        $conn->close();
        exit();
    }