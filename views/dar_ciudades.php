<?php

            if(!empty($_POST["provincia_id"])) {
        	$query ="SELECT * FROM ciudad WHERE provincia_id = '" . $_POST["provincia_id"] . "'";
        	$results = $this->couch_model->runQuery($query);
            ?>
        	<option value="">Elegir ciudad</option>
<?php
            	foreach($results as $ciudad) {
?>
	<option value="<?php echo $ciudad['id']; ?>"><?php echo $ciudad["ciudad_nombre"]; ?></option>
<?php

    }
}
?>