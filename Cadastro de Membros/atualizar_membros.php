<?php
    include("tratamento_inatividade.php");
    include('config.php');
    if (isset($_GET['idtecnico'])) {
        $idTecnico = $_GET['idtecnico'];
        $tipo = "tecnico";

        $sql = "SELECT codMembro 
                FROM cadastro_comissao_tecnica
                WHERE '{$idTecnico}' = idTecnico";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $idMembro = $row["codMembro"];
    } else if (isset($_GET['idjogador'])) {
        $id = $_GET['idjogador'];
        $tipo = "jogador";

        $sql = "SELECT codMembro
                FROM cadastro_jogadores
                WHERE '{$id}' = idJogador";
        
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $idMembro = $row["codMembro"];

        $sql = "SELECT numero FROM
                cadastro_jogadores
                WHERE '{$id}' = idJogador";
        
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $numero = $row["numero"];
    }

    $sql = "SELECT nome, cpf, dtaNasc, 
            funcoes.nomeFuncao, funcoes.idFuncao
            FROM membros
            INNER JOIN funcoes ON membros.codFuncao = 
            funcoes.idFuncao
            WHERE '{$idMembro}' = idMembro";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $nome = $row["nome"];
    $cpf = $row["cpf"];
    $dtaNasc = $row["dtaNasc"];
    $nomefuncao = $row["nomeFuncao"];
    $idFuncao = $row["idFuncao"];
    $conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Cadastro</title>
    <link rel="shortcut icon" href="imgs/escudo-favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="scripts/script.js"></script>
</head>
<body class="corpo">
    <main>
        <div>
            <button id="voltar-btn" class="btn" onclick="voltarPagina()" style="background-color: darkred; color: white;"><i class="fa-solid fa-arrow-left"></i></button>
            <button id="sair-btn" class="btn" onclick="sair()" style="background-color: darkred; color: white"><i class="fa-solid fa-right-to-bracket"></i></button>
        </div>
        <div class="centralizar">
            <div class="conteiner">
                <div class="row">
                    <div class="col-lg-4 offset-lg-4">
                        <div class="card" style="border-color: darkred">
                            <div class="card-body" style="color: darkred">
                                <h2>Atualizar cadastros</h2>
                            </div>
                            <div class="card-body">
                                <form action="atualizar_membros_exe.php" method="POST">
                                    <input type="hidden" name="idMembro" value="<?php echo $idMembro; ?>">
                                    <div>
                                        <div class="mb-3">
                                            <label for="nome">Nome Completo</label>
                                            <input id="nome" type="text" name="nome" class="form-control" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" title="Nome entre 10 e 100 letras." value="<?php echo $nome ?>" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-3">
                                            <label for="cpf">CPF</label>
                                            <input id="cpf" type="text" name="documento" class="form-control mb-3" title="CPF do membro." minlength="11" maxlength="11" value="<?php echo $cpf ?>" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-3">
                                            <label for="dtaNasc">Data de Nascimento</label>
                                            <input id="dtaNasc" type="date" name="date" class="form-control" title="Data de nascimento do membro." value="<?php echo $dtaNasc ?>" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-3">
                                            <label for="categorias">Categoria</label>
                                            <?php
                                                if ($tipo == "jogador"){
                                                    echo "<select id='categorias' class='custom-select' name='categoria' onchange='selecionarCamisa(\"atualizar\",\"$numero\",\"$idFuncao\")'>
                                                    </select>";
                                                } else if ($tipo == "tecnico"){
                                                    echo "<select id='categorias' class='custom-select' name='categoria'>
                                                    </select>";
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div id="selecaoNumeros">
                                    </div>
                                    <div>
                                        <div class="mb-3">
                                            <button id="botaoEnviar" type="submit" class="btn" style="background-color: darkred; color: white">Enviar</button>
                                        </div>
                                    </div>
                                    <?php
                                        if ($tipo == "jogador") {
                                            echo "<input type='hidden' name='idjogador' value='$id'>";
                                            echo "<script>mudarOpcoes('jogador','atualizar')</script>";
                                            echo "<script>definirCategoriaPadrao(\"$nomefuncao\")</script>";
                                        } else if ($tipo == "tecnico") {
                                            echo "<script>mudarOpcoes('tecnico','atualizar')</script>";
                                            echo "<script>mudarOpcoes('tecnico','atualizar')</script>";
                                            echo "<script>definirCategoriaPadrao(\"$nomefuncao\")</script>";
                                        }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://kit.fontawesome.com/6f3da5c6b0.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>