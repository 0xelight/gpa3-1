<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Planning extends CI_Controller {
	public function index()
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    	//afficher la page en fonction de l'utilisateur connectée admin ou simple utilisateur 
		$data['titre'] = "Nouveautés";
		$data['content'] = 'planning/planning';
		$this->load->view('template/template', $data);
	}
	public function planning_json()
	{
		//envoie les réservation au planning
		echo $this->reservation_model->planning();
	}
}