<?php session_start(); ?>
<?php if(isset($_SESSION["id_user"]) && isset($_SESSION["token"])) : ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/participar.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Surfistas Regalones</title>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-T4GCWT9');</script>
        <!-- End Google Tag Manager -->
</head>
<body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T4GCWT9"height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
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
                    <a class="nav-link" href="../assets/terminos.pdf">Términos y condiciones</a>
                </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="card">
                            <img src="../assets/img/surf/title.png" alt="">
                                <div class="center">
                                    <h1 class="white font-w900"> NO. DE FACTURA </h1>
                                    <p> Coloca el código de tu factura, debe contener 12 caracteres y sube una foto de tu factura</p>
                                </div>
                                <br>
                                <form action="" autocomplete="off" id="form-upload">
                                    <div class="container">
                                        <div class="row padding">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" name="invoice" id="invoice" placeholder="No. de factura">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="center">
                                                <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                                                    <input type="file" name="invoice_file" id="invoice_file" class="" style="text-over: ellipsis;width: 100%;">
                                                    <!-- <button class="btn form-control file-upload">File upload</button> -->
                                                    <br><br>
                                                    <button type="button" class="btn btn-warning" id="btn-send">Subir fotografía </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../assets/js/index.js"></script>
    </body>
</html>
    <?php else: ?>
    <?php header("location: ../iniciar") ?>
    <?php endif; ?>

