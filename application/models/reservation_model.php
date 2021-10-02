<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation_model extends CI_Model {
	function planning()
	{
		//selection des réservication en cours du service de l'utilisateur
		$this->db->where('user.fk_service',classe()->service);
		$this->db->where('reservation.statut','1');
		$this->db->order_by("dte_debut", "desc");
		$this->db->join('voiture', 'voiture.id = reservation.fk_voiture');
		$this->db->join('user', 'user.id = reservation.fk_user');
		$query = $this->db->get('reservation');

		if($query->num_rows() > 0)
	    {
	      	foreach($query->result() as $row)
	      	{
		      	//regex pour converter les dates format US en FR
		      	$pattern = '/([0-9]{4})\-([0-9]{2})\-([0-9]{2}) ([0-9]{2})\:([0-9]{2})\:([0-9]{2})/i';
				$replacement = '$1-$2-$3';
				$datreplace = '$4:$5';
				$start = $row->dte_debut;
				$end = $row->dte_fin;
				$hstart= preg_replace($pattern, $datreplace, $start);
				$hend= preg_replace($pattern, $datreplace, $end);
				//Fin regex
				$title = $row->nom." ".$row->code_plaque." ".$row->destination." "." début : ".$hstart." fin : ".$hend;
				$start = preg_replace($pattern, $replacement, $start);
				$end = preg_replace($pattern, $replacement, $end);
				$end = date("Y-m-d", strtotime($end."+1 day") );
	   			$eventArray['title'] =  $title;
	   			$eventArray['start'] = $start;
	   			$eventArray['end'] = $end;
	  			$events[] = $eventArray;
			}
	    	return json_encode($events);
	    }
	}
	function reserver($data)
	{
		//insert la réservation en base de donnée
		$this->db->insert('reservation',$data);
	}
	function rechercher_voiture($leDebut, $laFin, $debut, $fin, $hdebut, $hfin)
	{
		//REGEX convertion date FR en US
		$pattern = '/([0-9]{2})\-([0-9]{1,2})\-([0-9]{4}) ([0-9]{1,2})\:([0-9]{2})\:([0-9]{2})/i';
		$replacement = '$3-$2-$1 $4:$5:$6';
		$leDebut = preg_replace($pattern, $replacement, $leDebut);
		$laFin = preg_replace($pattern, $replacement, $laFin);
		$service = classe()->service;
		// if pour savoir si on intègre la voiture attribué
		if( classe()->voiture_attribue != null)
		{
			$this->db->select('id, code_plaque');
			$this->db->from('voiture');
			$this->db->where('id', classe()->voiture_attribue);
			$requete = $this->db->get();
			//echo "<br/>".$this->db->last_query()."<br/>";
			$row = $requete->row();
			$result[]= array("value" => $row->id , "label" => $row->code_plaque." voiture attribué") ;
		}
		//if pour savoir si on prend en compte les voitures dispo en journée
		if($debut == $fin AND $hdebut >= '8' AND $hfin <= '17')
		{
			//echo "<br/>a";
			//compte du nombre de voiture dispo dans le service lors des dates indiquées
			$this->db->select('voiture.id');
			$this->db->from('voiture');
			$this->db->join('reservation', 'voiture.id=reservation.fk_voiture');
			$this->db->where("dte_debut BETWEEN '$leDebut' AND '$laFin'");
			$this->db->where("dte_fin BETWEEN '$leDebut' AND '$laFin'");
			$this->db->or_where("dte_debut",$leDebut);
			$this->db->where("dte_fin",$laFin);
			$this->db->or_where('dte_debut <=',$leDebut);
			$this->db->where("dte_fin BETWEEN '$leDebut' AND '$laFin'");
			$this->db->or_where("dte_debut BETWEEN '$leDebut' AND '$laFin'");
			$this->db->where('dte_fin >=',$laFin);
			$this->db->or_where('dte_debut <=',$leDebut);
			$this->db->where('dte_fin >=',$laFin);
			$this->db->where('reservation.statut', '1');
			$query = $this->db->get();
			$sous_requete = $query->result();
			//echo "<br/>".$this->db->last_query()."<br/>";
			//stockage des résultat dans un array SIMPLE
			$data = array();
			foreach ($sous_requete as $r) 
			{
				array_push($data, $r->id);
			}
			//Requete mère
			$this->db->select('id, code_plaque');
			$this->db->from('voiture');
			$this->db->where('FK_service', $service);
			$this->db->where('statut', '1');
			if($data != null){
			$this->db->where_not_in('voiture.id', $data);
			}
			$this->db->or_where('statut', '2');
			$this->db->where('FK_service', $service);
			if($data != null){
			$this->db->where_not_in('voiture.id', $data);
			}
			$mother_query = $this->db->get();
			$mere_requete = $mother_query->result();
			$nombre = $mother_query->num_rows();
			//si le nombre de voiture est > 0 on prend les voitures de notre requetes 
			if($nombre >'0')
			{
				foreach ($mere_requete as $mr) 
				{
					$result[]= array("value" => $mr->id , "label" => $mr->code_plaque) ;
				}
			}
		}
		else
		{
			//echo "<br/>b";
			//compte du nombre de voiture dispo dans le service lors des dates indiquées
			$this->db->select('voiture.id');
			$this->db->from('voiture');
			$this->db->join('reservation', 'voiture.id=reservation.fk_voiture');
			$this->db->where("dte_debut BETWEEN '$leDebut' AND '$laFin'");
			$this->db->where("dte_fin BETWEEN '$leDebut' AND '$laFin'");
			$this->db->or_where("dte_debut",$leDebut);
			$this->db->where("dte_fin",$laFin);
			$this->db->or_where('dte_debut <=',$leDebut);
			$this->db->where("dte_fin BETWEEN '$leDebut' AND '$laFin'");
			$this->db->or_where("dte_debut BETWEEN '$leDebut' AND '$laFin'");
			$this->db->where('dte_fin >=',$laFin);
			$this->db->or_where('dte_debut <=',$leDebut);
			$this->db->where('dte_fin >=',$laFin);
			$this->db->where('reservation.statut', '1');
			$query = $this->db->get();
			$sous_requete = $query->result();
			//echo "<br/>".$this->db->last_query()."<br/>";
			//stockage des résultat dans un array SIMPLE
			$data = array();
			foreach ($sous_requete as $r) 
			{
				array_push($data, $r->id);
			}
			//var_dump($data);
			//Requete mère
			$this->db->select('id, code_plaque');
			$this->db->from('voiture');
			$this->db->where('FK_service', $service);
			$this->db->where('statut', '1');
			if($data != null)
			{
			$this->db->where_not_in('voiture.id', $data);
			}
			$mother_query = $this->db->get();
			$mere_requete = $mother_query->result();
			$nombre = $mother_query->num_rows();
			//echo "<br/>".$this->db->last_query()."<br/>";
			//si le nombre de voiture est > 0 on prend les voitures de notre requetes 
			if($nombre >'0')
			{
				foreach ($mere_requete as $mr) 
				{
					$result[]= array("value" => $mr->id , "label" => $mr->code_plaque) ;
				}
			}

		}
		//echo "<br/>".$this->db->last_query()."<br/>";
		return $result;
		//print_r($result);
	}
	function checker_reservation($dte_debutf , $dte_finf)
	{
		//vérifie si l'utilisateur n'a pas déjà une réservation dans les dates
		$id = classe()->id;
		$this->db->select('*');
		$this->db->from('reservation');
		$where = "((`dte_debut` BETWEEN '$dte_debutf' AND '$dte_finf' 
					AND `dte_fin` BETWEEN '$dte_debutf' AND '$dte_finf')
					OR (`dte_debut` = '$dte_debutf' 
					AND `dte_fin` = '$dte_finf') 
					OR (`dte_debut` <= '$dte_debutf' 
					AND `dte_fin` BETWEEN '$dte_debutf' AND '$dte_finf') 
					OR (`dte_debut` BETWEEN '$dte_debutf' AND '$dte_finf' 
					AND `dte_fin` >= '$dte_finf') 
					OR (`dte_debut` <= '$dte_debutf' 
					AND `dte_fin` >= '$dte_finf')) 
					AND `reservation`.`statut` = '1' 
					AND `fk_user` = '$id'";
		$this->db->where($where);
		$query = $this->db->get();
		//echo "<br/>".$this->db->last_query()."<br/>";
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function liste_reservation_user()
	{
		//liste les réservation d'un utilisateur
		$this->db->select('reservation.id, login, dte_debut, dte_fin, code_plaque, modele, destination, motif, distance');
		$this->db->where('reservation.fk_user',classe()->id);
		$this->db->where('reservation.statut','1');
		$this->db->order_by("dte_debut", "desc");
		$this->db->join('voiture', 'voiture.id = reservation.fk_voiture');
		$this->db->join('user', 'user.id = reservation.fk_user');
		$query = $this->db->get('reservation');
		if($query->num_rows() > 0)
	    {
	      foreach($query->result() as $row)
	      {
	      	//regex pour converter les dates format US en FR
	      	$pattern = '/([0-9]{4})\-([0-9]{2})\-([0-9]{2}) ([0-9]{2})\:([0-9]{2})\:([0-9]{2})/i';
			$replacement = '$3-$2-$1 $4:$5';
			$datreplace = '$4:$5';
			$start = $row->dte_debut;
			$end = $row->dte_fin;
			$row->dte_debut= preg_replace($pattern, $replacement, $start);
			$row->dte_fin= preg_replace($pattern, $replacement, $end);
			$data[] = $row;
			}
			return $data;
		}
	}
	function supprimer_reservation($idAsupprimer)
	{
		$this->db->where('id', $idAsupprimer);
		$this->db->delete('reservation');
	}
	function list_reservation_service()
	{
		$this->db->select('reservation.id, dte_debut , dte_fin, nom , prenom , code_plaque , modele, reservation.statut , destination');
		$this->db->join('user', 'user.id = reservation.fk_user');
		$this->db->join('voiture', 'voiture.id = reservation.fk_voiture');
		$this->db->where('user.fk_service', classe()->service);
	    $query = $this->db->get('reservation');
	    if($query->num_rows() > 0)
	      {
	        foreach($query->result() as $row)
	        {
	          $data[] = $row;
	        }
	      return $data;
	    }
	}
	function liste_reservation_user_sur_duree($dte_debutf, $dte_finf)
	{
		$this->db->select('reservation.id, login, dte_debut, dte_fin, code_plaque, modele, destination, motif, distance');
		$this->db->where('reservation.fk_user',classe()->id);
		//$this->db->where('reservation.statut','1');
		$this->db->where("dte_fin BETWEEN '$dte_debutf' AND '$dte_finf'");
		$this->db->order_by("dte_debut", "desc");
		$this->db->join('voiture', 'voiture.id = reservation.fk_voiture');
		$this->db->join('user', 'user.id = reservation.fk_user');
		$query = $this->db->get('reservation');
		if($query->num_rows() > 0)
	    {
	      foreach($query->result() as $row)
	      {
	      	//regex pour converter les dates format US en FR
	      	$pattern = '/([0-9]{4})\-([0-9]{2})\-([0-9]{2}) ([0-9]{2})\:([0-9]{2})\:([0-9]{2})/i';
			$replacement = '$3-$2-$1 $4:$5';
			$datreplace = '$4:$5';
			$start = $row->dte_debut;
			$end = $row->dte_fin;
			$row->dte_debut= preg_replace($pattern, $replacement, $start);
			$row->dte_fin= preg_replace($pattern, $replacement, $end);
			$data[] = $row;
			}
			return $data;
		}
	}
	function trouver_id($data){
		$this->db->select('id');
  		$this->db->where('dte_debut', $data['dte_debut']);
  		$this->db->where('dte_fin', $data['dte_fin']);
  		$this->db->where('fk_voiture',$data['fk_voiture']);
  		$this->db->where('fk_user',classe()->id);
  		$query = $this->db->get('reservation');
		if($query->num_rows() > 0)
	    { 
	    	foreach($query->result() as $row)
	      	{
				$data[] = $row;
			}
	    	return $data;
	    }
	}
	function maj_statut()
	{
		$data = array(
               'statut' => '0'
               );
		$date = date('Y-m-d H:i:s');
		$this->db->where('dte_fin <', $date);
		$this->db->where('statut' , '1');
		$this->db->update('reservation' ,$data);
	}
	
}