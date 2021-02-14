$(document).ready(function(){
    ClassicEditor
    .create( document.querySelector( '#textarea' ) )
    .catch( error => {
        console.error( error );
    })
})