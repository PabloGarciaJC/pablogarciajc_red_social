require('./bootstrap');

Echo.channel('notificationss')
  .listen('UserSessionChanged', (e) => {
    e.usuarios.forEach((user, index) => {
      const devUsuarios = document.getElementById('usuarioStatus' + user.id);
      if (user.conectado == 1) {
        devUsuarios.innerText = 'Conectado';
        devUsuarios.style.color = 'green';
      } else {
        devUsuarios.innerText = 'Desconectado';
        devUsuarios.style.color = 'red';
      }
    });
  });
