<?php

class User_Model extends CI_Model {
        
            
        public function __construct(){
            parent::__construct();            
        }
         
        public function eliminar_cuenta($username){
            $tabla = array('habilitado' => 0);
            $this->db->where('username',$username);
            $this->db->update('user',$tabla);
        }
        
        public function traer_pais($id_pais){
            $query = "SELECT nombre FROM pais WHERE id = '$id_pais'";
            $query_result = $this->db->query($query); 
            $query_result = $query_result->result_array();           
            return ($query_result[0]);            
        }
        
            public function verificar_fechas($fecha_i, $fecha_f, $id_usuario){
                $query = 
                "(SELECT *
                FROM reserva
                WHERE ('$id_usuario'= id_user)  AND DATE('$fecha_i') BETWEEN fecha_inicio AND fecha_fin) 
                UNION
                (SELECT *
                FROM reserva
                WHERE ('$id_usuario'= id_user) AND DATE('$fecha_f') BETWEEN fecha_inicio AND fecha_fin)";
                $query_result = $this->db->query($query);
                if (!( $query_result->num_rows()== 0 )){
                       return FALSE;
                }
                else
                       return TRUE;
        }
        
        
        public function agregar_solicitud_reserva($fecha_inicio, $fecha_fin,$id_couch){
            $id_user= $this->session->userdata("id");
            if($this->no_tiene_reserva($id_couch,$id_user)){
                    $query = "INSERT INTO reserva(fecha_inicio, fecha_fin, id_couch, id_user)
                                        VALUES('$fecha_inicio', '$fecha_fin', '$id_couch', '$id_user')";
                    $this->db->query($query);
            }
            else
                    redirect(site_url().'home_controller/listar_couch');
        }
        
        public function no_tiene_reserva($id_couch){
            $query= "SELECT * FROM reserva WHERE id_couch = $id_couch AND aceptado = 1";
            $query_result= $this->db->query($query);
            return ($query_result->num_rows() === 0); 
        }
        
        public function id_reserva_inactiva($id_couch,$id_user){
            /*
                Dado un ID de couch, devuelve el id de usuario que NO tiene una reserva aceptada. 
            */
            $query = "SELECT id_user
                      FROM reserva
                      WHERE id_couch=$id_couch AND aceptado = 0 AND id_user=$id_user ";
            $query_result = $this->db->query($query);
            if ($query_result->num_rows() > 0){                      
                return TRUE;
            }else{
                return FALSE;
            }
        }
        
        public function user_tiene_reserva($id_couch,$id_user){
            $query = "SELECT id_user
                      FROM reserva
                      WHERE id_couch=$id_couch AND id_user=$id_user ";
            $query_result = $this->db->query($query);
            if ($query_result->num_rows() > 0){                      
                return TRUE;
            }else{
                return FALSE;
            }
            
            
        }
}
?>