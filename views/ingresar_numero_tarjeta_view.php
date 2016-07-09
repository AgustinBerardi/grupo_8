<?php
    $codigo = isset($codigo)?$codigo:null;
    $seguridad = isset($seguridad)?$seguridad:null;
    $nombre = isset($nombre)?$nombre:null;
    $apellido = isset($apellido)?$apellido:null;
    $fecha = isset($fecha)?$fecha:null;
   	$codigo = array('name' => 'codigo', 'placeholder' => 'Ingrese su numero de tarjeta','maxlength' => 16, 'value' => $codigo);
    $seguridad =array('name' => 'seguridad', 'placeholder' => 'Ingrese su codigo de seguridad','maxlength' => 3, 'value' =>$seguridad);
    $submit = array('name' => 'submit', 'value' => 'Aceptar', 'title' => 'Aceptar' , 'class' => 'btn');
    $nombre = array('name' => 'nombre', 'placeholder' => 'Nombre del usuario', 'value' => $nombre);
    $apellido = array('name' => 'apellido', 'placeholder' => 'Apellido del usuario', 'value' => $apellido);
    $fecha_vencimiento_tarjeta = array( 'type' => 'date', 'name' => 'fecha', 'required'=> 'required', 'value' => $fecha);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Couch Inn</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url().'CSS/css/bootstrap.min.css'?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=base_url().'CSS/css/business-casual.css'?>" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="brand"><img src="http://localhost/CSS/logoV2.png" alt="COUCH INN" style="width:66%"></div>
    <div class="address-bar">Algun lugar de Buenos Aires</div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="<?=site_url().'home_controller'?>">Couch Inn</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
					<li>
						<?=anchor(site_url().'Home_controller','Inicio',"class='a'");?>
					</li>
					<li>
						<?=anchor(site_url().'home_controller/listar_couch','Couchs',"class='a'");?>
					</li>
					<?php
						if($this->session->userdata('perfil')){
							if($this->session->userdata('perfil')<>'administrador'){
								if($this->session->userdata('premium')<>1){
								   ?> <li><?=anchor(site_url().'user_controller/ingresar_tarjeta_premium','Premium',"class = 'a'")?></li><?php
								}
								?><li><?=anchor(site_url().'user_controller/add_couch','Agregar Couch',"class='a'")?></li>
							<?php }
						else { ?>
							<li><?=anchor('admin_controller/listar','Tipos de couch',"class = 'a'")?></li><?php
						} ?>
							<li><?=anchor(site_url().'user_controller/mi_perfil','Perfil',"class = 'a'")?></li>
							<li><?=anchor(site_url().'login_controller/logout','Cerrar Sesion',"class='a'")?></li><?php
						}
						else {
							?>
							<li><?=anchor(site_url().'signup_controller','Registrarse',"class='a'");?></li>
							<li><?=anchor(site_url().'login_controller','Iniciar Sesion',"class='a'");?></li><?php
						}
						?>
				</ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
					<?=form_open(site_url().'user_controller/cambiar_premium');?>
					<p>Nombre:</p>
					<?=form_input($nombre)?><err><?=form_error('nombre')?></err>
					<p>Apellido:</p>
					<?=form_input($apellido)?><err><?=form_error('apellido')?></err>
					<p>Fecha de vencimiento de la tarjeta:</p>
					<?=form_input($fecha_vencimiento_tarjeta)?><err><?=form_error('fecha_venicimiento_tarjeta')?></err>
					<p>Numero de tarjeta:</p>
					<?=form_input($codigo)?><err><?=form_error('codigo')?></err>
					<p>Codigo de seguridad:</p>
					<?=form_input($seguridad)?><err><?=form_error('seguridad')?></err>
					<p>
					<?=form_submit($submit)?>
					<p/>
					<?=form_close()?>
					<a class="btn btn-info" href=<?=site_url().'user_controller/mi_perfil';?>>Volver atras</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>&copy;Couch Inn<br>Desarrollado por &copy;Pi-Soft</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="<?=base_url().'CSS/js/jquery.js'?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url().'CSS/js/bootstrap.min.js'?>"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>