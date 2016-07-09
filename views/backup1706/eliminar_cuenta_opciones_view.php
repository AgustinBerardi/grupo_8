<?php
    header('Content-Type: text/html; charset=ISO-8859-1');  
?>
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
			<h2><center>Esta a punto de eliminar su cuenta esta seguro?
		<br /> <?=anchor(site_url().'user_controller/eliminar_cuenta','Borrar cuenta',"class = 'btncomun'");?>
                <?=anchor(site_url().'comun_controller/modificar_informacion','Cancelar',"class = 'btncomun'");?>
		          </h2></center> 
		</div>
	</div>
	<div id="footer">
		<p>Couch Inn pertenece a Marcelo Bufartarelo<br>Software desarrollado por Pi-Soft</p>
	</div>
</body>


</html>