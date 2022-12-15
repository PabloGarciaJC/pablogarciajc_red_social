
function formComments(idPublicationForm){

  let imagenPublicacion = document.getElementById('imagenPublicacion' + idPublicationForm);
  let comentarioPublicacion = document.getElementById('comentarioPublicacion' + idPublicationForm);

  console.log(imagenPublicacion);
  console.log(comentarioPublicacion );

  let urlAjaxCommentsForm = baseUrl + 'comentarioSave/';


}

function ajaxCommenForm(urlAjaxCommentsForm ){

  $.ajax({
    type: "POST",
    url: urlAjaxCommentsForm,
    data: {imagenPublicacion: imagenPublicacion},
    
    success: function (response) {
      
    }
  });
}