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

function mudarOpcoes(funcao) {
    var divCaixaSelecaoCamisas = document.getElementById('selecaoNumeros');
    divCaixaSelecaoCamisas.innerHTML = '';

    var categorias = document.getElementById('categorias');
    if (funcao == "jogador") {
        categorias.innerHTML = "<option selected>Escolha a categoria</option> <option value='1'>Goleiro</option> <option value='2'>Zagueiro</option> <option value='3'>Lateral</option> <option value='4'>Meia</option> <option value='5'>Atacante</option>";
    };
    if (funcao == "tecnico") {
        categorias.innerHTML = "<option selected>Escolha a categoria</option> <option value='6'>Treinador</option> <option value='7'>Auxiliar técnico</option> <option value='8'>Preparador físico</option> <option value='9'>Fisioterapeuta</option>";
    };
}

function selecionarCamisa(){
    var opcaoSelecionada = document.getElementById('categorias').value;
    var div = document.getElementById('selecaoNumeros');
    div.innerHTML = '';

    if (opcaoSelecionada == '3'){
        div.class = "mb-3";
        div.innerHTML = "<div class='mb-3'> <label for='numero'>Número da camisa</label> <select id='numeros' class='custom-select' name='numero'> <option selected>Escolha a camisa</option> <option value='2'>2</option> <option value='3'>3</option> </select> </div>";
    }

    if (opcaoSelecionada == '2'){
        div.class = "mb-3";
        div.innerHTML = "<div class='mb-3'> <label for='numero'>Número da camisa</label> <select id='numeros' class='custom-select' name='numero'> <option selected>Escolha a camisa</option> <option value='4'>4</option> <option value='5'>5</option> </select> </div>";
    }

    if (opcaoSelecionada == '4'){
        div.class = "mb-3";
        div.innerHTML = "<div class='mb-3'> <label for='numero'>Número da camisa</label> <select id='numeros' class='custom-select' name='numero'> <option selected>Escolha a camisa</option> <option value='6'>6</option> <option value='8'>8</option> </select> </div>";
    }

    if (opcaoSelecionada == '5'){
        div.class = "mb-3";
        div.innerHTML = "<div class='mb-3'> <label for='numero'>Número da camisa</label> <select id='numeros' class='custom-select' name='numero'> <option selected>Escolha a camisa</option> <option value='9'>9</option> <option value='10'>10</option> </select> </div>";
    }
}