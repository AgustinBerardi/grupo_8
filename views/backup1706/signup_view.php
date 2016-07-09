<html>
<head>
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
			</div>
			<div id="menu2">
				<?=anchor(site_url().'signup_controller','Registrarse',"class='btnmenu'");?>
				<?=anchor(site_url().'login_controller',utf8_encode('Iniciar Sesión'),"class='btnmenu'");?>
			</div>
		</div>
		<div id="cuerpo">
			<?php
            $username = isset($username)?$username:null;
			$password= isset($password)?$password:null;
			$conf_password= isset($conf_password)?$conf_password:null;
			$email= isset($email)?$email:null;
			$nombre = isset($nombre)?$nombre:null;
			$apellido= isset($apellido)?$apellido:null;
            $pais= isset($paises)?$paises:null;
			$username= array('name' => 'username' , 'placeholder' => 'Nombre de usuario', 'value' => $username);
			$password= array('name' => 'password' , 'placeholder' =>utf8_encode ('Contraseña'),'value'=> $password);
			$conf_password= array('name' => 'conf_password', 'placeholder' => 'Confirmar '. utf8_encode('contraseña'),'value'=> $conf_password);
			$email= array('name' => 'email' , 'placeholder' => 'ejemplo@email.com','value'=> $email);
			$fecha = array('name' => 'fecha', 'placeholder' => 'AAAA-MM-DD');
			$nombre = array('name' => 'nombre' , 'placeholder' => 'Nombre','value'=> $nombre);
			$apellido= array('name' => 'apellido', 'placeholder' => 'Apellido','value'=>$apellido);
			$submit= array('name' => 'submit', 'value' => 'Registrarse!' , 'title' => 'Registrarse!', 'class' => "btn");
			$paises_array=array();
			$paises = $this->signup_model->traer_paises();
			$index=1;
			foreach($paises as $row){
				$paises_array[$index]=($row->nombre);
				$index= $index + 1;
			}
			?>
			<?=form_open(site_url().'signup_controller/add_user');?>
			<p>Nombre de usuario:</p>
			<?=form_input($username);?><br /><err><?=form_error('username')?></err>
			<p>Contrase&ntilde;a</p>
			<?=form_password($password);?><br /><err><?=form_error('password')?></err>
			<p>Confirmar la contrase&ntilde;a</p>
			<?=form_password($conf_password);?><br /><err><?=form_error('conf_password')?></err>
			<p>E-Mail</p>
			<?=form_input($email);?><br /><err><?=form_error('email')?></err>
			<p>Nombre:</p>
			<?=form_input($nombre);?><br /><err><?=form_error('nombre')?></err>
			<p>Apellido</p>
			<?=form_input($apellido);?><br /><err><?=form_error('apellido')?></err>
			<p>Fecha de Nacimiento</p>
			<input type="date" name="fecha" min="1900-01-01" max="1998-06-03" value="1998-06-03" required=”required”><br /><err><?=form_error('fecha')?></err>
			<p>Nacionalidad:</p>
			<?=form_dropdown('paises', $paises_array,$pais);?>
			<br/>
			<p><?=form_submit($submit);?><br /></p>
			<?=form_close()?>
			<err><p><?php 
			if($this->session->flashdata('usuario_existente'))
				echo $this->session->flashdata('usuario_existente'); ?></p></err>
			<err><p><?php
			if($this->session->flashdata('email_existente'))
				echo $this->session->flashdata('email_existente');           
			?></p></err>
			<p><a class="btncomun" href="<?=site_url().'home_controller'?>">Volver atr&aacute;s</a></p>
		</div>
	</div>
	<div id="footer">
		<p><?=utf8_encode('®Couch Inn pertenece a Marcelo Bufartarelo<br>Software desarrollado por ®Pi-Soft')?></p>
	</div>
</body>
</html>