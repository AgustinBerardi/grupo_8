<?php

class Couch_Model extends CI_Model {
        
        public function __construct(){
            parent::__construct();            
        }
        
        public function add_couch($couch,$data){
            $titulo = $couch['titulo'];
            $fecha_inicio = $couch['fecha_inicio'];  
            $fecha_fin = $couch['fecha_fin'];
            $descripcion = $couch['descripcion'];
            $ciudad= $couch['ciudad'];
            $foto= $data['file_name'];
            $usuario = $this->session->userdata('id');
            $tipo = $couch['tipo'];
            $query = "INSERT INTO couch_couch(nombre_couch, fecha_inicio, fecha_fin, localidad, descripcion,foto,usuario, tipo)
                                      VALUES              ('$titulo', '$fecha_inicio','$fecha_fin','$ciudad','$descripcion','$foto','$usuario','$tipo')";
            $this->db->query($query);
        }
        
        public function editar_couch($couch,$id_couch,$foto){
            $titulo = $couch['titulo'];
            $fecha_inicio = $couch['fecha_inicio'];  
            $fecha_fin = $couch['fecha_fin'];
            $descripcion = $couch['descripcion'];
            $ciudad= $couch['ciudad'];
            $usuario = $this->session->userdata('id');
            $tipo = $couch['tipo'];
            $query = "UPDATE couch_couch
                      SET nombre_couch = '$titulo', fecha_inicio = '$fecha_inicio' , fecha_fin='$fecha_fin', localidad='$ciudad', descripcion='$descripcion',foto='$foto',usuario='$usuario', tipo='$tipo'
                      WHERE id = '$id_couch'";            
            $this->db->query($query);
        }
        
        
        public function traer_localidades (){
            $query = "SELECT ciudad_nombre
                      FROM ciudad";
            $query_result= $this->db->query($query);
            return $query_result->result();            
        }
	
    	function runQuery($query) {
    		$query = $this->db->query($query);
            foreach ($query->result_array() as $row)
            {
                $resultset[] = $row;
            }
    		if(!empty($resultset))
    			return $resultset;
    	}
    	
    	function numRows($query) {
    		$result  = mysqli_query($query);
    		$rowcount = mysqli_num_rows($result);
    		return $rowcount;	
    	}
        function traer_couchs_listado(){
            $query = "SELECT * FROM couch_couch";
            $query_result = $this->db->query($query);            
            return $query_result->result_array();         
        }
        
        function traer_couchs($id_user){
            $query = "SELECT * FROM couch_couch WHERE usuario = '$id_user'";
            $query_result = $this->db->query($query);            
            return $query_result->result_array();
        }
        
        function traer_couch($id_couch){
            $query = "SELECT * FROM couch_couch WHERE id = '$id_couch'";
            $query_result = $this->db->query($query);
            if($query_result->num_rows() == 1 )
            {
                $query_result = $query_result->result_array();
                return $query_result[0];
            }
            else
                return FALSE;
        }
        
        function traer_campo ($campo, $id,$tabla){
            $query = "SELECT $campo,id FROM $tabla WHERE id = '$id'";
            $query_result = $this->db->query($query);            
            $query_result = $query_result->result_array();
            return $query_result[0];
        }
    
        public function cancelar_reserva($id_couch,$id_user){
            $query = "DELETE FROM reserva WHERE id_couch=$id_couch AND id_user=$id_user";
            $query_result = $this->db->query($query);
        }
        
        public function tiene_reservas_concretadas($id_couch){
            $query = "SELECT *
                      FROM reserva
                      WHERE id_couch=$id_couch AND aceptado=1";
            $query_result = $this->db->query($query);
            return ($query_result->num_rows() >= 1);
        }
        
        public function existe_couch($id_couch){
            $query = "SELECT id
                      FROM couch_couch
                      WHERE id=$id_couch";
            $query_result = $this->db->query($query);
            return ($query_result->num_rows() == 1);
        }
        
        public function bajar_couch($id_couch){
            $query = "UPDATE couch_couch
                      SET alta=0
                      WHERE id=$id_couch";
            $query_result = $this->db->query($query);
        }
         
        public function traer_reservas($id_couch){
            $query = "SELECT *
                      FROM reserva
                      WHERE id_couch = $id_couch";
            $query_result = $this->db->query($query);  
            return ($query_result->result_array());       
        }
        
        public function traer_usuario($id_user){
            $query = "SELECT *
                      FROM user
                      WHERE id=$id_user";
            $query_result = $this->db->query($query);
            $query_result=$query_result->result_array();
            return $query_result[0];
        }
        
        public function buscar_couch($tipo=null, $provincia=null, $localidad=null, $titulo=null, $fecha_i=null, $fecha_f=null){
            if(strlen($tipo) !== 0){
                $this->db->where('tipo',$tipo);
            }
            if(strlen($localidad) !== 0){
                $this->db->where('localidad',$localidad);
            }
            if(strlen($titulo) !== 0){
                $this->db->like('nombre_couch',$titulo);
            }
            if(strlen($fecha_i) !== 0){
                $this->db->where("DATE('$fecha_i') BETWEEN fecha_inicio AND fecha_fin");
            }
            if(strlen($fecha_f) !== 0){
                $this->db->where("DATE('$fecha_f') BETWEEN fecha_inicio AND fecha_fin");
            }
            $query_result = $this->db->get('couch_couch');
            
            return $query_result->result_array();
        }
        
        public function aceptar_reserva($id_user,$id_couch){
            $this->db->where('id_user',$id_user);
            $this->db->where('id_couch',$id_couch);
            $data = array('aceptado' => 1);
            $this->db->update('reserva',$data);
            $this->db->delete('reserva', array('id_couch' => $id_couch, 'aceptado'=> 0));
            $this->db->where('id',$id_couch);
            $this->db->update('couch_couch',array('disponible' => 0));
            
        }
}
?>