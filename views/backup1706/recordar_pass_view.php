<?php
    
    header('Content-Type: text/html; charset=ISO-8859-1');

   	$username = array('name' => 'username', 'placeholder' => 'nombre de usuario');
	$submit = array('name' => 'submit', 'value' => 'Cambiar password', 'title' => 'Cambiar password' , 'class' => 'btn');
    
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
			</div>
			<div id="menu2">
				<?=anchor(site_url().'signup_controller','Registrarse',"class='btnmenu'");?>
				<?=anchor(site_url().'login_controller','Iniciar Sesion',"class='btnmenu'");?>
			</div>
		</div>
		<div id="cuerpo">
			<?=form_open(site_url().'login_controller/cambiar_pass');?>
			<p>Nombre de usuario:</p>
			<?=form_input($username)?><err><?=form_error('username')?></err>
			<p>
			<?=form_submit($submit)?></p>
			<p/>
			<?=form_close()?>
			<?php 
			if($this->session->flashdata('usuario_incorrecto')){
				?>
				<p><err><?=$this->session->flashdata('usuario_incorrecto')?></p></err>
				<?php
			}
			?>
			<p>
            <a class="btncomun" href=<?=site_url().'login_controller';?>>Volver atras</a>
			</p>
		</div>
	</div>
	<div id="footer">
		<p>Couch Inn pertenece a Marcelo Bufartarelo<br>Software desarrollado por Pi-Soft</p>
	</div>
</body>
</html>