<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {
	public function index()
	{
		
	}
	public function gestion_service()
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    		//afficher la page en fonction de l'utilisateur connectée admin ou simple utilisateur
    	$data['titre'] = "Gestion des services";
		$data['content'] = 'service/gestion_service';
		$data['results'] = $this->service_model->liste_service();
		$this->load->view('template/template', $data);
	}
	public function add_service()
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    	$this->form_validation->set_rules('libelle', 'Libelle', 'trim|required|min_length[3]|xss_clean');
	    $this->form_validation->set_rules('regate', 'REGATE', 'trim|required|xss_clean');

	    
	    if($this->form_validation->run())
	    {
	    	if ($this->service_model->verifier_service($this->input->post('libelle')) == true)
	    	{
		     	
			    $data = array(
			        'libelle' =>$this->input->post('libelle'),
			        'REGATE' =>$this->input->post('regate'),
			        'option_registre' =>$this->input->post('option_registre')
			    );
		       	$this->service_model->add_service($data);
		        redirect('service/gestion_service');
		      }
		      else
		      {
		      	$data['error'] = 'Ce service existe déjà';
			    $data['titre'] = 'Ajouter service';
			    $data['content'] = 'service/add_service';
			    $this->load->view('template/template',$data);
		      }
	    }
	    else
	    {
		    $data['titre'] = 'Ajouter service';
		    $data['content'] = 'service/add_service';
		    $this->load->view('template/template',$data);
	    }
	}
	public function activer($id)
	{
		$this->service_model->activer_service($id);
		redirect('service/gestion_service');
	}
	public function desactiver($id)
	{
		$this->service_model->desactiver_service($id);
		redirect('service/gestion_service');
	}
	public function modifier_service($id)
	{
		$this->form_validation->set_rules('libelle', 'Libelle', 'trim|required|min_length[3]|xss_clean');
	    $this->form_validation->set_rules('regate', 'REGATE', 'trim|required|xss_clean');

	    
	    if($this->form_validation->run())
	    {
	    	$data = array(
	    			'id'=>$this->input->post('id'),
			        'libelle' =>$this->input->post('libelle'),
			        'REGATE' =>$this->input->post('regate'),
			        'option_registre' =>$this->input->post('option_registre')
			);
		    $this->service_model->modifier_service($data);
		    redirect('service/gestion_service');
		     
	    }
	    else
	    {
	    	if(isset($id))
	    	{
		    	$data['results'] = $this->service_model->get_service($id);
			    $data['titre'] = 'Modifier service';
			    $data['content'] = 'service/modifier_service';
			    $this->load->view('template/template',$data);
			}
			else
			{
				$id = $this->input->post('id');
				$data['results'] = $this->service_model->get_service($id);
			    $data['titre'] = 'Modifier service';
			    $data['content'] = 'service/modifier_service';
			    $this->load->view('template/template',$data);

			}
	    }
	}
}