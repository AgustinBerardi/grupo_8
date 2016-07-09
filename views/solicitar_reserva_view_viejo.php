<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="www.intercambiosvirtuales.org" />

	<title>Sin título 3</title>
</head>

<body>      
        <?php
            $fecha_actual= date('Y-m-d');
            $couch = 	$this->couch_model->traer_campo('*',$id,'couch_couch');
            $fecha_inicio= $couch['fecha_inicio'];
            $submit= array('name' => 'submit', 'value' => 'Reservar' , 'title' => 'Reservar');
         ?>
        <?=form_open(site_url().'user_controller/verificar_informacion_reserva/'.$id);?>
        <p>Fecha inicio:</p>
        <input type="date" name="fecha inicio" min="<?=$couch['fecha_inicio']?>" max="<?=$couch['fecha_fin']?>" required="required" value="<?=$fecha_inicio?>"><br /><err><?=form_error('fecha_inicio')?></err>
	   	<p>Fecha fin:</p>
    	<input type="date" name="fecha fin" min="<?=$couch['fecha_inicio']?>" max="<?=$couch['fecha_fin']?>" required="required"value=<?=$couch['fecha_fin']?>><br /><err><?=form_error('fecha_fin')?></err><br />
        <p><?=form_submit($submit);?></p><br />
        
</body>
</html>