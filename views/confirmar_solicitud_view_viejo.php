<?php
    $fecha_inicio= urlencode(base64_encode($fecha_inicio));
    $fecha_fin= urlencode(base64_encode($fecha_fin));
    $id_couch= urlencode(base64_encode($id_couch));
    echo $error;
    echo anchor(site_url().'user_controller/agregar_reserva/'.$fecha_inicio.'/'.$fecha_fin.'/'.$id_couch.'/'.$token,'Aceptar',"class='btn btn-info'");
    echo anchor(site_url().'couch_controller/ver_couch/'.base64_decode(urldecode($id_couch)),'Cancelar',"class='btn btn-info'");


?>
