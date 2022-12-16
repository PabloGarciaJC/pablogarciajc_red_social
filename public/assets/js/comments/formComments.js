
function formComments(idPublicationForm) {

  let imagenPublication = document.getElementById('imagenPublicacion' + idPublicationForm);
  let comentarioPublication = document.getElementById('comentarioPublicacion' + idPublicationForm);

  let urlAjaxCommentsForm = baseUrl + 'comentarioSave';

  ajaxCommenForm(urlAjaxCommentsForm, imagenPublication, comentarioPublication,idPublicationForm);


  
}

function ajaxCommenForm(urlAjaxCommentsForm, imagenPublication, comentarioPublication,idPublicationForm) {

  $.ajax({
    type: "POST",
    url: 'http://127.0.0.1:8000/comentarioSave',
    data: {
      "_token": $("meta[name='csrf-token']").attr("content"),
      comentPublication: comentarioPublication,      
      idPublication: idPublicationForm,
    },
  })
    .done(function (respuestaPeticion) {

      console.log(respuestaPeticion);

    })
    .fail(function () {
      console.log('error');
    })
    .always(function () {
      console.log('completo');
    });


}