/*============================================
  Formatear envío de formulario lado servidor
==============================================*/
function fncFormatInputs(){
    //si el navegador actual soporta la API history.replaceState
    if(window.history.replaceState){
        //sobre el objeto del navegador, que permite interactuar con el historial de la sesión del usuario,
        //reemplazar la entrada en el historial, por la url actual. (borra la entrada anterior del historial de navegación)
        //y recarga la página.
        window.history.replaceState( null, null, window.location.href);
    }
}


/*============================================
  Alerta con el plugin Alert Notie
==============================================*/
//recibe tipo de "alerta" y "texto". time para la duración de la alerta
function fncNotie(type, text){
  //ejecuta el pluggin
  notie.alert({
    type: type,
    text: text,
    time: 5
  })
}


/*============================================
  Alerta con el plugin Sweet Alert
==============================================*/
//recibe tipo de "alerta", "texto" y url de redireccion.
function fncSweetAlert(type, text, url){
  //como el icono y el título varian según type de error y la url es opcional:
  switch (type) {

    case "error":

      //valida si la var url viene vacia
      if (url=="") {

        //ejecuta el plugin
        Swal.fire({
          icon: "error",
          title: "Error",
          text: text
        })

      //pero si la var url tiene contenido
      } else {
        
        //ejecuta el plugin
        Swal.fire({
          icon: "error",
          title: "Error",
          text: text

        }).then((result) => {
          if (result.value) {
            //con _top, la própia url se vuleve a cargar en la mísma página en la que está
            window.open(url, "_top");
          }
        })
      }

    break;

    case "success":

      //valida si la var url viene vacia
      if (url=="") {

        //ejecuta el plugin
        Swal.fire({
          icon: "success",
          title: "Correcto",
          text: text
        })

      //pero si la var url tiene contenido
      } else {
        
        //ejecuta el plugin
        Swal.fire({
          icon: "success",
          title: "Correcto",
          text: text

        }).then((result) => {
          if (result.value) {
            //con _top, la própia url se vuleve a cargar en la mísma página en la que está
            window.open(url, "_top");
          }
        })
      }
    
    break;

    case "loading":
      Swal.fire({
        allowOutsideClick: false,
        icon: 'info',
        text: text
      })
      Swal.showLoading()
    
    break;

    case "confirm":

        return new Promise(resolve=>{

          Swal.fire({
              text: text,
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              cancelButtonText: "No",
              confirmButtonText: "Si, continuar"
          }).then(function(result){
              
              resolve(result.value);

          })
        })

    break;

  }
  
}


/*============================================
  Alerta con el plugin Toastr
==============================================*/
//recibe tipo de "alerta" y "texto". timer duración en miliseg
function fncToastr(type, text){
  
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 6000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: type,
    title: text
  })

}


/*============================================
  Preloader Linear
==============================================*/
//recibe parámetro type.

function fncMatPreloader(type){

  var preloader = new $.materialPreloader({
    position: 'top',
    height: '5px',
    col_1: '#159756',
    col_2: '#da4733',
    col_3: '#3b78e7',
    col_4: '#fdba2c',
    fadeIn: 200,
    fadeOut: 200
  })

  if(type == "on"){

    preloader.on();
  
  }

  if(type == "off"){

    $(".load-bar-container").remove();

  }

}