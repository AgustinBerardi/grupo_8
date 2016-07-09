<p>Reservas:</p>
	<?php foreach ($reservas as $reserva){
		 $usuario=$this->couch_model->traer_usuario($reserva['id_user']);
         echo $usuario['username'] . ' ';
         echo ' Disponible desde: '. $reserva['fecha_inicio']; 
         echo ' hasta: '.$reserva['fecha_inicio'];
         echo ' Email: '.$usuario['email'];
         echo "<br>";
         echo anchor(site_url().'user_controller/aceptar_reserva/'.$reserva['id_couch'],'Aceptar');
		 echo  "<br>";
         echo anchor(site_url().'user_controller/rechazar_reserva/'.$reserva['id_couch'].'/'.$reserva['id_user'],'Rechazar');
    }?>