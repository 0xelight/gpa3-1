<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reserver extends CI_Controller {
	public function index()
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    	if(classe()->voiture_attribue != null)
    	{
    	$id = classe()->voiture_attribue;
    	}
    	$this->form_validation->set_rules('dte_debut', 'Date début', 'trim|required');
    	$this->form_validation->set_rules('hdebut', 'Heure', 'trim|required');
    	$this->form_validation->set_rules('mindebut','Minute','trim|required');
    	$this->form_validation->set_rules('dte_fin','Date fin','trim|required');
    	$this->form_validation->set_rules('hfin','Heure','trim|required');
    	$this->form_validation->set_rules('minfin','Minute','trim|required');
    	$this->form_validation->set_rules('listeVoitureId', 'Voiture', 'trim|required');
    	$this->form_validation->set_rules('destination', 'Destination', 'trim|required');

    
    	if($this->form_validation->run())
    	{
    		$dte_debut =$this->input->post('dte_debut').' '.$this->input->post('hdebut').':'.$this->input->post('mindebut').':00';
    		$dte_fin =$this->input->post('dte_fin').' '.$this->input->post('hfin').':'.$this->input->post('minfin').':00';
    		$pattern = '/([0-9]{2})\-([0-9]{1,2})\-([0-9]{4}) ([0-9]{1,2})\:([0-9]{2})\:([0-9]{2})/i';
			$replacement = '$3-$2-$1 $4:$5:$6';
			$dte_debutf = preg_replace($pattern, $replacement, $dte_debut);
			$dte_finf = preg_replace($pattern, $replacement, $dte_fin);
      		$login = classe()->id;
      		$motif = $this->input->post('motif');
      		$voiture = $this->input->post('listeVoitureId');
	        $data = array(
	          'dte_debut'=>$dte_debutf,
	          'dte_fin'=>$dte_finf,
	          'fk_user'=>$login,
	          'fk_voiture'=>$this->input->post('listeVoitureId'),
	          'destination'=>$this->input->post('destination'),
	          'motif'=>$this->input->post('motif'),
	          'distance'=>$this->input->post('distance'),
	        );
	        $check_reservation = $this->reservation_model->checker_reservation($dte_debutf , $dte_finf);
	        //echo $check_reservation;
	        if($check_reservation == false)
	        {
		        $this->reservation_model->reserver($data);
		        if($this->input->post('dte_debut')<>$this->input->post('dte_fin'))
		        {
		        	//strtoupper($variable) converti une chaine en majuscule
		        	//ucfirst($variable) converti la première lettre en majuscule
		        	//$r = toute les infos de l'utilisateur
		        	//$re = toute les infos de la voiture
		        	$r = $this->utilisateur_model->get_user(classe()->id);
		        	$re = $this->voiture_model->get_voiture($voiture);
		        	$content = 
			       		 "<style type='text/css'>
			       		 #regles{background-color:silver;}
			       		 #table{width:100%;}
			       		 </style>
			       		 <h1 align='center'>REMISAGE A DOMICILE</h1><br/>
						<i>Cette autorisation doit pouvoir être présentée à tout moment.<br/>
						Cette autorisation doit être imprimée en 2 exemplaires: un exemplaire pour l'utilisateur et un exemplaire pour la direction.</i><br/><br/>
						Prériode de validité: du ".$dte_debut." au ".$dte_fin." <br/><br/>
						Demandeur : ".strtoupper(classe()->nom)."  ".ucfirst(classe()->prenom)."<br/><br/>
						Etablissement ou service : ".$r[0]->libelle."<br/><br/>
						Adresse du domicile: ".classe()->adresse." ".classe()->CP." ".classe()->ville."<br/><br/>
						Aller simple domicile-travail: ".classe()->distance_domicile." Km (itinéraire le plus direct)<br/><br/>
						Motif de l'autorisation : ".$motif."<br/><br/>
						Immatriculation du véhicule: ".$re[0]->code_plaque."<br/><br/>
						<div id='regles'>
						<p><b>Règles d’utilisation :</b><br/>
						1 – Les nécessités de service priment sur cette autorisation<br/>
						2 – Le conducteur s’engage à remiser le véhicule sur un lieu autorisé et à prendre toutes mesures de sécurité pour protéger le véhicule et ses accessoires contre le vol<br/>
						3 – En cas d’absences (congés, formation, …), le véhicule doit rester à disposition du service<br/>
						4 – Le transport de personnes extérieures au service est interdit<br/>
						5 – L’utilisation du véhicule pour des besoins personnels et privatifs est interdit<br/>
						6 – Le conducteur est responsable des condamnations pénales et contraventions encourues.
						</p><br/></div><br/>
						<div id='table'>
				
						</div>
							";
					$id_reservation = $this->reservation_model->trouver_id($data);
					$data2 = array(
						'contenu'=>$content,
						'fk_user'=>classe()->id,
						'date_creation'=> date("Y-m-d"),
						'fk_reservation' => $id_reservation[0]->id
					);
					
					$this->remisage_domicile_model->add_remisage($data2); 
					//le bon de remisage est insérer en base, on redirige vas la page avec le bouton de signature
			   		$data['titre'] = "Détail du bon de remisage à domicile";
					$data['content'] = 'reserver/detail_remisage';
					$data['results']=$data2;
					$data['result']=$this->remisage_domicile_model->trouver_id($content);
					$this->load->view('template/template', $data);
		      	}
		        else
		        {
		        redirect('planning/planning');
		    	}
		    }
		    else
		    {
		    	$data['error'] = 'vous avez déjà une réservation dans ces dates';
	    		$data['titre'] = "Réservation";
				$data['content'] = 'reserver/reserver';
				if(classe()->voiture_attribue != null)
    			{
					$data['voiture'] = $this->voiture_model->get_voiture($id);

				}
				$this->load->view('template/template', $data);
			}  
    	}
	    else
	    {
	    	$data['titre'] = "Réservation";
			$data['content'] = 'reserver/reserver';
			if(classe()->voiture_attribue != null)
    		{
				$data['voiture'] = $this->voiture_model->get_voiture($id);
			}	
			$this->load->view('template/template', $data);
		}
	}
	public function chercher_voiture()
	{
		//appeller par la fonction ajax, à pour but de chercher les voitures dispo dans les dates indiqués
		$leDebut= $_POST['leDebut']." ".$_POST['HDebut'].":".$_POST['minDebut'].":00";
		$laFin= $_POST['laFin']." ".$_POST['HFin'].":".$_POST['minFin'].":00";
		$debut = $_POST['leDebut'];
		$fin = $_POST['laFin'];
		$hdebut = $_POST['HDebut'];
		$hfin = $_POST['HFin'];
		$results= $this->reservation_model->rechercher_voiture($leDebut , $laFin, $debut, $fin, $hdebut, $hfin);
		echo json_encode($results);
	}
	public function annuler()
	{
		//affiche les reservations en cours de l'utilisateur dans un tableau
		if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    	$this->reservation_model->maj_statut();
    	$data['titre'] = "Annuler réservation";
		$data['content'] = 'reserver/annuler';
		$data['result']=$this->reservation_model->liste_reservation_user();
		$this->load->view('template/template', $data);
		
	}
	public function annuler_reservation($idAsupprimer)
	{
		//supprime la reservation ciblé
		$this->remisage_domicile_model->supprimer_remisage($idAsupprimer);
		$this->reservation_model->supprimer_reservation($idAsupprimer);
		redirect('reserver/annuler');

	}
	public function historique()
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
		$data["results"]= $this->reservation_model->list_reservation_service();
    	$data['titre'] = "Historique des réservations";
		$data['content'] = 'reserver/historique';
		$this->load->view('template/template', $data);
	}
	public function detail_remisage($id){
		$data['titre'] = "Registre des agents";
		$data['content'] = 'registre/preview_registre';
		$data['results']=$this->remisage_domicile_model->detail_remisage($id);
		$this->load->view('template/template', $data);
	}
	public function valider_remisage($id)
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    	else 
    	{
    		$signature = "<br/>Signature numérique du bon : ".$id."<br/><br/><br/>Lu et approuvé le ".date('d/m/Y')." par ".classe()->nom." ".classe()->prenom;
    		//echo $signature;
    		$this->remisage_domicile_model->signature_agent($id, $signature);
    		redirect('planning/planning');
    	}
	}
	public function remisage_pdf($id)
	{
		$result = $this->remisage_domicile_model->detail_remisage($id);
	    $content = $result[0]->contenu.' '.$result[0]->signature_agent.' '.$result[0]->signature_superieur;
	    $this->load->library('html2pdf', array('P','A4','fr'));
		$this->html2pdf->WriteHTML($content);
		$this->html2pdf->Output('exemple.pdf');
	    	
	}
	public function remisage()
	{
		$data['titre'] = "Remisage à domicile";
		$data['content'] = 'reserver/remisage';
		$data['results']=$this->remisage_domicile_model->liste_remisage_user();
		$this->load->view('template/template', $data);
	}
	public function remisage_agent()
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    	//afficher la page en fonction de l'utilisateur connectée admin ou simple utilisateur 
    	$data["results"]= $this->remisage_domicile_model->list_remisage_agents();
    	$data['titre'] = "Remisage à domicile des agents";
		$data['content'] = 'reserver/remisage_agents';
		$this->load->view('template/template', $data);
	}
	public function detail_remisage_agent($id)
	{
		$data['titre'] = "Remisage à domicile des agents";
		$data['content'] = 'reserver/remisage_preview';
		$data['results']=$this->remisage_domicile_model->detail_remisage($id);
		$this->load->view('template/template', $data);
	}
	public function signer_remisage($id)
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    	else 
    	{
    		$signature = "<br/><br/>Lu et approuvé le ".date('d/m/Y')." par le hiéarchique habilité à signer : ".classe()->nom." ".classe()->prenom;
    		$this->remisage_domicile_model->signature_superieur($id, $signature);
    		redirect('reserver/remisage_agent');
    	}
    }	
}