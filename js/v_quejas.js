$(function(){

  $.validator.setDefaults({          
    errorPlacement: function (error,element) {
    if (element.prop('type') === 'radio') {
       error.insertAfter(element.parent());
       
    }else{
      error.insert(element);
    }
 }
})

  $('#quejas').validate({
        lang: 'es',

        rules: {
            tipo_queja: {required: true },
            nombre: {required: true },
            asunto:{ required: true },
            comentario:{ required: true },
          },
        
          messages : {
            
            comentarios : {
              required : "<p id='required-box'> &nbsp;  Explique brevemente la situacion</p>"
            }
          },

        submitHandler: function(form) {
            event.preventDefault();
            $.post("php/forms.php",$("#quejas").serialize(),function(res){
              if(res == 1){                 
                 var delay = 1000; 
                 var url = 'thankyou.html'
                 setTimeout(function(){ window.location = url; }, delay);
              } else {
              }
             });
            //form.submit();
          }
         
          

    });
});

$(function(){
    $('#descargaCatalogo').validate({
        lang: 'es',

        rules: {
            whatsapp: {required: true},
            demail:{ required: true, email:true },
            dnombre:{ required: true },
            //actualizaciones:{ required: true },
            dterminos: { required: true }
          },

          messages : {

            
            dterminos : {
              required : "<p id='required-box'> &nbsp; Debe aceptar nuestro aviso de privacidad</p>"
            }

            

          },
        


        submitHandler: function(form) {
            event.preventDefault();
            $.post("php/forms.php",$("#descargaCatalogo").serialize(),function(res){
              if(res == 1){
                 /* var delay = 1000; 
                 var url = '../thankyou.html'
                 setTimeout(function(){ window.location = url; }, delay); */
                 donwloadCatalogo();
              } 
             });
            //form.submit();
          }

    });
});


 $('#btn').click(function() {
     my = $("#descargaCatalogo").valid();     
     if ( my == true){
	 console.log(my);
         donwloadCatalogo();
     }else{
        console.log(my);
     }

    });

$(function () {
    $.validator.setDefaults({
       errorPlacement: function (error,element) {
          if (element.prop('type') === 'checkbox') {
             error.insertAfter(element.parent());
          }
       }
    });
});
