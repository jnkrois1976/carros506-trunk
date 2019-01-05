<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class App extends CI_Controller {
        
        public function validate(){
            $this->load->model('app_model');
            $query = $this->app_model->validate();
            if($query){
                echo "YES";
            }else{
                echo "NO";
            }
        }
        
    }
    
?>
