
let btnAgregarContacto = document.getElementById('btnAgregarContacto');
let usuarioLogin = document.getElementById('usuarioLogin');
let usuarioSeguido = document.getElementById('usuarioSeguido');

if (btnAgregarContacto) {

  btnAgregarContacto.addEventListener('click', (event) => {
    
    console.log(usuarioLogin.value);
    console.log(usuarioSeguido.value);

  });
}