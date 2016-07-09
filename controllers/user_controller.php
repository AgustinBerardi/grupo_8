<?php

    class User_Controller extends CI_Controller{
        
        public function __construct(){
                parent::__construct();
                $this->load->database();
                $this->load->model('couch_model');
                $this->load->model('comun_model');
                $this->load->model('user_model');
                $this->load->model('login_model'); 
                $this->load->helper(array('url','form','verificar_pagina'))  ;
                $this->load->library(array('form_validation','session'));       
        }
        
        public function index (){
             if(verificar_user($this->session->userdata('perfil')))
                 $this->load->view('user_view');
        }
        
        public function ingresar_tarjeta_premium(){
            if($this->session->userdata('premium')){
                redirect(site_url().'home_controller');
            }
            if((verificar_user($this->session->userdata('perfil')))){
                $this->load->view('ingresar_numero_tarjeta_view',$this->input->post());
            }
        }
        public function cambiar_premium(){
            if($this->session->userdata('premium')){
                redirect(site_url().'home_controller');
            }
            $this->form_validation->set_rules('codigo','Codigo','callback_verificar_codigo');
            $this->form_validation->set_rules('seguridad','seguridad','callback_verificar_seguridad');
            if($this->form_validation->run()==FALSE)
                $this->ingresar_tarjeta_premium();
            else
            {
                $this->comun_model->cambiar_premium($this->session->userdata('username'));
                $this->session->set_userdata('premium',1);
                redirect(site_url().'home_controller');
            }
        }
        public function verificar_codigo($campo){
            if (!(preg_match("/^([0-9]){16}/",$campo)) & strlen($campo) <=16 ){
                $this->form_validation->set_message('verificar_codigo','El campo debe tener 16 digitos');
                return FALSE;
            }
            return TRUE;
        }
        public function verificar_seguridad($campo){
            if (!(preg_match("/^([0-9]){3}/",$campo))& strlen($campo) <=3){
                $this->form_validation->set_message('verificar_seguridad','El campo debe tener 3 digitos');
                return FALSE;
            }
            return TRUE;
        }
        
        public function eliminar_cuenta(){
            if((verificar_user($this->session->userdata('perfil')))){
                $this->user_model->eliminar_cuenta($this->session->userdata('username'));
                $this->session->unset_userdata();
                $this->session->sess_destroy();
                $this->load->view('eliminacion_exitosa_view');
                }
        }
        public function eliminar_cuenta_opciones(){
            if((verificar_user($this->session->userdata('perfil')))){
                 $this->load->view('eliminar_cuenta_opciones_view');
            }            
        }
        public function add_couch (){
            if(verificar_user($this->session->userdata('perfil'))){
                $this->load->view('agregar_couch_view',$this->input->post());
            }
        }
        
        public function verificar_informacion_couch(){
              $this->form_validation->set_rules('imagen','imagen','callback_verificar_imagen');
              $this->form_validation->set_rules('titulo','titulo','callback_verificar_campo');
              $this->form_validation->set_rules('fecha_inicio','fecha_inicio','callback_verificar_fechas');       
              $config['upload_path'] = './uploads/';
              $config['allowed_types'] = 'gif|jpg|png|jpeg';
              $config['max_size'] = '10000000';
              $config['max_width'] = '5000';
              $config['max_height'] = '5000';
              $this->load->library('upload', $config);     
              if($this->form_validation->run()== FALSE)
                        $this->add_couch();
              else{                   
                    $this->couch_model->add_couch($this->input->post(),$this->upload->data());
                    if(verificar_user($this->session->userdata('perfil')))
                            $this->load->view('user_view');
              }
        }         
        
        
        
        public function verificar_informacion_edicion_couch($id_couch){
             $config['upload_path'] = './uploads/';
              $config['allowed_types'] = 'gif|jpg|png|jpeg';
              $this->load->library('upload', $config); 
              if ( ! $this->upload->do_upload()){
                    $data= $this->upload->data();
                    $foto_nueva= $data['file_name'];
                    if(!($foto_nueva ==''))
                         $this->form_validation->set_rules('imagen','imagen','callback_verificar_imagen');
                        
              }  
              $this->form_validation->set_rules('titulo','titulo','callback_verificar_campo');
              $this->form_validation->set_rules('fecha_inicio','fecha_inicio','callback_verificar_fechas');        
              if($this->form_validation->run()== FALSE){
                        if(verificar_user($this->session->userdata('perfil'))){
                            $post=$this->input->post();
                            $post['id']=$id_couch;
                            $couch=$this->couch_model->traer_couch($id_couch);
                            $post['foto']=  $couch['foto']; 
                            $this->load->view('editar_couch_view',$post);
                        }
              }
              else{ 
                    $data= $this->upload->data();
                    $foto_nueva= $data['file_name'];
                    $foto = ($foto_nueva == '')?$this->input->post('foto_vieja'):$foto_nueva;
                    $this->couch_model->editar_couch($this->input->post(),$id_couch,$foto);
                    redirect('couch_controller/ver_couch/'.$id_couch);
              }
            
        }
        
    public function editar_couch ($id_couch = 0){
            if(verificar_user($this->session->userdata('perfil'))){
                if($this->couch_model->existe_couch($id_couch)){
                    $couch = $this->couch_model->traer_couch($id_couch);
                    if( $couch['usuario'] == $this->session->userdata('id')){
                        $this->load->view('editar_couch_view',$this->couch_model->traer_couch($id_couch));
                    }else
                    redirect(site_url().'couch_controller/ver_couch/'.$id);
                    
                }else
                    redirect(site_url().'couch_controller/ver_couch/'.$id);
            }
      }
        
        public function verificar_campo($campo){
            if (!(preg_match("/^([a-zA-Z]){2}/",$campo))){
                $this->form_validation->set_message('verificar_campo','El campo debe tener por lo menos 2 letras');
                return FALSE;
            }
            return TRUE;
        }
        
        
            function verificar_fechas($primera)
             {        $segunda= $this->input->post('fecha_fin');
                      $valoresPrimera = explode ("-", $primera);   
                      $valoresSegunda = explode ("-", $segunda); 
                      $anyoPrimera    = $valoresPrimera[0];  
                      $mesPrimera  = $valoresPrimera[1];  
                      $diaPrimera   = $valoresPrimera[2]; 
                      $anyoSegunda   = $valoresSegunda[0];  
                      $mesSegunda = $valoresSegunda[1];  
                      $diaSegunda  = $valoresSegunda[2];
                      $diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);  
                      $diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);    
                      if(($diasPrimeraJuliano - $diasSegundaJuliano)>0){
                        $this->form_validation->set_message('verificar_fechas','La fecha de inicio debe ser menor a la de fin');
                        return FALSE;
                      }
                      return TRUE;                    
        }
             
        public function mi_perfil(){
            if(verificar_user($this->session->userdata('perfil'))){
                 $check_user = $this->login_model->buscar_user($this->session->userdata('username'));
                 if($check_user){
                                $couchs = $this->couch_model->traer_couchs($this->session->userdata('id'));
                            	$data = array(
                               'username'        =>      $check_user->username,
	                           'email' 	=> 		$check_user->email,
                               'apellido'	     	=>		$check_user->apellido,
                               'pais'	     	=>		$check_user->nacionalidad,                               
	                           'nombre' 		=> 		$check_user->nombre,
                               'couchs'         =>  $couchs    );
                               
                            $this->load->view('mi_perfil_view',$data);         
                }               
            }
        }
                    
        public function verificar_imagen (){
            if ( ! $this->upload->do_upload()){
                $this->form_validation->set_message('verificar_imagen',$this->upload->display_errors() );
                return FALSE;
            }else{
                       return TRUE;
                }
        }
        
        public function solicitar_reserva($id = 0){
            if(verificar_user($this->session->userdata('perfil'))){
                if($this->couch_model->existe_couch($id)){
                            $couch = $this->couch_model->traer_couch($id);
                            if($couch['usuario']!== $this->session->userdata('id') && !$this->user_model->user_tiene_reserva($id,$this->session->userdata('id'))){
                                $data = array ( 'id' => $id);
                                $this->load->view('solicitar_reserva_view',$data);
                            }
                            else
                                redirect(site_url().'couch_controller/ver_couch/'.$id);
                }
                else
                    redirect(site_url().'couch_controller/ver_couch/'.$id);
            }                
        }
        public function agregar_reserva($token = null){
            $datos = $this->session->flashdata("datos_reserva");
            if($token === $this->session->flashdata('token') && is_array($datos)){
                $this->user_model->agregar_solicitud_reserva($datos["fecha_inicio"],$datos["fecha_fin"],$datos["id_couch"]);
                $this->load->view('solicitud_exitosa_view');
                }
            else {
                redirect(site_url().'/home_controller');
            } 
        }
        
        public function verificar_informacion_reserva($id_couch=0){
            if(verificar_user($this->session->userdata('perfil'))){
					$this->form_validation->set_rules('fecha_inicio','fecha_inicio','callback_verificar_fechas'); 
					 if($this->form_validation->run()== FALSE){
							 $this->solicitar_reserva($id_couch);
                     }else{ 					
                         if(!($this->user_model->verificar_fechas($this->input->post('fecha_inicio'),$this->input->post('fecha_fin'),$this->session->userdata('id')))){
                                  $error= "Usted tiene reservas en esa fecha, desea continuar de todas formas?";
                          } 
                            else
                                  $error='Confirmar reserva:';   
                         $token = md5($id_couch.$this->session->userdata('id'));
                         $this->session->set_flashdata('token',$token);
                         $data= array ('error' => $error , 'fecha_inicio' => $this->input->post('fecha_inicio')  , 'fecha_fin' => $this->input->post('fecha_fin'), 'id_couch' => $id_couch, 'token' =>$token);
                         $this->session->set_flashdata("datos_reserva", $data);
                         $this->load->view('confirmar_solicitud_view',$data);
                }      
			 }
        }
      
        public function verificar_cancelar_reserva($id_couch = 0){
            if(verificar_user($this->session->userdata('perfil'))){
                if($this->couch_model->existe_couch($id_couch)){
                            $couch = $this->couch_model->traer_couch($id_couch);
                            if($couch['usuario']!== $this->session->userdata('id') && $this->user_model->user_tiene_reserva($id_couch,$this->session->userdata('id'))){
                                    $data = array ('id_couch' => $id_couch);
                                    $this->session->set_flashdata('couch',$id_couch);
                                    $this->load->view('cancelar_reserva_view',$data); 
                            }
                            else
                                redirect(site_url().'couch_controller/ver_couch/'.$id_couch);
                }else{
                    redirect(site_url().'couch_controller/ver_couch/'.$id_couch);
                    }
            }
        }
        
        public function cancelar_reserva($id_couch = 0){
                if(verificar_user($this->session->userdata('perfil'))){
                    if($couch['usuario']!== $this->session->userdata('id')){
                        $id_couch= $this->session->flashdata('couch');
                        if($id_couch){
                             $this->couch_model->cancelar_reserva($id_couch,$this->session->userdata('id'));
                             redirect(site_url().'couch_controller/ver_couch/'.$id_couch); 
                        }
                        else
                            redirect(site_url().'couch_controller/ver_couch/'.$id_couch);
                    }
                    else
                        redirect(site_url().'couch_controller/ver_couch/'.$id_couch);  
                }
        }
        public function rechazar_reserva($id_user){
                if(verificar_user($this->session->userdata('perfil'))){
                    $id_couch= $this->session->flashdata('couch');
                    if($id_couch){
                         $this->couch_model->cancelar_reserva($id_couch,$id_user);
                         redirect(site_url().'user_controller/ver_solicitudes/'.$id_couch);   
                    }
                    else
                          redirect(site_url().'user_controller/mi_perfil');   
                }
        }      
        
        public function cancelar_reserva_concretada($id_user){
                if(verificar_user($this->session->userdata('perfil'))){
                    $id_couch= $this->session->flashdata('couch');
                    if($id_couch){
                         $this->couch_model->cancelar_reserva($id_couch,$id_user);
                         redirect(site_url().'user_controller/ver_solicitudes/'.$id_couch);   
                    }
                    else
                          redirect(site_url().'user_controller/mi_perfil');   
                }
        }
        
        public function aceptar_reserva($id_user){
                if(verificar_user($this->session->userdata('perfil'))){
                    $id_couch= $this->session->flashdata('couch');
                    if($id_couch){
                         $this->couch_model->aceptar_reserva($id_user,$id_couch);
                         redirect(site_url().'user_controller/ver_solicitudes/'.$id_couch);   
                    }
                    else
                          redirect(site_url().'user_controller');   
                }
        }      
        
        public function dar_baja_couch($id_couch){
            if(verificar_user($this->session->userdata('perfil'))){
                if($this->couch_model->existe_couch($id_couch)){
                    $couch = $this->couch_model->traer_couch($id_couch);
                    if( $couch['usuario'] == $this->session->userdata('id')){
                        $this->session->set_flashdata('couch',$id_couch);
                        $this->load->view('confirmar_baja_couch_view',array('id_couch' => $id_couch));
                    }else{
                        redirect(site_url().'couch_controller/ver_couch/'.$id_couch);
                    }
                }else{
                    redirect(site_url().'couch_controller/ver_couch/'.$id_couch);
                }    
            }else{
                redirect(site_url().'couch_controller/ver_couch/'.$id_couch);
            }             
        } 
        
         public function bajar_couch(){
            $id_couch = $this->session->flashdata('couch');
            if($id_couch){
            	if($this->couch_model->existe_couch($id_couch)){
            		      $this->couch_model->bajar_couch($id_couch); 
                          redirect(site_url().'user_controller/mis_couchs');   
                }else{
            		      redirect(site_url().'home_controller');
                     }
             }else{
                redirect(site_url().'couch_controller/ver_couch/'.$id_couch);
             } 
        }
        
        public function ver_solicitudes($id_couch = 0){
            if(verificar_user($this->session->userdata('perfil'))){
                if($this->couch_model->existe_couch($id_couch)){
                    $couch = $this->couch_model->traer_couch($id_couch);
                    if( $couch['usuario'] == $this->session->userdata('id')){
                        $reservas = $this->couch_model->traer_reservas($id_couch);
                        $this->session->set_flashdata('couch',$id_couch);
                        $data = array('reservas' => $reservas, 'id_couch' => $id_couch);
                        $this->load->view('ver_solicitudes_view',$data); 
                    }
                    else
                    {
                        redirect(site_url().'couch_controller/ver_couch/'.$id_couch);
                    }
                }else
                {
                    redirect(site_url().'couch_controller/ver_couch/'.$id_couch);
                }  
            }
        }
        public function mis_couchs(){
            if(verificar_user($this->session->userdata('perfil'))){
                $this->load->view('mis_couch_view');    
            }
        }
        
        
        
}
?>