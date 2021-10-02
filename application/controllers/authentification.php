<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentification extends CI_Controller{

	public function index()
	{
		//si l'utilisateur est déjà connecté, redirection sur le controlleur principale
		if($this->session->userdata('login') || $this->session->userdata('logged'))
	    {
	      redirect('blog');
	    }

    	$this->form_validation->set_rules('pseudo','Pseudo','trim|required|xss_clean');
    	$this->form_validation->set_rules('pass','Mot de passe','trim|required|xss_clean');
    	if($this->form_validation->run())
    	{
    		$user=$this->utilisateur_model->check_id($this->input->post('pseudo'),$this->input->post('pass'));
    		// si $user retourne un résultat différent de faux, faire la connexion avec les données de l'utilisateur
            if ($user != false)
            {
                $this->session->set_userdata('login',$user);
                $this->session->set_userdata('user_data',$this->input->post('pseudo'));
                if(!$this->input->is_ajax_request())
                {
                    redirect('blog');
                }
            }
            // si $user retourne faux, affiche un message d'erreur
     	 	else
      		{
        		$data['error'] = 'Mauvais identifiants ou mot de passe';
        		$data['titre'] = "Authentification";
				$data['content'] = "authentification/authentification";
				$this->load->view ('template/template',$data);
      		}
    	}
    	// afficher la page authentification 
    	else
    	{
			$data['titre'] = "Authentification";
			$data['content'] = "authentification/authentification";
			$this->load->view ('template/template',$data);
		}
	}
	public function inscription()
  	{
  		//modul d'incription.
  		// redirection si l'utilisateur est déjà connecté
	    if($this->session->userdata('login') || $this->session->userdata('logged'))
	    {
	      redirect('blog');
	    } 
	    $this->form_validation->set_rules('nom', 'Nom', 'trim|required|min_length[3]|xss_clean');
	    $this->form_validation->set_rules('prenom', 'Prénom', 'trim|required|min_length[3]|xss_clean');
	    $this->form_validation->set_rules('pseudo','Pseudo','trim|required|xss_clean|callback_check_pseudo');
	    $this->form_validation->set_rules('pass','Mot de passe','trim|required|xss_clean|min_length[5]');
	    $this->form_validation->set_rules('re-pass','Répéter mot de passe','trim|required|xss_clean|min_length[5]');
	    $this->form_validation->set_rules('email','Email','trim|required|xss_clean|valid_email|callback_check_email');
	    $this->form_validation->set_rules('telephone', 'Téléphone', 'trim|required|min_length[3]|xss_clean');
	    $this->form_validation->set_rules('adresse', 'Adresse', 'trim|required|min_length[3]|xss_clean');
	    $this->form_validation->set_rules('ville', 'Ville', 'trim|required|min_length[3]|xss_clean');
	    $this->form_validation->set_rules('cp', 'Code Postale', 'trim|required|min_length[3]|xss_clean');
	    $this->form_validation->set_rules('distance', 'Distance travail/domicile', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('reponse', 'Réponse', 'trim|required|min_length[3]|xss_clean');

	    
	    if($this->form_validation->run())
	    {
	    	if ($this->utilisateur_model->verifier_pseudo($this->input->post('pseudo')) == true)
	    	{
		     	if($this->input->post('pass') == $this->input->post('re-pass'))
		      	{
		      		// pour prendre en compte que le supérieur pour être null
		      		if($this->input->post('superieur') != 0)
		      		{
		      			$superieur = $this->input->post('superieur');
		      		}
		      		else
		      		{
		      			$superieur = null;
		      		}
			        $data = array(
			          'nom'=>$this->input->post('nom'),
			          'prenom'=>$this->input->post('prenom'),
			          'login'=>$this->input->post('pseudo'),
			          'password'=>sha1($this->input->post('pass')),
			          'mail'=>$this->input->post('email'),
			          'telephone'=>$this->input->post('telephone'),
			          'adresse'=>$this->input->post('adresse'),
			          'ville'=>$this->input->post('ville'),
			          'cp'=>$this->input->post('cp'),
			          'distance_domicile'=>$this->input->post('distance'),
			          'fk_service'=>$this->input->post('service'),
			          'question'=>$this->input->post('question'),
			          'reponse'=>sha1($this->input->post('reponse')),
			          'superieur'=>$superieur
			        );
		        
		        	$this->utilisateur_model->inscription($data);
		        
		        	$data['success'] = 'Inscription réussie';
		        	$data['titre'] = 'Authentification';
		         	$data['content'] = 'authentification/authentification';
		         	$data['menu']='menu/nomenu';
		       	 	$this->load->view('template/template',$data);
		      	}
		      	else
		      	{
			        $data['error'] = 'Les mots de passes doivent être identique';
			        $data['results']=$this->service_model->liste_service();
			        $data['titre'] = 'Inscription';
			        $data['content'] = 'authentification/inscription';
			        $this->load->view('template/template',$data);
		      	}
		      }
		      else
		      {
		      	$data['error'] = 'Un compte existe déjà avec ce pseudo';
		      	$data['results']=$this->service_model->liste_service();
			    $data['titre'] = 'Inscription';
			    $data['content'] = 'authentification/inscription';
			    $this->load->view('template/template',$data);
		      }
	    }
	    else
	    {
		    $data['results']=$this->service_model->liste_service();
		    $data['superieur'] = $this->utilisateur_model->get_admin();
		    $data['titre'] = 'Inscription';
		    $data['content'] = 'authentification/inscription';
		    $this->load->view('template/template',$data);
	    }
	}
	public function deconnexion() 
	{
		$this->session->unset_userdata();
		$this->session->sess_destroy();
		redirect(base_url());
	}
	public function oublie()
  	{
  		//redirection si l'utilisateur est déjà connecté
		if($this->session->userdata('login') || $this->session->userdata('logged'))
	    {
	      redirect('utilisation');
	    } 
	    $this->form_validation->set_rules('pseudo','Pseudo','trim|required|xss_clean|callback_check_pseudo');
	    $this->form_validation->set_rules('pass','Mot de passe','trim|required|xss_clean|min_length[5]');
	    $this->form_validation->set_rules('re-pass','Répéter mot de passe','trim|required|xss_clean|min_length[5]');
	    $this->form_validation->set_rules('reponse', 'Réponse', 'trim|required|min_length[3]|xss_clean');

	    
	    if($this->form_validation->run())
	    {
	    		$pseudo = $this->input->post('pseudo');
	    		$question = $this->input->post('question');
	    		$reponse = sha1($this->input->post('reponse'));
	    		if ($this->utilisateur_model->verifier_infos($pseudo , $question , $reponse) == true)
	    		{
	    			if($this->input->post('pass') == $this->input->post('re-pass'))
		      		{
			        $data = array(
				          'login'=>$this->input->post('pseudo'),
				          'password'=>sha1($this->input->post('pass')),
				          'question'=>$this->input->post('question'),
				          'reponse'=>sha1($this->input->post('reponse'))
				        );
			        
			        	$this->utilisateur_model->modifier_passe($data , $pseudo);
			        
			        	$data['success'] = 'Changement de mot de passe réussie';
			        	$data['titre'] = 'Authentification';
			         	$data['content'] = 'authentification/authentification';
			       	 	$this->load->view('template/template',$data);
		      		}
		      		else
		      		{
				        $data['error'] = 'Les mots de passes doivent être identique';
				        $data['titre'] = 'Changer de mot de passe';
				        $data['content'] = 'authentification/oublie';
				        $this->load->view('template/template',$data);
		      		}
	    		}
	    		else
	    		{
	    			$data['error'] = 'Les informations saisies sont incorrectes';
				    $data['titre'] = 'Changer de mot de passe';
				    $data['content'] = 'authentification/oublie';
				    $this->load->view('template/template',$data);	
	    		}
	    	
		}
		else
		{
	    $data['titre'] = 'Changer de mot de passe';
	    $data['content'] = 'authentification/oublie';
	    $this->load->view('template/template',$data);
		}
  	}
}	
/* End of file authentification.php */
/* Location: ./application/controllers/authentification.php */