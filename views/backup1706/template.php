<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?=base_url().'CSS/prueba.css'?>"/>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
                <h1><img src="http://localhost/CSS/logo.png" alt="COUCHINN" style="width:33%"></h1>
			</div>
			<div id="menu"><?=anchor(site_url().'Home_controller','Inicio',"class='btnmenu'");?>
                <?=anchor(site_url().'Home_controller','Inicio',"class='btnmenu'");?>
			</div>
			<div id="cuerpo">
			</div>
		</div>
		<div id="footer">
        <p>Couch Inn pertenece a Marcelo Bufartarelo<br>Software desarrollado por Pi-Soft</p>
		</div>
	</body>
</html>