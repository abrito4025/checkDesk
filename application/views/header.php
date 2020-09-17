<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-145949972-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-145949972-1');
    </script>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/animate.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/fontawesome.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/styles.css">

    <title><?php echo @$titulo; ?></title>
</head>

<body>
    <div class='overlay'></div>
    <div class="container animated fadeIn">
        <div class="row my-3 justify-content-between">
            <div class="col-md-3">
                <a href="<?php echo base_url() ?>" title="Inicio">
                    <img src="<?php echo base_url() ?>assets/img/logo.png" alt="Instituto Tecnológico Las Américas" width="300" class="img-fluid">
                </a>
            </div>
            <div class="col-md-4">
                <div class="user-card d-flex align-items-center justify-content-end">
                    <div class="user-img">
                        <img src="<?php echo base_url() ?>assets/img/user.png"  class="rounded-circle">
                    </div>
                    <div class="user-name mx-3">
                        <p class="py-0 my-0"><b><?php echo $this->session->userdata['_data']['nombre']; ?></b></p>
                    </div>
                    <div>
                        <a href="<?php echo base_url('login/logout') ?>">
                            <i class="fas fa-power-off fa-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        