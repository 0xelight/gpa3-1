<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registre extends CI_Controller{
	public function index()
	{
		if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    	if(classe()->option_registre == false)
    	{
    		redirect('blog');
    	}
    	//afficher la page en fonction de l'utilisateur connectée admin ou simple utilisateur 
    	$data['titre'] = "Registre individuel";
		$data['content'] = 'registre/registre';
		$data['results']=$this->registre_model->liste_registre_user();
		$this->load->view('template/template', $data);

	}
	public function generer_registre()
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}

    	$this->form_validation->set_rules('dte_debut', 'Date début', 'trim|required');
    	$this->form_validation->set_rules('dte_fin','Date fin','trim|required');
    	$this->form_validation->set_rules('identifiant','Identifiant','trim|required');
    	$this->form_validation->set_rules('direction','Direction','trim|required');
    
    	if($this->form_validation->run())
    	{
    		$dte_debut =$this->input->post('dte_debut').' 00:00:00';
    		$dte_fin =$this->input->post('dte_fin').' 23:59:00';
    		$debut = $this->input->post('dte_debut');
    		$fin = $this->input->post('dte_fin');
    		$identifiant=$this->input->post('identifiant');
    		$direction=$this->input->post('direction');
    		$service=$this->input->post('service');
    		$pattern = '/([0-9]{2})\-([0-9]{1,2})\-([0-9]{4}) ([0-9]{1,2})\:([0-9]{2})\:([0-9]{2})/i';
			$replacement = '$3-$2-$1 $4:$5:$6';
			$dte_debutf = preg_replace($pattern, $replacement, $dte_debut);
			$dte_finf = preg_replace($pattern, $replacement, $dte_fin);
      		
	        $result = $this->reservation_model->liste_reservation_user_sur_duree($dte_debutf, $dte_finf);
	        //strtoupper($variable) converti une chaine en majuscule
	        //ucfirst($variable) converti la première lettre en majuscule
	        $content = 
       		 "<style>
       		 	table{ border-collapse: collapse; width:100%; height:100%;}
				td{border: 1px solid black;}
       		 </style>
       		 <h1 align='center'>Registre individuel des déplacements</h1>
       		 <h3 align='center'> Période du ".$debut." au ".$fin."</h3><br/>
       		 <b>Nom : </b>".strtoupper(classe()->nom)." <b>Prénom : </b>".ucfirst(classe()->prenom)."<br/>
       		 <b>Identifiant RH : </b>".$identifiant."<br/><br/>
       		 <b>Direction : </b>".$direction."<br/>
       		 <b>Service / Code Régate : </b>".$service."<br/><br/>
       		 <table>
       		 	<tr>
       		 		<td>Date début </td>
       		 		<td>Date fin </td>
       		 		<td>Destination </td>
       		 		<td>Motif </td>
       		 		<td>Distance Km</td>
       		 		<td>Immatriculation </td>
       		 	</tr>";
       		$ligne =" ";

       		if(count($result) > 0){
       		 	foreach ($result as $r) {
					$ligne= $ligne."<tr>
						<td>".$r->dte_debut."</td>
						<td>".$r->dte_fin."</td>
						<td>".$r->destination."</td>
						<td>".$r->motif."</td>
						<td>".$r->distance."</td>
						<td>".$r->code_plaque."</td>
					</tr>";
				}
			}

			$content= $content."".$ligne."</table>";
			$registre = array(
	          	'dte_debut'=>$dte_debutf,
	          	'dte_fin'=>$dte_finf,
	          	'contenu'=>$content,
	          	'fk_user' => classe()->id
	        );
	        
	        $this->registre_model->add_registre($registre);
	    	$data['titre'] = "Détail du registre";
			$data['content'] = 'registre/detail_registre';
			$data['results']=$registre;
			$data['result']=$this->registre_model->trouver_id($content);
			$this->load->view('template/template', $data);

		}
	    else
	    {
	    	//afficher la page en fonction de l'utilisateur connectée admin ou simple utilisateur 
	    	$data['titre'] = "Réservation";
			$data['content'] = 'registre/registre';
			$data['results']=$this->registre_model->liste_registre_user();
			$this->load->view('template/template', $data);
		}
	}
	public function registre_pdf($id)
	{
		$result = $this->registre_model->detail_registre($id);
	    $content = $result[0]->contenu.' '.$result[0]->signature_agent.' '.$result[0]->signature_chef;
	    $this->load->library('html2pdf', array('P','A4','fr'));
		$this->html2pdf->WriteHTML($content);
		$this->html2pdf->Output('exemple.pdf');
	    	
	}
	public function valider_registre($id)
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    	else 
    	{
    		$signature = "<br/>Signature numérique du registre : ".$id."<br/><br/><br/>signature de l'agent : ".classe()->nom." ".classe()->prenom;
    		//echo $signature;
    		$this->registre_model->signature_agent($id, $signature);
    		redirect('registre/registre');
    	}
	}
	public function supprimer_registre($id)
	{
		$this->registre_model->supprimer_registre($id);
		redirect('registre/registre');
	}
	public function registre_agent()
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    	//afficher la page en fonction de l'utilisateur connectée admin ou simple utilisateur 
    	$data["results"]= $this->registre_model->list_registre_agents();
    	$data['titre'] = "Registre des agents";
		$data['content'] = 'registre/registre_agents';
		$this->load->view('template/template', $data);
	}
	public function detail_registre_agent($id)
	{
		$data['titre'] = "Registre des agents";
		$data['content'] = 'registre/preview_registre';
		$data['results']=$this->registre_model->detail_registre($id);
		$this->load->view('template/template', $data);
	}
	public function signer_registre($id)
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    	else 
    	{
    		$signature = "<br/><br/>Le hiéarchique habilité à signer : ".classe()->nom." ".classe()->prenom;
    		$this->registre_model->signature_chef($id, $signature);
    		redirect('registre/registre_agent');
    	}
    }
		
}