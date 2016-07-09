<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>CSS/prueba.css"/>
<?php
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />

<?php endforeach; ?>
<?php foreach($js_files as $file): ?>

	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
	color: blue;
	text-decoration: none;
	font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>
</head>
<body>
    <div id="wrapper">
<div id="header">
<h1><img src="http://localhost/CSS/logo.png" alt="COUCHINN" style="width:33%"></h1>
</div>
<div id="menu">
	<div id="menu1">
				<?=anchor(site_url().'Home_controller','Inicio',"class='btnmenu'");?>
				<?=anchor(site_url().'admin_controller/listar','Administrar tipos de couchs',"class ='btnmenu'");?>
	</div>
			<div id="menu2">
				<?=anchor(site_url().'comun_controller/modificar_informacion','Modificar Informacion',"class = 'btnmenu'");?>
				<?=anchor(site_url().'login_controller/logout','Cerrar sesion',"class = 'btnmenu'");?>
			</div>
</div>
<div id="cuerpo">
	<div style='height:20px;'></div>
	<div>
		<?php echo $output; ?>

	</div>
<!-- Beginning footer -->
<p>
<div><?=anchor(site_url().'admin_controller','Volver Atras',"class='btncomun'");?></div>
</p>
</div>
</div>
<div id="footer">
<p>®Couch Inn pertenece a Marcelo Bufartarelo<br>®Software desarrollado por Pi-Soft</p>
</div>
<!-- End of Footer -->
</body>
</html>