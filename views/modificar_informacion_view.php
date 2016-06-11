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
			$email= array('name' => 'email' , 'value' => $email);
			//$fecha = array('name' => 'fecha', 'value' => $fecha);
			$nombre = array('name' => 'nombre' , 'value' => $nombre);
			$apellido= array('name' => 'apellido', 'value' => $apellido);
			$submit= array('name' => 'submit', 'value' => 'Aceptar' , 'title' => 'Aceptar', 'class' => "btn");
			$paises_array=array();
			$paises = $this->signup_model->traer_paises();
			$index=1;
			foreach($paises as $row){
				$paises_array[$index]=$row->nombre;
				$index= $index + 1;
			}
			?>
			<?=form_open(site_url().'comun_controller/cambiar_informacion');?>
			<p>Username</p>
			<?=$username?>
			<p>Tipo de usuario:</p>
            <?php 
            if($this->session->userdata('perfil')=='administrador')
                echo 'Administrador';
            else
                if($this->session->userdata('premium')==1)
                    echo 'Premium';                           
                else{
                    echo 'Comun';
                    echo '<br>';
                    echo anchor('user_controller/ingresar_tarjeta_premium','Hacerse premium',"class='btncomun'");                        
                }
                
            ?>
			<p>Contrase&ntilde;a</p>
			<?=anchor(site_url().'comun_controller/cambiar_password','Cambiar password',"class='btncomun'")?>
			<p>E-Mail</p>
			<?=form_input($email);?><br /><err><?=form_error('email')?></err>
			<p>Nombre:</p>
			<?=form_input($nombre);?><br /><err><?=form_error('nombre')?></err>
			<p>Apellido</p>
			<?=form_input($apellido);?><br /><err><?=form_error('apellido')?></err>
			<p>Fecha de Nacimiento</p>
			<input type="date" name="fecha" min="1900-01-01" max="1998-06-03" value=<?="$fecha"?> required=”required”><br /><err><?=form_error('fecha')?></err>
			<p>Nacionalidad:</p>
			<?=form_dropdown('paises', $paises_array,$pais);?>
			<br/>
			<p><?=form_submit($submit);?><br /></p>
			<err><p><?php
            if($this->session->flashdata('email_existente'))
                echo $this->session->flashdata('email_existente');           
			?></p></err>
			<?php if($this->session->userdata('perfil')!='administrador')
                       echo anchor(site_url().'user_controller/eliminar_cuenta_opciones','Eliminar cuenta',"class='btncomun'");?>
			<p><a class="btncomun" href="<?=site_url().'home_controller'?>">Volver atras</a></p>
		</div>
	</div>
	<div id="footer">
		<p>Couch Inn pertenece a Marcelo Bufartarelo<br>Software desarrollado por Pi-Soft</p>
	</div>
</body>
</html>