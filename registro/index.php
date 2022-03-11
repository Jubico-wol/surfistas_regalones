<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../assets/css/styles.css"> -->
    <link rel="stylesheet" href="../assets/css/register.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Surfistas Regalones</title>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-K8MMVH4');</script>
    <!-- End Google Tag Manager -->
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K8MMVH4" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
   


<nav class="navbar navbar-expand-lg navbar-light transparent">
    <a class="navbar-brand" href="../">
        <img src="../assets/img/surf/logo.png" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="../como-participar/"> ¿Cómo participar?</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="https://snacksyummies.com/Navidad/assets/terminos.pdf">Términos y condiciones</a>
            </li>
            <li class="nav-item">
                <a href="../iniciar/"><button class="btn btn-warning">Login</button></a>
            </li>
        </ul>
    </div>
</nav>


        

        <div class="container">
            <div class="row">
                <div class="col-sm-2 col-md-3"></div>
                    <div class="col-12 col-sm-8 col-md-6">

                        <div class="card">
                            <img src="../assets/img/surf/title.png" alt="">
                            
                                <div class="center">
                                    <h1 class="white font-w900"> REGÍSTRATE </h1>
                                </div>
                                <br>
                                <form name="form-registration" action="" id="form-registration" autocomplete="off">
                               
                                   <div class="container">
                                    <div class="row padding">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                
                                                    <input type="text"  name="name" id="name" class="form-control" placeholder="Nombres" onkeydown="return onKeyDownHandler(event, this.value, 2);">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <input type="text" name="lastname"  id="lastname" class="form-control" placeholder="Apellidos" onkeydown="return onKeyDownHandler(event, this.value,2);">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" name="id" id="id" class="form-control"  placeholder="Identificacion" onkeydown="onKeyDown()">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="email" name="email" id="email"  class="form-control" placeholder="Correo Electronico" onkeydown="onKeyDown()" pattern="">
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <select name="country" id="country" class="form-control" onchange="updateData(this.value)"> 
                                                        <option value="0">País</option>
                                                        <option value="1">Guatemala</option>
                                                        <option value="2">El Salvador</option>
                                                        <option value="3">Honduras</option>
                                                        <option value="4">Nicaragua</option>
                                                        <option value="6">Costa Rica</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                <select name="state" id="state" class="form-control" onchange="onKeyDown()">
                                                    <option value="">Departamento</option>
                                                </select>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="mb-3 in-line">
                                                    <label class="tel-label" id="label-phone">+502</label>
                                                    <input type="number" name="phone" id="phone" class="form-control tel-input"  placeholder="Telefono" onkeydown="onKeyDown()">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                        
                                            <div class="center">
                                            <label id="label-error" class="error"></label>
                                            </div>
                                            
                                               <div class="center">
                                                    <button type="button" class="btn btn-warning" id="btn-register">Regístrate</button>
                                               </div>
                                            </div>

                                            <div class="col-md-12">
                                            <br>
                                               <div class="center">
                                                  <span> ¿Ya tienes una cuenta? <a class="black" href="../iniciar/"> Ingresa aquí </a></span>
                                               </div>

                                               <br>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    <br><br>
                </div>
                <div class="col-sm-2 col-md-3"></div>
            </div>
        </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js" integrity="sha512-6Uv+497AWTmj/6V14BsQioPrm3kgwmK9HYIyWP+vClykX52b0zrDGP7lajZoIY1nNlX4oQuh7zsGjmF7D0VZYA==" crossorigin="anonymous"></script>
    <script src="../assets/js/index.js"></script>
</body>
</html>