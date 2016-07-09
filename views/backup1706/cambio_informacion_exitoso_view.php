<html>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>CSS/prueba.css"/>
</head>
<title>Bienvenido</title>
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
			<h2>Informacion cambiada correctamente
			<?= $this->session->userdata('username');?><br /></h2>
			<center> <?=anchor(site_url().'home_controller','Volver al home',"class = 'btncomun'");?></center>
		</div>
	</div>
	<div id="footer">
        <p>Couch Inn pertenece a Marcelo Bufartarelo<br>Software desarrollado por Pi-Soft</p>
	</div>
</body>


</html>