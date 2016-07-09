<?php
    $codigo = isset($codigo)?$codigo:null;
    $seguridad= isset($seguridad)?$seguridad:null;
    $nombre= isset($nombre)?$nombre:null;
    $apellido= isset($apellido)?$apellido:null;
    $fecha_vencimiento_tarjeta = isset($fecha_vencimiento_tarjeta)?$fecha_vencimiento_tarjeta:null;
    
   	$codigo = array('name' => 'codigo', 'placeholder' => 'Ingrese su numero de tarjeta','maxlength' => 16, 'value' => $codigo);
    $seguridad =array('name' => 'seguridad', 'placeholder' => 'Ingrese su codigo de seguridad','maxlength' => 3, 'value' => $seguridad);
    $submit = array('name' => 'submit', 'value' => 'Aceptar', 'title' => 'Aceptar' , 'class' => 'btn');
    $nombre = array('name' => 'nombre', 'placeholder' => 'Nombre del usuario', 'value' => $nombre);
    $apellido = array('name' => 'apellido', 'placeholder' => 'Apellido del usuario', 'value' => $apellido  );
    $fecha_vencimiento_tarjeta = array( 'type' => 'date', 'name' => 'fecha', 'required'=> 'required', 'value' => $fecha_vencimiento_tarjeta);
	
?>



<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>CSS/prueba.css"/>
</head>
<body>
    <div id="wrapper">
		<div id="header">
            <h1><img src="http://localhost/CSS/logo.png" alt="COUCHINN" style="width:33%"></h1>
		</div>
		<div id="menu">
            <div id="menu1">
				<?=anchor(site_url().'Home_controller','Inicio',"class='btnmenu'");?>
				<?php 
				if($this->session->userdata('perfil')<>'administrador')
					if($this->session->userdata('premium')<>1)
						echo anchor('user_controller/ingresar_tarjeta_premium','Hacerse premium',"class='btnmenu'"); 
				?>
			</div>
			<div id="menu2">
				<?=anchor(site_url().'comun_controller/modificar_informacion','Modificar Informacion',"class = 'btnmenu'");?>
				<?=anchor(site_url().'login_controller/logout','Cerrar sesion',"class = 'btnmenu'");?>
			</div>
		</div>
		<div id="cuerpo">
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
			<a class="btncomun" href=<?=site_url().'user_controller';?>>Volver atras</a>
		</div>
	</div>
	<div id="footer">
		<p>Couch Inn pertenece a Marcelo Bufartarelo<br>Software desarrollado por Pi-Soft</p>
	</div>
</body>
</html>