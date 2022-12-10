
function deletePublication(mostrarPublicationId) {

  $.ajax({
    type: "GET",
    url: baseUrl + 'publicationDelete/' + mostrarPublicationId,

    success: function (response) {


        let responsePublication = document.getElementById('responsePublication');


        if(response == 0){

          responsePublication.className = "alert alert-primary";

        }else{
          
          responsePublication.className = 'alert alert-success';

        }
    

     

    }

  });

}



// let eliminarPublication = document.getElementById('eliminarPublication');

// eliminarPublication.addEventListener('click', (event) => {



// });