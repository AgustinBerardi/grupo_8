<?php

    class  Couchinn extends CI_Model {
     
           function set_user(){
                echo "llega aca";
                $this->load->database();
                echo $user = $_POST ['username'];
                echo $pass = $_POST ['password'];
                $query= 'INSERT INTO user(email, pass)
                                       VALUES($user, $pass)';
                $this->db->query($query);
           }
    }


?>
