
function deletePublication(mostrarPublicationId) {

  $.ajax({
    type: "GET",
    url: baseUrl + 'publicationDelete/' + mostrarPublicationId,

    success: function (response) {
      console.log(response);
    }

  });

}



// let eliminarPublication = document.getElementById('eliminarPublication');

// eliminarPublication.addEventListener('click', (event) => {



// });