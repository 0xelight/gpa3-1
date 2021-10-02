<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voiture extends CI_Controller {
	public function index()
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    	//afficher la page en fonction de l'utilisateur connectée admin ou simple utilisateur 
    	$data['titre'] = "Gestion voiture";
		$data['content'] = 'voiture/voiture';
		$data['results'] = $this->voiture_model->list_voiture_service();
		$this->load->view('template/template', $data);
	}
	public function add_voiture()
	{
		if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
	    $this->form_validation->set_rules('code_plaque', 'Immatriculation', 'trim|required|min_length[3]|xss_clean');
	    $this->form_validation->set_rules('modele', 'Modèle', 'trim|required|xss_clean');

	    
	    if($this->form_validation->run())
	    {
	    	if ($this->voiture_model->verifier_code($this->input->post('code_plaque')) == true)
	    	{
		     	
			    $data = array(
			        'code_plaque'=>strtoupper($this->input->post('code_plaque')),
					'modele'=>$this->input->post('modele'),
					'commentaire'=>$this->input->post('commentaire'),
					'fk_service'=>classe()->service,
					'statut'=>$this->input->post('statut')
			    );
		       	$this->voiture_model->add_voiture($data);
		        redirect('voiture');
		      }
		      else
		      {
		      	$data['error'] = 'Une voiture existe déjà avec cette Immatriculation';
			    $data['titre'] = 'Ajouter voiture';
			    $data['content'] = 'voiture/add_voiture';
			    $this->load->view('template/template',$data);
		      }
	    }
	    else
	    {
		    $data['titre'] = 'Ajouter voiture';
		    $data['content'] = 'voiture/add_voiture';
		    $this->load->view('template/template',$data);
	    }
	}
	public function modifier_voiture($id)
  	{
  		if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
	    $this->form_validation->set_rules('immat', 'Immatriculation', 'trim|required|min_length[3]|xss_clean');
	    $this->form_validation->set_rules('modele', 'Modèle', 'trim|required|xss_clean');
	    if($this->form_validation->run())
	    {
			$data = array(
				'id'=>$this->input->post('id'),
			    'code_plaque'=>strtoupper($this->input->post('immat')),
			    'modele'=>$this->input->post('modele'),
			    'commentaire'=>$this->input->post('commentaire'),
			    'fk_service'=>classe()->service,
			    'statut'=>$this->input->post('statut')
			    );
		        
		    $this->voiture_model->modifier_voiture($data);
		    redirect('voiture');    
	    }
	    else
	    {
	    	if(isset($id))
	    	{
		    $data['result']=$this->voiture_model->get_voiture($id);
		    $data['titre'] = 'Modification ';
		    $data['content'] = 'voiture/modification_voiture';
		    $this->load->view('template/template',$data);
			}
			else
			{
				$id = $this->input->post('id');
			    $data['result']=$this->voiture_model->get_voiture($id);
			    $data['titre'] = 'Modification ';
			    $data['content'] = 'voiture/modification_voiture';
			    $this->load->view('template/template',$data);
			}
	    }
	}
	public function supprimer_voiture($id)
	{
		$check = $this->voiture_model->check_attribue($id);
		if($check == true)
		{
			$this->voiture_model->supprimer_voiture($id);
			redirect('voiture');
		}
		else
		{
			$data['titre'] = "Gestion voiture";
			$data['error'] = 'Cette voiture est attribué à un utilisateur';
			$data['content'] = 'voiture/voiture';
			$data['results'] = $this->voiture_model->list_voiture_service();
			$this->load->view('template/template', $data);
		}
	}
	public function gestion_voiture()
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    	//afficher la page en fonction de l'utilisateur connectée admin ou simple utilisateur 
    	$data['titre'] = "Gestion voiture";
		$data['content'] = 'voiture/gestion_voiture';
		$data['results'] = $this->voiture_model->list_voiture();
		$this->load->view('template/template', $data);
	}
	public function gestion_add_voiture()
	{
		if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
	    $this->form_validation->set_rules('code_plaque', 'Immatriculation', 'trim|required|min_length[3]|xss_clean');
	    $this->form_validation->set_rules('modele', 'Modèle', 'trim|required|xss_clean');

	    
	    if($this->form_validation->run())
	    {
	    	if ($this->voiture_model->verifier_code($this->input->post('code_plaque')) == true)
	    	{
		     	
			    $data = array(
			        'code_plaque'=>strtoupper($this->input->post('code_plaque')),
					'modele'=>$this->input->post('modele'),
					'commentaire'=>$this->input->post('commentaire'),
					'fk_service'=>$this->input->post('service'),
					'statut'=>$this->input->post('statut')
			    );
		       	$this->voiture_model->add_voiture($data);
		        redirect('voiture/gestion_voiture');
		      }
		      else
		      {
		      	$data['error'] = 'Une voiture existe déjà avec cette Immatriculation';
			    $data['titre'] = 'Ajouter voiture';
			    $data['results']=$this->service_model->liste_service();
			    $data['content'] = 'voiture/gestion_add_voiture';
			    $this->load->view('template/template',$data);
		      }
	    }
	    else
	    {
		    $data['titre'] = 'Ajouter voiture';
		    $data['results']=$this->service_model->liste_service();
		    $data['content'] = 'voiture/gestion_add_voiture';
		    $this->load->view('template/template',$data);
	    }
	}
	public function gestion_modifier_voiture($id)
	{
		if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
	    $this->form_validation->set_rules('immat', 'Immatriculation', 'trim|required|min_length[3]|xss_clean');
	    $this->form_validation->set_rules('modele', 'Modèle', 'trim|required|xss_clean');
	    if($this->form_validation->run())
	    {
			$data = array(
				'id'=>$this->input->post('id'),
			    'code_plaque'=>strtoupper($this->input->post('immat')),
			    'modele'=>$this->input->post('modele'),
			    'commentaire'=>$this->input->post('commentaire'),
			    'fk_service'=>$this->input->post('service'),
			    'statut'=>$this->input->post('statut')
			    );
		        
		    $this->voiture_model->modifier_voiture($data);
		    //var_dump($data);
		    redirect('voiture/gestion_voiture');    
	    }
	    else
	    {
	    	if(isset($id))
	    	{
		    $data['result']=$this->voiture_model->get_voiture($id);
		    $data['results']=$this->service_model->liste_service();
		    $data['titre'] = 'Modification ';
		    $data['content'] = 'voiture/gestion_modification_voiture';
		    $this->load->view('template/template',$data);
			}
			else
			{
				$id = $this->input->post('id');
			    $data['result']=$this->voiture_model->get_voiture($id);
			    $data['results']=$this->service_model->liste_service();
			    $data['titre'] = 'Modification ';
			    $data['content'] = 'voiture/gestion_modification_voiture';
			    $this->load->view('template/template',$data);
			}
	    }
	}
}