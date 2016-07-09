<?php
        foreach ($couchs as $couch){
        $premium =  $this->couch_model->traer_campo('premium',$couch['usuario'],'user');
        $tipo = $this->couch_model->traer_campo('nombre_couch',$couch['tipo'],'tipo_couch');
        if($premium){?>
            <img src="<?=base_url()."CodeIgniter-2.2.6/uploads/".$couch['foto']?>" width=256px height=256px/> <?php
        }
        echo '<br>';
        echo 'Titulo:'.anchor(site_url()."couch_controller/ver_couch/".$couch['id'],$couch['nombre_couch']); 
        echo '<br>';
        echo 'Tipo'.$tipo['nombre_couch'].'<br>';
        echo 'Disponibilidad:'. $couch['fecha_inicio']. ' hasta '. $couch['fecha_fin'];
        echo '<br>';      
    } 

?>