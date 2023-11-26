<?php
    include("tratamento_inatividade.php");
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
            <button id="voltar-btn" class="btn" onclick="voltarPagina()" style="background-color: darkred; color: white;"><i class="fa-solid fa-arrow-left"></i></button>
            <button id="sair-btn" class="btn" onclick="sair()" style="background-color: darkred; color: white"><i class="fa-solid fa-right-to-bracket"></i></button>
        </div>
        <div class="centralizar">
            <div class="conteiner">
                <?php
                    include("config.php");
                    $temMembros = False;
                    $sql = "SELECT * FROM membros";
                    $result = $conn->query($sql);

                    echo "<div class='card mb-3'>
                            <div class='card-body'>";

                    if ($result->num_rows == 0) {
                        echo "<h2 class='mt-2' style='text-align: center; color: darkred'>Não há membros cadastrados.</h2>";
                    } else {
                        $temMembros = True;
                        $sql = "SELECT idMembro, nome, funcoes.nomeFuncao, 
                                cpf, dtaNasc, cadastro_jogadores.numero, 
                                cadastro_jogadores.idJogador 
                                FROM membros
                                INNER JOIN funcoes ON
                                membros.codFuncao = 
                                funcoes.idFuncao
                                INNER JOIN cadastro_jogadores ON
                                membros.idMembro = 
                                cadastro_jogadores.codMembro
                                ORDER BY idMembro ASC";

                        $result = $conn->query($sql);
                        if ($result->num_rows == 0) {
                            echo "<h3 class='mt-2' style='text-align: center; color: darkred'>Não há jogadores cadastrados</h3>";
                        } else {
                            echo "<h2 style='text-align: center; color: darkred'>Jogadores</h2>
                                    <div class='row mb-1 rounded' style='text-align: center; background-color: darkred; color: white'>
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
                                $linkExclusao = "excluir_membros.php?idjogador=".urlencode($idJogador);
                                $linkAtualizacao = "atualizar_membros.php?idjogador=".urlencode($idJogador);
                                
                                echo "<div class='row align-items-center' style='text-align: center'>
                                        <div class='col'>$idMembro</div>
                                        <div class='col'>$idJogador</div>
                                        <div class='col'>$nome</div>
                                        <div class='col'>$funcao</div>
                                        <div class='col'>$numero</div>
                                        <div class='col'>$cpf</div>
                                        <div class='col'>$dtaNasc</div>
                                        <div class='col'><a href='$linkAtualizacao'>
                                        <button type='submit' class='btn' style='background-color: darkred; color: white'><i class='fa-solid fa-pen-to-square'></i></button></a></div>
                                        <div class='col'><button class='btn' onclick='exibirAlertaDeConfirmacao(\"$linkExclusao\")' style='background-color: darkred; color: white'><i class='fa-solid fa-trash'></i></button></div>
                                    </div>";
                            }
                            echo "</div>";
                        }
                    }
                    echo "</div>
                        </div>";
                    
                    $sql = "SELECT idMembro, nome, funcoes.nomeFuncao, 
                            cpf, dtaNasc, cadastro_comissao_tecnica.idTecnico
                            FROM membros
                            INNER JOIN funcoes ON
                            membros.codFuncao = 
                            funcoes.idFuncao
                            INNER JOIN cadastro_comissao_tecnica ON
                            membros.idMembro = 
                            cadastro_comissao_tecnica.codMembro
                            ORDER BY idMembro ASC";

                    $result = $conn->query($sql);

                    if ($temMembros && $result->num_rows == 0) {
                        echo "<div class='card mb-3'>
                            <div class='card-body'>
                                <h3 class='mt-2' style='text-align: center; color: darkred'>Não há Técnicos cadastrados</h3>
                            </div>
                        </div>";
                    } else if ($result->num_rows > 0) {
                        echo "<div class='card mb-3'>
                                <div class='card-body'>
                                    <div>
                                        <h2 style='text-align: center; color: darkred'>Comissão Técnica</h2>
                                    </div>
                                    <div class='row mb-1 rounded' style='text-align: center; background-color: darkred; color: white'>
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
                                    $linkExclusao = "excluir_membros.php?idtecnico=".urlencode($idTecnico);
                                    $linkAtualizacao = "atualizar_membros.php?idtecnico=".urlencode($idTecnico);

                                    echo "<div class='row align-items-center' style='text-align: center'>
                                            <div class='col'>$idMembro</div>
                                            <div class='col'>$idTecnico</div>
                                            <div class='col'>$nome</div>
                                            <div class='col'>$funcao</div>
                                            <div class='col'>$cpf</div>
                                            <div class='col'>$dtaNasc</div>
                                            <div class='col'><a href='$linkAtualizacao'>
                                            <button type='submit' class='btn' style='background-color: darkred; color: white'><i class='fa-solid fa-pen-to-square'></i></button></a></div>
                                            <div class='col'><button class='btn' onclick='exibirAlertaDeConfirmacao(\"$linkExclusao\")' style='background-color: darkred; color: white'><i class='fa-solid fa-trash'></i></button></div>
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