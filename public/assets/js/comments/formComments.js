
function formComments(idPublicationForm) {

  let urlAjaxCommentsForm = baseUrl + 'comentarioSave';

  // Instacio 
  let datosFormulario = new FormData();
  let imagenPublication = $('#imagenPublicacion' + idPublicationForm)[0].files[0];

  let comentarioPublication = document.getElementById('comentarioPublicacion' + idPublicationForm);

  // //Setear el Objet
  
  // datosFormulario.append('_token', $("meta[name='csrf-token']").attr("content"));
  // datosFormulario.append('comentPublication', comentarioPublication.value);
  // datosFormulario.append('idPublication', idPublicationForm);
  // datosFormulario.append('imagenPublication', imagenPublication);

  // $.ajax({
  //   data: datosFormulario,
  //   type: "POST",
  //   dataType: "json",
  //   url: urlAjaxCommentsForm,
  //   contentType: false,
  //   processData: false,

  // })
  //   .done(function (respuesta) {

  //     respuesta.forEach((comment, index) => {

  //       // $('#requestAJaxComments' + countComments).html(comment.contenido);

  //       let divComments = document.createElement('div');
  //       divComments.setAttribute('id', 'idComentarioCreado' + comment.id);
  //       // divComments.style.backgroundColor = "red";
  //       requestAJaxComments.appendChild(divComments);
   
  //       // console.log(countComments);
  //       // console.log(divComments);

  //     });


  //   })
  //   .fail(function () {
  //     console.log('error');
  //   })
  //   .always(function () {
  //     console.log('completo');
  //   });


}

    // $(".classRepuestaAjaxFormComments").html(comment.contenido);
  

        // console.log(respuestaAjaxFormComments);

        // console.log(comment);

        // let divComments = document.createElement('div');

        // divComments.setAttribute('id', 'idComentarioCreado' + comment.id);

        // comentarios = document.getElementById('idComentarioCreado' + idPublicationForm);
        // comentarios.style.backgroundColor = "red";

        // console.log(divComments);

        // divComments.className = "row row-cols-auto";


        // respuestaAjaxFormComments.appendChild(divComments);

        // respuestaAjaxFormComments.removeAttribute('id', 'respuestaAjaxFormComments');

        // console.log(respuestaAjaxFormComments);


        // respuestaAjaxFormComments.setAttribute('id', 'respuestaAjaxFormComments' + idPublicationForm);

        // let respuestaAjaxFormComments = document.getElementById('respuestaAjaxFormComments' + idPublicationForm);

        // classRepuestaAjaxComments.className = "row row-cols-auto";
        // respuestaAjaxFormComments.className = "row row-cols-auto";

        // var divComments = document.createElement("div");
        // divComments.setAttribute('id', 'idComentarioCreado' + comment.id);
        // var newContent = document.createTextNode("Hola!¿Qué tal?");


        // console.log(respuestaAjaxFormComments);
        // respuestaAjaxFormComments.appendChild(divComments); //añade texto al div creado.


        // let divAvatarUser = document.createElement("div");
        // divAvatarUser.className = "col news";

        // // Avatar User
        // let imgAvatarUser = document.createElement('img');
        // imgAvatarUser.src = 'assets/img/profile-img.jpg';
        // divAvatarUser.appendChild(imgAvatarUser);

        // // Fin divComments
        // divComments.appendChild(divAvatarUser);

        // if (comment.imagen == null) {

        // } else {

        // }



        // <p>`+ comment.contenido +  `</p>
        // respuestaAjaxFormComments.classList.add('news');

        // var parrafo = document.createElement("p");
        // parrafo.innerText = comment.contenido;
        // respuestaAjaxFormComments.appendChild(parrafo);


        // let divCommentImagen = document.createElement("div");
        // divCommentImagen.className = "text-letf";
        // divCommentImagen.style.cssText = 'margin-left: 94px;';
        // respuestaAjaxFormComments.appendChild(divCommentImagen);

        // let imagen = document.createElement('img');
        // imagen.src = 'assets/img/profile-img.jpg;'
        // divCommentImagen.appendChild(imagen);

        // imagen.src = 'assets/img/profile-img.jpg';
        // respuestaAjaxFormComments.appendChild(imagen);