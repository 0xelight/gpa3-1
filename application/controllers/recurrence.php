<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recurrence extends CI_Controller {

	public function index()
	{
		//si la personne n'est pas connectée redirection sur la page login
		 if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    	$this->form_validation->set_rules('dte_debut', 'Date début', 'trim|required');
    	$this->form_validation->set_rules('hdebut', 'Heure', 'trim|required');
    	$this->form_validation->set_rules('mindebut','Minute','trim|required');
    	$this->form_validation->set_rules('dte_fin','Date fin','trim|required');
    	$this->form_validation->set_rules('hfin','Heure','trim|required');
    	$this->form_validation->set_rules('minfin','Minute','trim|required');
    	$this->form_validation->set_rules('destination', 'Destination', 'trim|required');
    	$this->form_validation->set_rules('recurrence', 'Récurrence', 'trim|required');
    	$this->form_validation->set_rules('nbrecurrence', 'Nombre de récurrence', 'trim|required');
    	if($this->form_validation->run())
    	{
    		//Stockage des donnée du formulaire dans des variables simple
    		$dte_debut = $this->input->post('dte_debut');
    		$hdebut = $this->input->post('hdebut').':'.$this->input->post('mindebut').':00';
    		$dte_fin = $this->input->post('dte_fin');
    		$hfin = $this->input->post('hfin').':'.$this->input->post('minfin').':00';
    		$interval = $this->input->post('recurrence');
    		$pattern = '/([0-9]{2})\-([0-9]{1,2})\-([0-9]{4})/i';
			$replacement = '$3-$2-$1';
			$dte_debut = preg_replace($pattern, $replacement, $dte_debut);
			$login = classe()->id;
      		$motif = $this->input->post('motif');
      		$voiture = classe()->voiture_attribue;
    		//Déclaration des variable pour le datePeriod
    		$start = new DateTime($dte_debut);
    		$interval = new DateInterval($interval);
    		$nbrecurrence = $this->input->post('nbrecurrence')-1;
    		$period = new DatePeriod($start, $interval, $nbrecurrence);
    		//convertion des date en timestamp
    		$timestamp_dte_debut = strtotime($dte_debut);
    		$timestamp_dte_fin = strtotime($dte_fin);
    		$diftime = $timestamp_dte_fin - $timestamp_dte_debut;
    		//Parcours des dates de la période
    		foreach ($period as $date) {
    			//calcule des date de fin
    			$dte_fin = strtotime($date->format('Y-m-d'))+$diftime;
    			$dte_fin = date("Y-m-d ",$dte_fin);
    			//echo $date->format('Y-m-d')."<br/>";
    			//echo $dte_fin."<br/><br/>";
    			$data = array(
		          'dte_debut'=>$date->format('Y-m-d')." ".$hdebut,
		          'dte_fin'=>$dte_fin." ".$hfin,
		          'fk_user'=>$login,
		          'fk_voiture'=>classe()->voiture_attribue,
		          'destination'=>$this->input->post('destination'),
		          'motif'=>$motif,
		          'distance'=>$this->input->post('distance'),
	        	);
	        	//var_dump($data);
    			//Vérifier si une réservation n'est pas déja fait dans les dates
    			$check_reservation = $this->reservation_model->checker_reservation($date->format('Y-m-d')." ".$hdebut , $dte_fin." ".$hfin);
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
						Prériode de validité: du ".$date->format('Y-m-d')." au ".$dte_fin." <br/><br/>
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
						//var_dump($data2);
						$lesdata[] = $data2;
						$this->remisage_domicile_model->add_remisage($data2); 
					}
	        	}
    		}
    		if($this->input->post('dte_debut')<>$this->input->post('dte_fin'))
		    {
		    	//var_dump($lesdata);
		    	$data['titre'] = "Détail des bons de remisage à domicile";
				$data['content'] = 'recurrence/detail_des_remisage';
				$data['results']=$this->remisage_domicile_model->list_des_remisage($lesdata);
				$this->load->view('template/template', $data);
		    }
		    else
		    {
		    	redirect("planning/planning");
		    }
    	}
    	else
	    {
	    	$data['titre'] = "Réservation récurrente";
			$data['content'] = 'recurrence/reserver';	
			$this->load->view('template/template', $data);
		}

	}
	public function valider_remisage($date_creation)
	{
		if($this->session->userdata('login') == $this->session->userdata('logged'))
    	{
      		redirect('authentification');
    	}
    	else 
    	{
    		//echo $date_creation;
    		$this->remisage_domicile_model->signature_agent_date($date_creation);
    		
    		redirect('planning/planning');
    	}
	}
	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
?>