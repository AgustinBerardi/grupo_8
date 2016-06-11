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
    <?php
        $old_password =array('name' => 'old_password' , 'placeholder' => 'Su antigua contraseña');
        $new_password= array('name' => 'new_password' , 'placeholder' => 'Su nueva contraseña');
        $conf_password= array('name' => 'conf_password', 'placeholder' => 'Confirmar contraseña');
        $submit= array('name' => 'submit', 'value' => 'Aceptar!' , 'title' => 'Aceptar!', 'class' => "btncomun");

    
    ?>
    <?=form_open(site_url().'comun_controller/verificar_cambio_password');?>
        <p>Antigua contrase&ntilde;a</p>
        <?=form_password($old_password);?><br /><err><?=form_error('old_password')?></err>
        <p>Nueva contrase&ntilde;a</p>
        <?=form_password($new_password);?><br /><err><?=form_error('new_password')?></err>
        <p>Confirmar la nueva contrase&ntilde;a</p>
        <?=form_password($conf_password);?><br /><err><?=form_error('conf_password')?></err>
        <p><?=form_submit($submit);?><br /></p>
         
        <p><a class="btncomun" href="<?=site_url().'comun_controller/modificar_informacion'?>">Volver atras</a></p>
</div>
</div>
<div id="footer">
<p>Couch Inn pertenece a Marcelo Bufartarelo<br>Software desarrollado por Pi-Soft</p>
</div>
</body>
