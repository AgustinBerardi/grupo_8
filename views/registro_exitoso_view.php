<html>
<head>
<link rel="stylesheet" type="text/css" href="<?=base_url().'CSS/prueba.css'?>"/>
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
			<h2>Registro Exitoso</h2>
			<p>
			<?=anchor(site_url().'home_controller','Volver a pagina principal',"class='btnmenu'")?></center>
			</p>
		</div>
	</div>
	<div id="footer">
    	<p>Couch Inn pertenece a Marcelo Bufartarelo<br>Software desarrollado por Pi-Soft</p>
	</div>
</body>
</html>