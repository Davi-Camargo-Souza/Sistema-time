function validarCampos(){
    var usuario = document.getElementById('usuario').value;
    var senha = document.getElementById('senha').value;

    if (usuario.trim() === '' || senha.trim() === ''){
        alert("Preencha todos os campos.");
        return false;
    };
    return true;
}