<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_model extends CI_Model {

  	function liste_service()
  	{
  		//retourne la liste des services
      	$query = $this->db->get('service');
      	if($query->num_rows() > 0)
      	{
        		foreach($query->result() as $row)
        		{
        			$data[] = $row;
        		} 
      		return $data;
      	}
    }
    function get_service_user()
    {
      //retourne les infos du service de l'utilisateur connecté
      $this->db->where('id',classe()->service);
      $query = $this->db->get('service');
      if($query->num_rows() > 0)
      {
        foreach($query->result() as $row)
        {
        $data[] = $row;
        } 
      return $data;
      }
    }
    function add_service($data)
  {
    //ajoute un service en base de données
    $this->db->insert('service',$data);
  }
  function verifier_service($libelle)
  {
    //vérifie si un service existe déjà avec le libelle $libelle
    $this->db->where('libelle', $libelle);
    $query = $this->db->get('service');
    if ($query->num_rows() > 0) {
      return false;
    }
    else
    {
      return true;
    }
  }
  function activer_service($id)
  {
    $data = array(
               'statut' => '1',
               );
    $this->db->where('id', $id);
    $this->db->update('service' ,$data);
  }
  function desactiver_service($id)
  {
    $data = array(
               'statut' => '0',
               );
    $this->db->where('id', $id);
    $this->db->update('service' ,$data);

  }
  function get_service($id)
  {
    $this->db->where('id',$id);
    $query = $this->db->get('service');
    if($query->num_rows() > 0)
    {
      foreach($query->result() as $row)
      {
        $data[] = $row;
      } 
    return $data;
    }
   } 
   function modifier_service($data)
   {
    $this->db->where('id', $data['id']);
    $this->db->update('service' ,$data);
   }
}