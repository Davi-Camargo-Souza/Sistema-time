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
    var categorias = document.getElementById('categorias');

    if (funcao == "jogador") {
        categorias.innerHTML = "<option selected>Escolha a categoria</option> <option value='Goleiro'>Goleiro</option> <option value='Zagueiro'>Zagueiro</option> <option value='Lateral'>Lateral</option> <option value='Meia'>Meia</option> <option value='Atacante'>Atacante</option>";
    };
    if (funcao == "tecnico") {
        categorias.innerHTML = "<option selected>Escolha a categoria</option> <option value='Treinador'>Treinador</option> <option value='Auxiliar Tecnico'>Auxiliar técnico</option> <option value='Preparador fisico'>Preparador físico</option> <option value='Fisioterapeuta'>Fisioterapeuta</option>";
    };
}