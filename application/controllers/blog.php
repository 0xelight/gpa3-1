<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller{
	public function index()
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    	//afficher la page en fonction de l'utilisateur connectée admin ou simple utilisateur 
		$data['titre'] = "Nouveautés";
		$data['results'] = $this->blog_model->liste_article_service();
		$data['content'] = 'blog/blog';
		$this->load->view('template/template', $data);
	}
	public function gestion_blog()
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    	//afficher la page en fonction de l'utilisateur connectée admin ou simple utilisateur 
		$data['titre'] = "Gestion articles";
		$data['results'] = $this->blog_model->liste_article_service();
		$data['content'] = 'blog/gestion_blog';
		$this->load->view('template/template', $data);
	}
	public function add_article()
	{
		if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
	    $this->form_validation->set_rules('titre', 'Titre', 'trim|required|min_length[3]|xss_clean');
	    $this->form_validation->set_rules('article', 'Article', 'trim|required|xss_clean');

	    
	    if($this->form_validation->run())
	    {
	    	$data = array(
			        'titre'=>$this->input->post('titre'),
					'article'=>$this->input->post('article'),
					'dte_redaction'=>date("Y-m-d H:i:00"),
					'fk_service'=>classe()->service
			    );
		    $this->blog_model->add_article($data);
		    redirect('blog/gestion_blog');
	    }
	    else
	    {
		    $data['titre'] = 'Ajouter article';
		    $data['content'] = 'blog/add_article';
		    $this->load->view('template/template',$data);
	    }
	}
	public function modifier($id)
	{
		if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
	    $this->form_validation->set_rules('titre', 'Titre', 'trim|required|min_length[3]|xss_clean');
	    $this->form_validation->set_rules('article', 'Article', 'trim|required|xss_clean');
	    if($this->form_validation->run())
	    {
			$data = array(
				'id'=>$this->input->post('id'),
			    'titre'=>$this->input->post('titre'),
			    'article'=>$this->input->post('article'),
			    'fk_service'=>classe()->service,
			    'dte_redaction'=>date("Y-m-d H:i:00")
			    );
		        
		    $this->blog_model->modifier_article($data);
		    redirect('blog/gestion_blog');    
	    }
	    else
	    {
	    	if(isset($id))
	    	{
		    $data['result']=$this->blog_model->get_article($id);
		    $data['titre'] = 'Modification ';
		    $data['content'] = 'blog/modifier_blog';
		    $this->load->view('template/template',$data);
			}
			else
			{
				$id = $this->input->post('id');
			    $data['result']=$this->blog_model->get_article($id);
			    $data['titre'] = 'Modification ';
			    $data['content'] = 'blog/modifier_blog';
			    $this->load->view('template/template',$data);
			}
	    }
	}
	public function supprimer()
	{

	}	
}