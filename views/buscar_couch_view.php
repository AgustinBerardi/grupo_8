<?php       
            require_once("dbcontroller.php");
            $db_handle = new DBController();
            $query = "SELECT * FROM tipo_couch";
            $resultado_tipo_couch = $this->couch_model->runQuery($query);
            $titulo = isset($titulo)?$titulo:null;
			$fecha_inicio= isset($fecha_inicio)?$fecha_inicio:null;
			$fecha_fin= isset($fecha_fin)?$fecha_fin:null;
			$descripcion= isset($descripcion)?$descripcion:null;
            $localidad = isset($ciudad)?$ciudad:-1;
            $tipo = isset($tipo)?$tipo:"";
            $titulo_parametro = $titulo;
			$titulo= array('name' => 'titulo' , 'placeholder' => 'Titulo del couch', 'value' => $titulo);
			$submit= array('name' => 'submit', 'value' => 'Buscar couch' , 'title' => 'Buscar couch');
            $id_provincia= -1;
            if($localidad !== -1){
                $query ="SELECT provincia_nombre FROM provincia";
                $results = $db_handle->runQuery($query);
                $index=1;
                			foreach($results as $row){
                				$provincia[$index]=$row['provincia_nombre'];
                				$index= $index + 1;
                			}
                $query = "SELECT provincia_id FROM ciudad WHERE id = '$localidad'";
                $id_provincia= $db_handle->runQuery($query);
                $id_provincia = $id_provincia[0]['provincia_id'];
            }
           
            
 ?>   


<?php
$query ="SELECT * FROM provincia";
$results = $db_handle->runQuery($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Couch Inn</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url().'CSS/css/bootstrap.min.css'?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=base_url().'CSS/css/business-casual.css'?>" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
function getState(val) {
	$.ajax({
	type: "POST",
	url: "http://localhost/get_state.php",
	data:'provincia_id='+val,
	success: function(data){
		$("#lista-ciudad").html(data);
	}
	});
}

function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
</head>

<body>

    <div class="brand"><img src="http://localhost/CSS/logoV2.png" alt="COUCH INN" style="width:66%"></div>
    <div class="address-bar">Algun lugar de Buenos Aires</div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="<?=site_url().'home_controller'?>">Couch Inn</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
					<li>
						<?=anchor(site_url().'Home_controller','Inicio',"class='a'");?>
					</li>
					<li>
						<?=anchor(site_url().'home_controller/listar_couch','Couchs',"class='a'");?>
					</li>
					<?php
						if($this->session->userdata('perfil')){
							if($this->session->userdata('perfil')<>'administrador'){
								if($this->session->userdata('premium')<>1){
								   ?> <li><?=anchor(site_url().'user_controller/ingresar_tarjeta_premium','Premium',"class = 'a'")?></li><?php
								}
								?><li><?=anchor(site_url().'user_controller/add_couch','Agregar Couch',"class='a'")?></li>
							<?php }
						else { ?>
							<li><?=anchor('admin_controller/listar','Tipos de couch',"class = 'a'")?></li><?php
						} ?>
							<li><?=anchor(site_url().'user_controller/mi_perfil','Perfil',"class = 'a'")?></li>
							<li><?=anchor(site_url().'login_controller/logout','Cerrar Sesion',"class='a'")?></li><?php
						}
						else {
							?>
							<li><?=anchor(site_url().'signup_controller','Registrarse',"class='a'");?></li>
							<li><?=anchor(site_url().'login_controller','Iniciar Sesion',"class='a'");?></li><?php
						}
						?>
				</ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">
		<div class="row">
            <div class="box">
                <div class="col-lg-12">
					<?=form_open(site_url().'couch_controller/buscar_couch');?>
                    
			<label>Titulo de couch:</label><br />
			<?=form_input($titulo);?><br /><err><?=form_error('titulo')?></err>
             <br />
            <label>Tipo Couch:</label><br/>
            <select name="tipo" id="lista-tipo_couch" class="demoInputBox">
            <option value="">Elegir Tipo Couch</option>
            <?php
            foreach($resultado_tipo_couch as $tipo_couch) {
            ?>
            <option value="<?=$tipo_couch["id"]; ?>"<?php if($tipo_couch["id"]==$tipo) echo "selected=\"selected\""; ?> ><?=$tipo_couch["nombre_couch"]; ?></option>
            <?php
            } 
            ?></select><br /><br />
            <label>Provincia:</label><br/>
            <select name="provincia" id="lista-provincia" class="demoInputBox"  onchange="getState(this.value);" > <err><?=form_error('provincia')?></err>
                <option value="">Elegir provincia</option>
                <?php
                        foreach($results as $prov) {
                ?>
                <option value="<?php echo $prov["id"]; ?>"<?php if($prov["id"]==$id_provincia) echo "selected=\"selected\""; ?> ><?php echo $prov["provincia_nombre"]; ?></option>
                <?php
                }
                ?>
            </select>
            <br />
            <br />
            <label>Ciudad:</label><br/>
            <?php if($localidad == -1){?>
            <select name="ciudad" id="lista-ciudad" class="demoInputBox">
                <option value="">Elegir ciudad</option>
            </select>  
            <?php }else { ?> <?php
            	$query ="SELECT * FROM ciudad WHERE provincia_id = $id_provincia";
            	$results = $db_handle->runQuery($query);
            ?>
              <select name="ciudad" id="lista-ciudad" class="demoInputBox">
                <option value="">Elegir ciudad</option>
            <?php
            	foreach($results as $ciudad) {
            ?>
            	<option value="<?php echo $ciudad["id"]; ?>" <?php if($ciudad["id"]==$localidad) echo "selected=\"selected\""; ?>><?php echo $ciudad["ciudad_nombre"]; ?></option>
            <?php
            	}
            ?> <?php } ?> </select>  
            <br />
            <br />
			<label>Fecha inicio:</label><br />
			<input type="date" name="fecha inicio"  max="2020-01-01" value=<?=$fecha_inicio?>><br /><err><?=form_error('fecha_inicio')?></err>
			 <br />
            <label>Fecha fin:</label><br />
	       	 <input type="date" name="fecha fin"  max="2020-01-01" value=<?=$fecha_fin?>><br /><err><?=form_error('fecha_fin')?></err>
             <br />
            <br />
            <p><?=form_submit($submit);?></p><br />
            <?=form_close()?>     
            
            <?php
                     $couchs = $this->couch_model->buscar_couch($tipo,$id_provincia,$localidad,$titulo_parametro,$fecha_inicio,$fecha_fin);
					   foreach ($couchs as $couch){
							 if( $couch['alta'] == 1 && $couch['publicado'] == 1){
    							$premium =  $this->couch_model->traer_campo('premium',$couch['usuario'],'user');
    							$tipo = $this->couch_model->traer_campo('nombre_couch',$couch['tipo'],'tipo_couch');
    							?>
    							<div class="col-lg-12">
    							<br>
    							<div class="col-lg-2">
    							<?php if($premium['premium']){?>
    								<img src="<?=base_url()."CodeIgniter-2.2.6/uploads/".$couch['foto']?>" width=155px height=155px/> <?php
    							}else{?><img src="<?=base_url()."CodeIgniter-2.2.6/uploads/couchinn/sillon.jpg"?>" width=155px height=155px/> <?php
    							}?>
    							</div>
    							<div class="col-lg-10">
    							<p>
    							<?php
    							echo 'Titulo:'.anchor(site_url()."couch_controller/ver_couch/".$couch['id'],$couch['nombre_couch']); 
    							echo '<br>';
    							echo 'Tipo: '.$tipo['nombre_couch'].'.';
    							echo '<br>'.'Desde: '. $couch['fecha_inicio']. '<br>Hasta: '. $couch['fecha_fin'];
    							echo '<br>';
    							?>
    							</p>
								<br>
								<br>
    							</div>
    							</div>
    							<?php
                            }
						} 

					?>
            <?=anchor(site_url().'home_controller/listar_couch','Volver atras','class="btn btn-info"')?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>&copy;Couch Inn<br>Desarrollado por &copy;Pi-Soft</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="<?=base_url().'CSS/js/jquery.js'?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url().'CSS/js/bootstrap.min.js'?>"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>