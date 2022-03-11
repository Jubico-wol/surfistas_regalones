let label_error = false;
let codigos = { "1" :"+502", "2" :"+503", "3" :"+504", "4" :"+505", "6" :"+506" }
let pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/



function ValidateEmail(x) 
{

    let name = $("#name").val();
    let lastname = $("#lastname").val();
    let state = $("#state option:selected").val();
    let id = $("#id").val();
    let email = $("#email").val();
    let phone = $("#phone").val();


    if (typeof x == 'undefined') { x = ''; }
    else{ 
        var matches = x.match(pattern);

        if(matches == null){
             $("#label-error").html("EL CORREO ES INCORRECTO");
            label_error = true;
        }  
        
        else{

            let data = new FormData();
            data.append('name', name);
            data.append('lastname', lastname);
            data.append('id', id);
            data.append('email', email);
            data.append('phone', phone);
            data.append('state', state);
            fetch('../assets/php/register.php', {
                method: 'POST',
                body: data,
            })
            .then( response => response.json())
            .then( res => {
                if(res.status == "200"){
                    Swal.fire({
                        icon: 'success',
                        title: 'REGISTRO REALIZADO',
                        text: '',
                        showConfirmButton: false,
                        timer: 3000
                    }).then( () => {
                        $("#form-registration")[0].reset();
                        window.location = "../participar";
                    }); 
                }else{
                    Swal.fire({
                        icon: 'warning',
                        title: 'Error al guardar',
                        text: res.error,
                        showConfirmButton: false,
                        timer: 3000
                    }); 
                }
            })
            .catch( error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text:  error,
                    showConfirmButton: false,
                    timer: 3000
                }); 
            }); 

        }
        return true;
    }

}


// registro

$("#btn-register").on("click",function(){

    let email = $("#email").val();
    let name = $("#name").val();
    let lastname = $("#lastname").val();
    let state = $("#state option:selected").val();
    let id = $("#id").val();
    let phone = $("#phone").val();

    if(name.length == 0){
        $("#label-error").html("EL NOMBRE ES REQUERIDO");
        label_error = true;
    }else if(lastname.length == 0){
        $("#label-error").html("EL APELLIDO ES REQUERIDO");
        label_error = true;
    }else if(state == "" || state == "0" ){
        $("#label-error").html("SELECCIONE UN DEPARTAMENTO");
        label_error = true;
    }else if(id.length == 0){
        $("#label-error").html("LA IDENTIFICACIÓN ES REQUERIDA");
        label_error = true;
    }else if(phone.length == 0){
        $("#label-error").html("EL TELÉFONO ES REQUERIDO");
        label_error = true;
    }
    else if(email.length == 0){
        $("#label-error").html("EL CORREO ES REQUERIDO");
        label_error = true;
    }else if(!ValidateEmail(email)){}
   
});


$("#btn-login").on("click",function(){
    
    let id = $("#id").val();
    let email = $("#email").val();
    let data = new FormData();
    data.append('id', id);
    data.append('email', email);
    fetch('../assets/php/login.php', {
        method: 'POST',
        body: data,
    })
    .then( response => response.json())
    .then( res => {
        if(res.status == "200"){
            if(res.msg){
                Swal.fire({
                    icon: 'warning',
                    title: res.msg,
                    text: '',
                    showConfirmButton: true
                }); 
            }else{
                Swal.fire({
                    icon: 'success',
                    title: 'Sesión iniciada',
                    text: '',
                    showConfirmButton: false,
                    timer: 3000
                }).then( () => {
                    window.location = "../participar";
                }); 
            }
            
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Error al iniciar sesión',
                text: res.error,
                showConfirmButton: false,
                timer: 3000
            }); 
        }
    })
    .catch( error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text:  error,
            showConfirmButton: false,
            timer: 3000
        }); 
    });  

    // if(name.length == 0){
    //     $("#label-error").html("El nombre es requerido");
    // }else if(lastname.length == 0){
    //     $("#label-error").html("El apellido es requerido");
    // }
});





$("#btn-send").on("click",function(){
    
    let invoice = $("#invoice").val();
    let inputFileImage = document.getElementById("invoice_file");
    let file = inputFileImage.files[0];
    if(file === undefined){
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text:  'Seleccione una imagen',
            showConfirmButton: false,
            timer: 3000
        }); 
    }else{
        if (/^image/.test( file.type)){
            let data = new FormData();
            data.append('invoice', invoice);
            data.append('fileToUpload', file);
            Swal.fire({
                title: 'Por favor espere',
                html: 'Cargando foto',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                },
            });
            fetch('../assets/php/upload_file.php', {
                method: 'POST',
                body: data,
            })
            .then( response => response.json())
            .then( res => {
                if(res.status == "200"){
                    Swal.fire({
                        icon: 'success',
                        title: 'Archivo subido',
                        text: '',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(() => {
                        $("#form-upload")[0].reset();
                         window.location = "../participando";
                    }); 
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al subir archivo',
                        text: res.error,
                        showConfirmButton: false,
                        timer: 3000
                    }); 
                }
            })
            .catch( error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text:  error,
                    showConfirmButton: false,
                    timer: 3000
                }); 
            });  
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text:  'Solo imagenes permitidas',
                showConfirmButton: false,
                timer: 3000
            }); 
        }
    }

});

function cleanLabel(){
    $("#label-error").html("");
    label_error = false;
}

function updateData(id_pais){

    let data = new FormData();
    data.append('id_pais', id_pais);

    fetch('../assets/php/get_data.php', {
        method: 'POST',
        body: data,
    })
    .then( response => response.json())
    .then( res => {
        $("#state").html(res.data);
        $("#label-phone").html(codigos[id_pais]);
    });

}

function onKeyDownHandler(event, value, option) {
    if(label_error)cleanLabel();
    let codigo = event.which || event.keyCode;
    if(option == 1){
        return ((codigo === 9) || (codigo === 8) || (codigo === 32)|| (codigo === 37) || (codigo === 39) || ( (codigo >= 48 && codigo <= 57)));
    }else if(option == 2){
        return ((codigo === 9) || (codigo === 8) || (codigo === 32) || (codigo === 37) || (codigo === 39) || ( (codigo >= 65 && codigo <= 90)) || ( (codigo >= 97 && codigo <= 122)));
    }    
}

function onKeyDown(){
    if(label_error)cleanLabel();
}



$('.file-upload').on('click', function(e) {
    e.preventDefault();
    $('#invoice_file').trigger('click');
  });