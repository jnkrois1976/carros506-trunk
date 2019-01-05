
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Custom_404 extends CI_Controller {
	 
	    public function __construct() {
	            parent::__construct();              
	    }

	    public function index() {
	 		$this->load->model('site_model');
			$allmakes = $this->site_model->allmakes();
	        $this->load->view("misc/custom_404_error.php", array('allmakes' => $allmakes));

	    }
	 
	}
?>