function validarSenha() {
    var senha = document.getElementById('senha').value;
    var senhaError = document.getElementById('senhaError');

    var regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/;
    if (regex.test(senha) || senha == ''){
        senhaError.innerHTML = '';
    } else {
        senhaError.innerHTML = 'A senha deve ter pelo menos 8 caracteres, uma letra maiúscula, uma letra minúscula e um caractere especial.';
    }
}

if (window.location.href.includes('invalid_password')){
    alert('A senha não atende os critérios.');
};

function mostrarSenha(){
    var senha = document.getElementById('senha');
    var botao = document.getElementById('verSenhaButton');

    if (senha.type === 'password') {
        senha.type = 'text';
        botao.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
    } else {
        if (senha.type === 'text') {
            senha.type = 'password';
            botao.innerHTML = '<i class="fa-solid fa-eye"></i>';
        };
    };
}

function mudarOpcoes(tipo, caminho) {
    if (caminho == 'cadastro') {
        var divCaixaSelecaoCamisas = document.getElementById('selecaoNumeros');
        divCaixaSelecaoCamisas.innerHTML = '';
    }
    var categorias = document.getElementById('categorias');
    if (tipo == "jogador") {
        categorias.innerHTML = "<option id='option-padrao-categoria' selected>Escolha a categoria</option> <option value='1'>Goleiro</option> <option value='2' id='Zagueiro'>Zagueiro</option> <option value='3'>Lateral</option> <option value='4'>Meia</option> <option value='5'>Atacante</option>";
    };
    if (tipo == "tecnico") {
        categorias.innerHTML = "<option id='option-padrao-categoria' selected>Escolha a categoria</option> <option value='6'>Treinador</option> <option value='7'>Auxiliar técnico</option> <option value='8'>Preparador físico</option> <option value='9'>Fisioterapeuta</option>";
    };
};

function definirCategoriaPadrao(categoria) {
    var option = document.getElementById('option-padrao-categoria');
    const categorias = {
        'Goleiro': 1,
        'Zagueiro': 2,
        'Lateral': 3,
        'Meia': 4,
        'Atacante': 5,
        'Treinador': 6,
        'Auxiliar Tecnico': 7,
        'Preparador Fisico': 8,
        'Fisioterapeuta': 9
    };

    if (categorias.hasOwnProperty(categoria)) {
        option.value = categorias[categoria];
    } else {
        console.error(`Categoria não mapeada: ${categoria}`);
    }

    option.innerHTML = categoria;

    var option = document.getElementById(categoria);
    option.hidden = true;
};

function definirNumeroCamisaPadrao(numero) {
    var option = document.getElementById('option-padrao-numero');

    option.innerHTML = numero;
    option.value = numero;
};

function selecionarCamisa(tela, numero){
    var opcaoSelecionada = document.getElementById('categorias').value;
    var div = document.getElementById('selecaoNumeros');
    div.innerHTML = '';

    if (opcaoSelecionada == '3'){
        div.class = "mb-3";
        div.innerHTML = "<div class='mb-3'> <label for='numero'>Número da camisa</label> <select id='numeros' class='custom-select' name='numero'> <option selected id='option-padrao-numero'>Escolha a camisa</option> <option value='2'>2</option> <option value='3'>3</option> </select> </div>";
    }

    if (opcaoSelecionada == '2'){
        div.class = "mb-3";
        div.innerHTML = "<div class='mb-3'> <label for='numero'>Número da camisa</label> <select id='numeros' class='custom-select' name='numero'> <option selected id='option-padrao-numero'>Escolha a camisa</option> <option value='4'>4</option> <option value='5'>5</option> </select> </div>";
    }

    if (opcaoSelecionada == '4'){
        div.class = "mb-3";
        div.innerHTML = "<div class='mb-3'> <label for='numero'>Número da camisa</label> <select id='numeros' class='custom-select' name='numero'> <option selected id='option-padrao-numero'>Escolha a camisa</option> <option value='6'>6</option> <option value='8'>8</option> </select> </div>";
    }

    if (opcaoSelecionada == '5'){
        div.class = "mb-3";
        div.innerHTML = "<div class='mb-3'> <label for='numero'>Número da camisa</label> <select id='numeros' class='custom-select' name='numero'> <option selected id='option-padrao-numero'>Escolha a camisa</option> <option value='9'>9</option> <option value='10'>10</option> </select> </div>";
    }
    if (tela == 'atualizar' && opcaoSelecionada != '1') {
        definirNumeroCamisaPadrao(numero)
    }
}

function voltarPagina(tela) {
    if (tela == 'atualizar') {
        location.href='gerenciarMembros.php';
    } else {
        location.href='dashboard.php';
    }
}

function sair() {
    location.href="logout.php"
}

function exibirAlertaDeConfirmacao(url) {
    var confirmacao = window.confirm("Tem certeza que deseja excluir este item?");

    if (confirmacao) {
        location.href=url;
    } else {
        alert("Exclusão cancelada pelo usuário.");
    }
}