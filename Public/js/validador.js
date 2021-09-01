/*Script de validação dos campos para cadastro */

function validaCadastro(){
    let nome = frmCadastro.nome.value
    let telefone = frmCadastro.telefone.value
    let email = frmCadastro.email.value
    let whatsapp = frmCadastro.whatsapp.value

    if (nome === "") {
        alert('Para finalizar o cadastro é necessário informar o Nome!')
        frmCadastro.nome.focus();
    } else if (email === "") {
        alert('Para finalizar o cadastro é necessário informar o Email!')
        frmCadastro.email.focus();
        return false
    }  else {
        document.forms["frmCadastro"].submit()
        alert('Cadastro realizado com sucesso!')
    }
}

function validaEdicao(){
    let nome = frmCadastro.nome.value
    let telefone = frmCadastro.telefone.value
    let email = frmCadastro.email.value
    let whatsapp = frmCadastro.whatsapp.value

    if (nome === "") {
        alert('Para finalizar a edição é necessário informar o Nome!')
        frmCadastro.nome.focus();
    } else if (email === "") {
        alert('Para finalizar a edição é necessário informar o Email!')
        frmCadastro.email.focus();
        return false
    } else {
        document.forms["frmCadastro"].submit()
        alert('Cadastro atualizado com sucesso!')
    }
}

function editar(){
    var page = (window.location.href = 'editar.html')
    page.onload()
    
}