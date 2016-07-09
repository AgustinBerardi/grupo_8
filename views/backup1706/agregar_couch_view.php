<html>
<head>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
function getState(val) {
	$.ajax({
	type: "POST",
	url: "get_states.php",
	data:'provincia_id='+val,
	success: function(data){
		$("#state-list").html(data);
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
<?php    
            $query ="SELECT * FROM provincia";
            $results = $this->couch_model->runQuery($query);
            
            $query = "SELECT * FROM tipo_couch";
            $resultado_tipo_couch = $this->couch_model->runQuery($query);

            $nombre_couch = isset($nombre_couch)?$nombre_couch:null;
			$fecha_inicio= isset($fecha_inicio)?$fecha_inicio:null;
			$fecha_fin= isset($fecha_fin)?$fecha_fin:null;
			$descripcion= isset($descripcion)?$descripcion:null;
			$foto = isset($foto)?$foto:null;
			$localidad= isset($localidad)?$localidad:null;
            $usuario= isset($usuario)?$usuario:null;
            $tipo= isset($tipo)?$tipo:null;
			$nombre_couch= array('name' => 'Titulo' , 'placeholder' => 'Nombre del Couch', 'value' => $nombre_couch);
			$fecha_inicio= array('name' => 'Fecha inicio Couch','value' => $fecha_inicio);
			$fecha_fin= array('name' => 'Fecha Fin Couch', 'value'=> $fecha_fin);
			$descripcion= array('name' => 'descripcion' , 'placeholder' => 'Breve descripcion del couch','value'=> $descripcion);
			$foto = array('name' => 'foto', 'placeholder' => 'Insertar foto');
			$tipo= array('name' => 'Tipo de couch', 'placeholder' => 'Seleccionar couch correspondiente','value'=>$tipo);
			$submit= array('name' => 'submit', 'value' => 'Agregar couch' , 'title' => 'Agregar couch', 'class' => "btn");
            $localidades = $this->couch_model->traer_localidades();
 ?>   
            
            <p>Titulo de couch:</p>
			<?=form_input($nombre_couch);?><br /><err><?=form_error('nombre_couch')?></err>
			<p>Fecha inicio:</p>
			<input type="date" name="fecha inicio" min="1900-01-01" max="2020-01-01" required=”required”><br /><err><?=form_error('fecha_inicio')?></err>
			<p>Fecha fin:</p>
	       	<input type="date" name="fecha fin" min="1900-01-01" max="2020-01-01" required=”required”><br /><err><?=form_error('fecha_fin')?></err>
            
            
            <div class="frmDronpDown">
            <div class="row"><br />
            <label>Provincia:</label><br/>
            <select name="country" id="country-list" class="demoInputBox" onChange="getState(this.value);">
            <option value="">Elegir provincia</option> 
            <?php
            foreach($results as $provincia) {
            ?>
            <option value="<?php echo $provincia["id"]; ?>"><?php echo $provincia["provincia_nombre"]; ?></option>
            <?php
            } 
            ?>
            
            </select>
            </div>
            <div class="row"><br />
            <label>Ciudad:</label><br/>
            <select name="state" id="state-list" class="demoInputBox">
            <option value="">Elegir ciudad</option>
            </select>
            </div>
            </div>
            
            <p>Descripcion:</p>
			<textarea rows="4" name="descripcion" cols="40"></textarea><br /><err><?=form_error('apellido')?></err>
			<br/>
			
            
            <div class="frmDronpDown">
            <div class="row"><br />
            <label>Tipo Couch:</label><br/>
            <select name="country" id="country-list" class="demoInputBox" onChange="getState(this.value);">
            <option value="">Elegir Tipo Couch</option>
            <?php
            foreach($resultado_tipo_couch as $tipo_couch) {
            ?>
            <option value="<?php echo $tipo_couch["id"]; ?>"><?php echo $tipo_couch["nombre_couch"]; ?></option>
            <?php
            } 
            ?>
            
            
            <p><?=form_submit($submit);?><br /></p>        
</body>
</html>
