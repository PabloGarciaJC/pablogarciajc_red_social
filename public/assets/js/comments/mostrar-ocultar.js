function mostrarOcultar() {
  var caja = document.getElementById('formularioComentario');
  if (caja.style.display == 'none') {
    mostrarComentarios();
  } else {
    ocultarComentarios();
  }
}

function mostrarComentarios() {
  document.getElementById('formularioComentario').style.display = 'block';
  console.log('block');
}

function ocultarComentarios() {
  document.getElementById('formularioComentario').style.display = 'none';
  console.log('none');
}