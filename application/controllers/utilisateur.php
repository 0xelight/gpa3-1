<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilisateur extends CI_Controller{
	public function index()
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    		//afficher la page en fonction de l'utilisateur connectée admin ou simple utilisateur
    	$data['titre'] = "Gestion utilisateur";
		$data['content'] = 'utilisateur/utilisateur';
		$data['results'] = $this->utilisateur_model->list_utilisat_service();
		$this->load->view('template/template', $data);
	}
	public function add_user()
	{
		if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
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
			          'fk_service'=>classe()->service,
			          'question'=>$this->input->post('question'),
			          'reponse'=>sha1($this->input->post('reponse')),
			          'superieur'=>$this->input->post('superieur')
			        );
		        
		        	$this->utilisateur_model->inscription($data);
		        	//var_dump($data);
		        	redirect('utilisateur');
		      	}
		      	else
		      	{
			        $data['error'] = 'Les mots de passes doivent être identique';
			        $data['results']=$this->service_model->liste_service();
			        $data['titre'] = 'Ajouter utilisateur';
			        $data['content'] = 'utilisateur/add_user';
			        $this->load->view('template/template',$data);
		      	}
		      }
		      else
		      {
		      	$data['error'] = 'Un compte existe déjà avec ce pseudo';
		      	$data['results']=$this->service_model->liste_service();
			    $data['titre'] = 'Ajouter utilisateur';
			    $data['content'] = 'utilisateur/add_user';
			    $this->load->view('template/template',$data);
		      }
	    }
	    else
	    {
		    $data['results']=$this->service_model->liste_service();
		    $data['superieur'] = $this->utilisateur_model->get_admin();
		    $data['titre'] = 'Ajouter utilisateur';
		    $data['content'] = 'utilisateur/add_user';
		    $this->load->view('template/template',$data);
	    }
	}
	public function activer_compte($id)
	{
		$this->utilisateur_model->activer_utilisateur($id);
		redirect('utilisateur/utilisateur');
	}
	public function admin_compte($id)
	{
		$this->utilisateur_model->admin_utilisateur($id);
		redirect('utilisateur/utilisateur');
	}
	public function supprimer_compte($id)
	{
		$superieur = $this->utilisateur_model->check_superieur($id);
		if($superieur == true)
		{
			$this->utilisateur_model->supprimer_utilisateur($id);
			redirect('utilisateur/utilisateur');
		}
		else
		{
			$data['titre'] = "Gestion utilisateur";
			$data['error'] = 'Cet utilisateur est le supérieur de plusieurs utilisateurs';
			$data['content'] = 'utilisateur/utilisateur';
			$data['results'] = $this->utilisateur_model->list_utilisat_service();
			$this->load->view('template/template', $data);

		}
	}
	public function modifier_compte($id)
  	{
  		if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
	    $this->form_validation->set_rules('nom', 'Nom', 'trim|required|min_length[3]|xss_clean');
	    $this->form_validation->set_rules('prenom', 'Prénom', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('pseudo','Pseudo','trim|required|xss_clean');
	    $this->form_validation->set_rules('email','Mail','trim|required|xss_clean');
	    if($this->form_validation->run())
	    {
	    	if($this->input->post('vehicule_attribuer') == "")
	    	{
			$data = array(
				'id'=>$this->input->post('id'),
			    'nom'=>$this->input->post('nom'),
			    'prenom'=>$this->input->post('prenom'),
			    'login'=>$this->input->post('pseudo'),
			    'mail'=>$this->input->post('email'),
			    'telephone'=>$this->input->post('telephone'),
			    'adresse'=>$this->input->post('adresse'),
			    'ville'=>$this->input->post('ville'),
			    'cp'=>$this->input->post('CP'),
			    'distance_domicile'=>$this->input->post('distance'),
			    'fk_service'=>$this->input->post('service'),
			    'voiture_attribue' => null,
			    'superieur'=>$this->input->post('superieur')
			    );
			}
			else
			{
				$data = array(
				'id'=>$this->input->post('id'),
			    'nom'=>$this->input->post('nom'),
			    'prenom'=>$this->input->post('prenom'),
			    'login'=>$this->input->post('pseudo'),
			    'mail'=>$this->input->post('email'),
			    'telephone'=>$this->input->post('telephone'),
			    'adresse'=>$this->input->post('adresse'),
			    'ville'=>$this->input->post('ville'),
			    'cp'=>$this->input->post('CP'),
			    'distance_domicile'=>$this->input->post('distance'),
			    'fk_service'=>$this->input->post('service'),
			    'voiture_attribue' => $this->input->post('vehicule_attribuer'),
			    'superieur'=>$this->input->post('superieur')
			    );
			}
		        
		    $this->utilisateur_model->modifier_utilisateur($data);
		    //var_dump($data);
		    //echo $this->input->post('vehicule_attribuer');
		    if(classe()->compte == 3)
		    {
		    	redirect('utilisateur/gestion_utilisateur');
		    }
		    else
		    {
		    redirect('utilisateur/utilisateur');
		    } 
	    }
	    else
	    {
	    	
	    	if(isset($id))
	    	{
	    		$data['results']=$this->service_model->liste_service();
			    $data['result']=$this->utilisateur_model->get_user($id);
			    $data['voiture']= $this->voiture_model->liste_voiture_toujours_reserve();
			    $data['superieur'] = $this->utilisateur_model->get_admin();
			    $data['titre'] = 'Modification ';
			    $data['content'] = 'utilisateur/modification_utilisateur';
			    $this->load->view('template/template',$data);
			    //var_dump($this->utilisateur_model->get_user($id));
			}
			else
			{
				$id = $this->input->post('id');

				$data['results']=$this->service_model->liste_service();
			    $data['result']=$this->utilisateur_model->get_user($id);
			    $data['voiture']= $this->voiture_model->liste_voiture_toujours_reserve();
			    $data['superieur'] = $this->utilisateur_model->get_admin();
			    $data['titre'] = 'Modification ';
			    $data['content'] = 'utilisateur/modification_utilisateur';
			    $this->load->view('template/template',$data);
			}
	    }
	}
	public function mon_compte()
	{
		if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    	$this->form_validation->set_rules('nom', 'Nom', 'trim|required|min_length[3]|xss_clean');
	    $this->form_validation->set_rules('prenom', 'Prénom', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('pseudo','Pseudo','trim|required|xss_clean');
	    $this->form_validation->set_rules('email','Mail','trim|required|xss_clean');
	    if($this->form_validation->run())
	    {
	    	if(classe()->voiture_attribue == "")
	    	{
			$data = array(
				'id'=>classe()->id,
			    'nom'=>$this->input->post('nom'),
			    'prenom'=>$this->input->post('prenom'),
			    'login'=>$this->input->post('pseudo'),
			    'mail'=>$this->input->post('email'),
			    'telephone'=>$this->input->post('telephone'),
			    'adresse'=>$this->input->post('adresse'),
			    'ville'=>$this->input->post('ville'),
			    'cp'=>$this->input->post('CP'),
			    'distance_domicile'=>$this->input->post('distance')
			    );
			}
			else
			{
				
				$data = array(
				'id'=>classe()->id,
			    'nom'=>$this->input->post('nom'),
			    'prenom'=>$this->input->post('prenom'),
			    'login'=>$this->input->post('pseudo'),
			    'mail'=>$this->input->post('email'),
			    'telephone'=>$this->input->post('telephone'),
			    'adresse'=>$this->input->post('adresse'),
			    'ville'=>$this->input->post('ville'),
			    'cp'=>$this->input->post('CP'),
			    'distance_domicile'=>$this->input->post('distance')
			    );
			    $data2 = array(
			    'disponible_journee' =>$this->input->post('disponible')
			    );

		    	$this->voiture_model->modifier_disponible($data2);
			}
		        
		    $this->utilisateur_model->modifier_utilisateur($data);
		    //var_dump($data);
		    //echo $this->input->post('vehicule_attribuer');
		    redirect('utilisateur/mon_compte');
		    //var_dump($data);  
	    }
	    else
	    {
			$data['titre'] = 'Mon Compte ';
			$data['content'] = 'utilisateur/mon_compte';
			if(classe()->voiture_attribue != null){
				$data['result'] = $this->voiture_model->get_voiture(classe()->voiture_attribue);
			}
			$this->load->view('template/template',$data);
		}

	}
	public function gestion_utilisateur(){
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    		//afficher la page en fonction de l'utilisateur connectée admin ou simple utilisateur
    	if(classe()->compte != 3)
    	{
    		redirect('blog');
    	}
    	$data['titre'] = "Gestion utilisateur";
		$data['content'] = 'utilisateur/gestion_utilisateur';
		$data['results'] = $this->utilisateur_model->list_utilisat();
		$this->load->view('template/template', $data);
		
	}
	public function gestion_add_user()
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    		//afficher la page en fonction de l'utilisateur connectée admin ou simple utilisateur
    	if(classe()->compte != 3)
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
		        
		        	redirect('utilisateur/gestion_utilisateur');
		      	}
		      	else
		      	{
			        $data['error'] = 'Les mots de passes doivent être identique';
			        $data['results']=$this->service_model->liste_service();
			        $data['titre'] = 'Ajouter utilisateur';
			        $data['content'] = 'utilisateur/gestion_add_user';
			        $this->load->view('template/template',$data);
		      	}
		      }
		      else
		      {
		      	$data['error'] = 'Un compte existe déjà avec ce pseudo';
		      	$data['results']=$this->service_model->liste_service();
			    $data['titre'] = 'Ajouter utilisateur';
			    $data['content'] = 'utilisateur/gestion_add_user';
			    $this->load->view('template/template',$data);
		      }
	    }
	    else
	    {
		    $data['results']=$this->service_model->liste_service();
		    $data['superieur'] = $this->utilisateur_model->get_admin();
		    $data['titre'] = 'Ajouter utilisateur';
		    $data['content'] = 'utilisateur/gestion_add_user';
		    $this->load->view('template/template',$data);
	    }
	}

}
/* End of file administration.php */
/* Location: ./application/controllers/administration.php */