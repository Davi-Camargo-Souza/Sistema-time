<?php
    session_start();
    if (empty($_SESSION["usuario"])) {
        header("Location: index.php");
        exit();
    };
    
    $inatividade = 1800; // 30 minutos

    if (isset($_SESSION['ultima_atividade']) && (time() - $_SESSION['ultima_atividade']) > $inatividade) {
        session_unset();
        session_destroy();
        
        print "<script>alert('Sessão expirada, faça login novamente.')</script>";
        print "<script>location.href='index.php'</script>";
        exit();
    }

    $_SESSION['ultima_atividade'] = time();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Membros</title>
    <link rel="shortcut icon" href="imgs/escudo-favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body class="corpo">
    <main>
        <div>
            <button id="voltar-btn" class="btn btn-danger" onclick="voltarPagina()"><i class="fa-solid fa-arrow-left"></i></button>
            <button id="sair-btn" class="btn btn-danger" onclick="sair()"><i class="fa-solid fa-right-to-bracket"></i></button>
        </div>
        <div class="centralizar">
            <div class="conteiner">
                <?php
                    include("config.php");
                    $temMembros = False;
                    $sql = "SELECT * FROM cadastromembros.membros";
                    $result = $conn->query($sql);

                    echo "<div class='card mb-3'>
                            <div class='card-body'>";

                    if ($result->num_rows == 0) {
                        echo "<h2 class='mt-2' style='text-align: center'>Não há membros cadastrados.</h2>";
                    } else {
                        $temMembros = True;
                        $sql = "SELECT idMembro, nome, cadastromembros.funcoes.nomeFuncao, 
                                cpf, dtaNasc, cadastromembros.cadastro_jogadores.numero, 
                                cadastromembros.cadastro_jogadores.idJogador 
                                FROM cadastromembros.membros
                                INNER JOIN cadastromembros.funcoes ON
                                cadastromembros.membros.codFuncao = 
                                cadastromembros.funcoes.idFuncao
                                INNER JOIN cadastromembros.cadastro_jogadores ON
                                cadastromembros.membros.idMembro = 
                                cadastromembros.cadastro_jogadores.codMembro
                                ORDER BY idMembro ASC";

                        $result = $conn->query($sql);
                        if ($result->num_rows == 0) {
                            echo "<h3 class='mt-2' style='text-align: center'>Não há jogadores cadastrados</h3>";
                        } else {
                            echo "<h2 style='text-align: center'>Jogadores</h2>
                                    <div class='row' style='text-align: center'>
                                        <div class='col'><strong>ID Membro</strong></div>
                                        <div class='col'><strong>ID Jogador</strong></div>
                                        <div class='col'><strong>Nome</strong></div>
                                        <div class='col'><strong>Categoria</strong></div>
                                        <div class='col'><strong>Camisa</strong></div>
                                        <div class='col'><strong>CPF</strong></div>
                                        <div class='col'><strong>Nascimento</strong></div>
                                        <div class='col'><strong>Editar</strong></div>
                                        <div class='col'><strong>Excluir</strong></div>
                                    </div>";
                            echo "<div class='mb-3'>";
                            while ($row = $result->fetch_assoc()) {
                                $idMembro = $row["idMembro"];
                                $idJogador = $row["idJogador"];
                                $nome = $row["nome"];
                                $funcao = $row["nomeFuncao"];
                                $cpf = $row["cpf"];
                                $dtaNasc = $row["dtaNasc"];
                                $numero = $row["numero"];
                                $linkExclusao = "excluirMembros.php?idjogador=".urlencode($idJogador);
                                $linkAtualizacao = "atualizarMembros.php?idjogador=".urlencode($idJogador);
                                
                                echo "<div class='row' style='text-align: center'>
                                        <div class='col'>$idMembro</div>
                                        <div class='col'>$idJogador</div>
                                        <div class='col'>$nome</div>
                                        <div class='col'>$funcao</div>
                                        <div class='col'>$numero</div>
                                        <div class='col'>$cpf</div>
                                        <div class='col'>$dtaNasc</div>
                                        <div class='col'><a href='$linkAtualizacao'>
                                        <button type='submit' class='btn btn-danger'><i class='fa-solid fa-pen-to-square'></i></button></a></div>
                                        <div class='col'><button class='btn btn-danger' onclick='exibirAlertaDeConfirmacao(\"$linkExclusao\")'><i class='fa-solid fa-trash'></i></button></div>
                                    </div>";
                            }
                            echo "</div>";
                        }
                    }
                    echo "</div>
                        </div>";
                    
                    $sql = "SELECT idMembro, nome, cadastromembros.funcoes.nomeFuncao, 
                            cpf, dtaNasc, cadastromembros.cadastro_comissao_tecnica.idTecnico
                            FROM cadastromembros.membros
                            INNER JOIN cadastromembros.funcoes ON
                            cadastromembros.membros.codFuncao = 
                            cadastromembros.funcoes.idFuncao
                            INNER JOIN cadastromembros.cadastro_comissao_tecnica ON
                            cadastromembros.membros.idMembro = 
                            cadastromembros.cadastro_comissao_tecnica.codMembro
                            ORDER BY idMembro ASC";

                    $result = $conn->query($sql);

                    if ($temMembros && $result->num_rows == 0) {
                        echo "<div class='card mb-3'>
                            <div class='card-body'>
                                <h3 class='mt-2' style='text-align: center'>Não há Técnicos cadastrados</h3>
                            </div>
                        </div>";
                    } else if ($result->num_rows > 0) {
                        echo "<div class='card mb-3>
                                <div class='card-body'>
                                    <div>
                                        <h2 class='mt-3' style='text-align: center'>Comissão Técnica</h2>
                                    </div>
                                    <div class='row' style='text-align: center'>
                                        <div class='col'><strong>ID Membro</strong></div>
                                        <div class='col'><strong>ID Técnico</strong></div>
                                        <div class='col'><strong>Nome</strong></div>
                                        <div class='col'><strong>Categoria</strong></div>
                                        <div class='col'><strong>CPF</strong></div>
                                        <div class='col'><strong>Nascimento</strong></div>
                                        <div class='col'><strong>Editar</strong></div>
                                        <div class='col'><strong>Excluir</strong></div>
                                    </div>";
                                echo "<div class='mb-3'>
                                        <div class='mb-3'>";
                                while ($row = $result->fetch_assoc()) {
                                    $idMembro = $row["idMembro"];
                                    $idTecnico = $row["idTecnico"];
                                    $nome = $row["nome"];
                                    $funcao = $row["nomeFuncao"];
                                    $cpf = $row["cpf"];
                                    $dtaNasc = $row["dtaNasc"];
                                    $linkExclusao = "excluirMembros.php?idtecnico=".urlencode($idTecnico);
                                    $linkAtualizacao = "atualizarMembros.php?idtecnico=".urlencode($idTecnico);

                                    echo "<div class='row' style='text-align: center'>
                                            <div class='col'>$idMembro</div>
                                            <div class='col'>$idTecnico</div>
                                            <div class='col'>$nome</div>
                                            <div class='col'>$funcao</div>
                                            <div class='col'>$cpf</div>
                                            <div class='col'>$dtaNasc</div>
                                            <div class='col'><a href='$linkAtualizacao'>
                                            <button type='submit' class='btn btn-danger'><i class='fa-solid fa-pen-to-square'></i></button></a></div>
                                            <div class='col'><button class='btn btn-danger' onclick='exibirAlertaDeConfirmacao(\"$linkExclusao\")'><i class='fa-solid fa-trash'></i></button></div>
                                        </div>";
                                }
                                echo "</div>
                                    </div>";
                        echo "</div>
                        </div>";
                    };
                    $conn->close();
                ?>
            </div>
        </div>
    </main>
    <script src="scripts/script.js"></script>
    <script src="https://kit.fontawesome.com/6f3da5c6b0.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>