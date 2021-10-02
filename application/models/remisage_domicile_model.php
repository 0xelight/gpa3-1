<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Remisage_domicile_model extends CI_Model {
	function add_remisage($data){
		$this->db->insert('remisage_domicile',$data);
	}
	function trouver_id($content){
		$this->db->select('id');
  		$this->db->where('contenu', $content);
  		$query = $this->db->get('remisage_domicile');
		if($query->num_rows() > 0)
	    { 
	    	foreach($query->result() as $row)
	      	{
				$data[] = $row;
			}
	    	return $data;
	    }
	}
	function signature_agent($id, $signature)
  	{
  		$data = array(
               'signature_agent' => $signature,
               'statut' => '1'
               );
    $this->db->where('id', $id);
    $this->db->update('remisage_domicile' ,$data);
  	}
  	function detail_remisage($id)
  	{
  		$this->db->where('id' , $id);
	    $query = $this->db->get('remisage_domicile');
	    if($query->num_rows() > 0)
	    {
	      foreach($query->result() as $row)
	      {
	      $data[] = $row;
	      } 
	    return $data;
	    }
  	}
  	function liste_remisage_user()
	{
		//liste les remisage_domicile de l'utilisateur
		$this->db->select('remisage_domicile.id, date_creation, statut, contenu, signature_agent, signature_superieur');
		$this->db->where('remisage_domicile.fk_user',classe()->id);
		$this->db->order_by("date_creation", "desc");
		$this->db->join('user', 'user.id = remisage_domicile.fk_user');
		$query = $this->db->get('remisage_domicile');
		if($query->num_rows() > 0)
	    {
	    	foreach($query->result() as $row)
	      	{
	      		//regex pour converter les dates format US en FR
	      		$pattern = '/([0-9]{4})\-([0-9]{2})\-([0-9]{2})/i';
				$replacement = '$3-$2-$1 $';
				$date = $row->date_creation;
				$row->dte_debut= preg_replace($pattern, $replacement, $date);
				$data[] = $row;
			}
			return $data;
		}
	}
	function supprimer_remisage($id)
  	{
    	$this->db->where('fk_reservation', $id);
    	$this->db->delete('remisage_domicile');
  	}
  	function list_remisage_agents()
  	{
  		$this->db->select('remisage_domicile.id, date_creation, statut, contenu, signature_agent, signature_superieur, nom, prenom');
		$this->db->where('user.fk_service',classe()->service);
		$this->db->where('remisage_domicile.statut >','0');
		//$this->db->where('remisage_domicile.statut','2');
		$this->db->order_by("date_creation", "desc");
		$this->db->join('user', 'user.id = remisage_domicile.fk_user');
		$query = $this->db->get('remisage_domicile');
		if($query->num_rows() > 0)
	    {
	    	foreach($query->result() as $row)
	      	{
	      		//regex pour converter les dates format US en FR
	      		$pattern = '/([0-9]{4})\-([0-9]{2})\-([0-9]{2})/i';
				$replacement = '$3-$2-$1 ';
				$start = $row->date_creation;
				$row->date_creation= preg_replace($pattern, $replacement, $start);
				$data[] = $row;
			}
			return $data;
		}
  	}
  	function signature_superieur($id, $signature)
  	{
  		$data = array(
               'signature_superieur' => $signature,
               'statut' => '2'
               );
    	$this->db->where('id', $id);
    	$this->db->update('remisage_domicile' ,$data);
  	}
  	function list_des_remisage($lesdata)
  	{
  		//var_dump($lesdata);
  		foreach ($lesdata as $ladata) 
  		{
  			//var_dump($ladata);
  			$this->db->where('contenu', $ladata['contenu']);
  			$query = $this->db->get('remisage_domicile');
  			if($query->num_rows() > 0)
  			{
  				foreach ($query->result() as $row) 
  				{
  					$data[] = $row;
  				}
  			}
  		}
  		//var_dump($data);
  		return $data;
  	}
  	function signature_agent_date($date_creation)
  	{
  		$this->db->where('date_creation', $date_creation);
  		$this->db->where('fk_user', classe()->id);
  		$query = $this->db->get('remisage_domicile');
  		//echo "<br/>".$this->db->last_query()."<br/>";
  		//echo $query->num_rows();
  		if($query->num_rows() > 0)
  		{
  			foreach ($query->result() as $row) 
  			{
  				//var_dump($row);
  				$id = $row->id;
    			$signature = "<br/>Signature numérique du bon : ".$id."<br/><br/><br/>Lu et approuvé le ".date('d/m/Y')." par ".classe()->nom." ".classe()->prenom;
				$data = array(
			        'signature_agent' => $signature,
			        'statut' => '1'
			    );
			    //var_dump($data);
				$this->db->where('id', $id);
				$this->db->where('fk_user', classe()->id);
				$this->db->update('remisage_domicile' ,$data);
  			}
  		}
  	}
}