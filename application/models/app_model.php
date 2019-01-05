<?php

    class App_model extends CI_Model {
            
        function validate(){
            $contact_email = $_GET['contact_email'];
            $contact_password = md5($_GET['contact_password']);
            $sql = "SELECT * FROM users WHERE contact_email = '$contact_email' AND contact_password = '$contact_password'";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0){
               return TRUE;
            }else{
                return FALSE;
            }
        } /* validate ends */
        
    } /* login model ends */

?>