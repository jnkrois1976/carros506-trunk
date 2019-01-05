<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);

class Pages extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->browser();
		$this->totallisting();
	}
	
	public function browser(){
		if($this->agent->is_browser('MSIE')){
			if(floor($this->agent->version()) < 9){
				redirect('/misc/browser_upgrade');
			}
		}
	}
	
	public function totallisting(){
		$this->load->model('site_model');
		$allrows = $this->site_model->allrows();
		$data = array('total_ads' => $allrows);
		$this->session->set_userdata($data);
	}
		
	public function mantenimiento(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('resultados_model');
		$advertisement = $this->resultados_model->advertisement();
		$this->load->view('pages/content_maintenance', array('allmakes' => $allmakes, 'advertisement' => $advertisement));
	}
	
	public function acerca(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->view('pages/content_acerca', array('allmakes' => $allmakes));
	}
	
	public function compare(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
        $this->load->model('resultados_model');
        $advertisement = $this->resultados_model->advertisement();
		$this->load->view('pages/content_compare', array('allmakes' => $allmakes, 'advertisement' => $advertisement));
	}
	
	public function consejos(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
        $this->load->model('resultados_model');
        $advertisement = $this->resultados_model->advertisement();
		$this->load->view('pages/content_consejos', array('allmakes' => $allmakes, 'advertisement' => $advertisement));
	}
	
	public function contactenos(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
        $this->load->model('profile_model');
        $contact_query = $this->profile_model->getcontact();
        $this->load->model('resultados_model');
        $advertisement = $this->resultados_model->advertisement();
		$this->load->view('pages/content_contactenos', array('allmakes' => $allmakes, 'contact_query' => $contact_query, 'advertisement' => $advertisement));
	}
	
	public function impuestos(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->view('pages/content_impuestos', array('allmakes' => $allmakes));
	}
	
	public function marchamo(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->view('pages/content_marchamo', array('allmakes' => $allmakes));
	}
	
	public function mecanicos(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
        $this->load->model('resultados_model');
        $advertisement = $this->resultados_model->advertisement();
		$this->load->view('pages/content_mecanicos', array('allmakes' => $allmakes, 'advertisement' => $advertisement));
	}
	
	public function preguntas(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$user_questions_anuncios = $this->site_model->get_user_questions_anuncios();
		$user_questions_perfil = $this->site_model->get_user_questions_perfil();
		$user_questions_publicidad = $this->site_model->get_user_questions_publicidad();
		$user_questions_comentarios = $this->site_model->get_user_questions_comentarios();
		$user_questions_mensajes = $this->site_model->get_user_questions_mensajes();
		$user_questions_generales = $this->site_model->get_user_questions_generales();
        $this->load->model('resultados_model');
        $advertisement = $this->resultados_model->advertisement();
		$this->load->view('pages/content_preguntas', array(
															'allmakes' => $allmakes, 
															'user_questions_anuncios' => $user_questions_anuncios, 
															'user_questions_perfil' => $user_questions_perfil,
															'user_questions_publicidad' => $user_questions_publicidad,
															'user_questions_comentarios' => $user_questions_comentarios,
															'user_questions_mensajes' => $user_questions_mensajes,
															'user_questions_generales' => $user_questions_generales,
															'advertisement' => $advertisement
															));
	}
	
	public function privacidad(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->view('pages/content_privacidad', array('allmakes' => $allmakes));
	}
	
	public function riteve(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->view('pages/content_riteve', array('allmakes' => $allmakes));
	}
	
	public function taller(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
        $this->load->model('resultados_model');
        $advertisement = $this->resultados_model->advertisement();
		$this->load->view('pages/content_taller', array('allmakes' => $allmakes, 'advertisement' => $advertisement));
	}
	
	public function seguros(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->view('pages/content_seguros', array('allmakes' => $allmakes));
	}
	
	public function publicidad(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->view('pages/content_publicidad', array('allmakes' => $allmakes));
	}
	
	public function terminos(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->view('pages/content_terminos', array('allmakes' => $allmakes));
	}
	
	public function traspasos(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->view('pages/content_traspasos', array('allmakes' => $allmakes));
	}

}

