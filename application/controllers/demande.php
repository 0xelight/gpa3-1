<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demande extends CI_Controller {

	public function index()
	{
		//si l'utilisateur est déjà connecté, redirection sur le controlleur principale
		if($this->session->userdata('login') || $this->session->userdata('logged'))
	    {
	      redirect('blog');
	    }

    	$this->form_validation->set_rules('libelle','Libellé','trim|required|xss_clean');
    	$this->form_validation->set_rules('regate','REGATE','trim|required|xss_clean');
    	$this->form_validation->set_rules('nom','Nom','trim|required|xss_clean');
    	$this->form_validation->set_rules('prenom','Prénom','trim|required|xss_clean');
    	$this->form_validation->set_rules('login','Identifiant','trim|required|xss_clean');
    	$this->form_validation->set_rules('mail','Adresse mail','trim|required|xss_clean');
    	if($this->form_validation->run())
    	{
    		$data = array(
    			'libelle' =>$this->input->post('libelle'),
    			'REGATE' =>$this->input->post('regate'),
    			'option_registre' =>$this->input->post('option_registre'),
    			'nom' =>$this->input->post('nom'),
    			'prenom' =>$this->input->post('prenom'),
    			'login' =>$this->input->post('login'),
    			'mail' =>$this->input->post('mail'),
    			'statut' => '0');
    		$this->demande_model->add_demande($data);
    		redirect('authentification');	 
    	}
    	// afficher la page de demande 
    	else
    	{
			$data['titre'] = "Demande de création d'un service";
			$data['content'] = "demande/creation_service";
			$this->load->view ('template/template',$data);
		}
	}
	public function gestion_demande()
	{
		
    	//afficher la page en fonction de l'utilisateur connectée admin ou simple utilisateur
    	$data['titre'] = "Gestion des demandes";
		$data['content'] = 'demande/gestion_demande';
		$data['results'] = $this->demande_model->liste_demande();
		$this->load->view('template/template', $data);
	}
	public function valider($id)
	{
		$this->demande_model->valider_demande($id);
		redirect('demande/gestion_demande');
	}
	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
?>