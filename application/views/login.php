<html lang="es">
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

    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/animate.css">
    <link rel="stylesheet" href="./assets/css/fontawesome.css">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="./assets/css/styles.css">

    <title>CHECKDESK - iniciar sesión</title>
</head>
<body>
    <div class="d-md-flex align-items-center animated fadeIn">
        <div class="col-md-6 col-sm-12 p-0 h-md-100">
            <div class="d-md-flex align-items-center h-md-100 p-3 justify-content-center">
                <div class="loginarea pb-5 animated fadeInDown delay-fast col-md-8">
                    <img src="./assets/img/logo.png"  width="300" class="mb-3 img-fluid">                    
                    <p>Ingresa tu correo electrónico y contraseña para iniciar sesión</p>

                        <?php 
                        $usuario = array(
                            'name' => 'usuario', 
                            'id' => 'inputUsr', 
                            'maxlength' => '120', 
                            'class' => 'form-control',
                            'required' => '',
                            'placeholder' => 'Usuario',
                            'value' => set_value('usuario', @$datos_contacto[0]->usuario)
                        ); 

                        $password = array(
                            'name' => 'password', 
                            'type' => 'password', 
                            'id' => 'inputPwd', 
                            'maxlength' => '60', 
                            'class' => 'form-control',
                            'required' => '',
                            'placeholder' => 'Contraseña'
                        ); 

                        ?>
                        <?php echo(form_open('login')) ?>
                        <div class="form-group inputUsr">
                            <?php echo(form_label('Usuario','usuario')) ?>
                            <?php echo(form_input($usuario)) ?>
                            <small style="color: #dc3545">
                                <?php echo form_error('usuario') ?>
                            </small>
                        </div>
                        <div class="form-group inputPwd">
                            <?php echo(form_label('Contraseña','password')) ?>
                            <?php echo(form_input($password)) ?>
                            <small style="color: #dc3545">
                                <?php echo form_error('password') ?><?php echo form_error('verificar') ?>
                            </small>
                        </div>
                        <?php echo(form_submit('save', 'Iniciar Sesión', ['class' => 'btn btn-success-g w-100'])) ?><br>

                        <?php echo(form_close()) ?>
                        <?php if ($this->input->post() && isset($this->session)): ?>
                            <p style="color: #dc3545"><?php echo $this->session->Mensaje; ?></p>   
                        <?php endif ?>
                    </div>
                </div>         
            </div>
            <div class="col-md-6 d-md-flex d-none p-0 h-md-100 bg-hero" >

            </div>
        </div>


        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/scripts.js"></script>

    </body>
    </html>