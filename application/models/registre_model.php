<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registre_model extends CI_Model {
	function liste_registre_user()
	{
		//liste les registre de l'utilisateur
		$this->db->select('registre.id, dte_debut, dte_fin, statut, contenu, signature_agent, signature_chef');
		$this->db->where('registre.fk_user',classe()->id);
		$this->db->order_by("dte_debut", "desc");
		$this->db->join('user', 'user.id = registre.fk_user');
		$query = $this->db->get('registre');
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
	function add_registre($data)
  	{
    	$this->db->insert('registre',$data);
  	}
  	function detail_registre($id)
  	{
  		$this->db->where('id' , $id);
	    $query = $this->db->get('registre');
	    if($query->num_rows() > 0)
	    {
	      foreach($query->result() as $row)
	      {
	      $data[] = $row;
	      } 
	    return $data;
	    }
  	}
  	function trouver_id($content)
  	{
  		$this->db->select('id');
  		$this->db->where('contenu', $content);
  		$query = $this->db->get('registre');
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
    $this->db->update('registre' ,$data);
  	}
  	function list_registre_agents()
  	{
  		$this->db->select('registre.id, dte_debut, dte_fin, statut, contenu, signature_agent, signature_chef, nom, prenom');
		$this->db->where('user.fk_service',classe()->service);
		$this->db->where('registre.statut >','0');
		//$this->db->where('registre.statut','2');
		$this->db->order_by("dte_debut", "desc");
		$this->db->join('user', 'user.id = registre.fk_user');
		$query = $this->db->get('registre');
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
  	function signature_chef($id, $signature)
  	{
  		$data = array(
               'signature_chef' => $signature,
               'statut' => '2'
               );
    	$this->db->where('id', $id);
    	$this->db->update('registre' ,$data);
  	}
  	function supprimer_registre($id)
  	{
    	$this->db->where('id', $id);
    	$this->db->delete('registre');
  	}
}
