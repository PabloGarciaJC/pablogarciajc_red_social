
function formComments(idPublicationForm) {


  let urlAjaxCommentsForm = baseUrl + 'comentarioSave';

  // Ajax Vista Previa 
  let datosFormulario = new FormData();

  let imagenPublication = $('#imagenPublicacion' + idPublicationForm)[0].files[0];
  let comentarioPublication = document.getElementById('comentarioPublicacion' + idPublicationForm);

  //Setear el Objet
  datosFormulario.append('_token', $("meta[name='csrf-token']").attr("content"));
  datosFormulario.append('comentPublication', comentarioPublication.value);
  datosFormulario.append('idPublication', idPublicationForm);
  datosFormulario.append('imagenPublication', imagenPublication);


  $.ajax({
    data: datosFormulario,
    type: "POST",
    dataType: "json",
    url: urlAjaxCommentsForm,
    contentType: false,
    processData: false,

  })
    .done(function (respuesta) {

      respuesta.forEach((comment, index) => {

        console.log(comment.contenido)

      });

      // if(respuestaPeticion){
      //   console.log('Guardado');
      //   location.reload();
      // }else{
      //   console.log('Error Guardado');
      // }

    })
    .fail(function () {
      console.log('error');
    })
    .always(function () {
      console.log('completo');
    });


}