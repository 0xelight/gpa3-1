<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voiture_model extends CI_Model {
	function get_voiture($id)
  	{
      //retourne les infos d'une voiture
    	$this->db->select('voiture.id, code_plaque, modele, commentaire, libelle,voiture.statut, fk_service, disponible_journee');
    	$this->db->where('voiture.id',$id);
    	$this->db->join('service', 'service.id = voiture.fk_service');
    	$query = $this->db->get('voiture');
    	if($query->num_rows() > 0)
   	 	{
      		foreach($query->result() as $row)
      		{
      			$data[] = $row;
      		} 
    		return $data;
    		}
  	}
  function liste_voiture_toujours_reserve()
  {
    //retourne les voiture toujours réserver du service de l'utilisateur
    $service = classe()->service;
    $this->db->select('id, code_plaque');
    $this->db->where('fk_service', $service);
    $this->db->where('statut' , '2');
    $query = $this->db->get('voiture');
    if($query->num_rows() > 0)
    {
      foreach($query->result() as $row)
      {
      $data[] = $row;
      } 
    return $data;
    }
  }
  function list_voiture_service()
  {
    //liste les voitures du service
    $this->db->select('voiture.id, code_plaque, voiture.statut, modele, commentaire, libelle, disponible_journee');
    $this->db->where('fk_service', classe()->service);
    $this->db->join('service', 'service.id = voiture.fk_service');
    $query = $this->db->get('voiture');
    if($query->num_rows() > 0)
    {
        foreach($query->result() as $row)
        {
          $data[] = $row;
        }
      return $data;
    }
  }
  function verifier_code($voiture)
  {
    //vérifie si une voiture existe déjà avec le code_plaque $voiture
    $this->db->where('code_plaque', $voiture);
    $query = $this->db->get('voiture');
    if ($query->num_rows() > 0) {
      return false;
    }
    else
    {
      return true;
    }
  }
  function add_voiture($data)
  {
    //ajoute une voiture en base de données
    $this->db->insert('voiture',$data);
  }
  function modifier_voiture($data)
  {
    //modifier la voiture
    //si le statut est différent de 3 on modifie la base de donnée pour modifier la voiture attribué de l'utilisateur qui a la voiture
    if($data['statut'] != 3)
    {
      $data2 = array(
               'voiture_attribue' => NULL
            );
      $this->db->where('voiture_attribue',$data['id']);
      $this->db->update('user', $data2);
    }
    $this->db->where('id', $data['id']);
    $this->db->update('voiture' ,$data);
  }
  function supprimer_voiture($id)
  {
    //supprime la voiture $id
    $this->db->where('id', $id);
    $this->db->delete('voiture');
  }
  function check_attribue($id)
  {
    //vérifie si la voiture est attribue à un utilisateur
    $this->db->where('voiture_attribue', $id);
    $query = $this->db->get('user');
    if ($query->num_rows() > 0) {
      return false;
    }
    else
    {
      return true;
    }
  }
  function modifier_disponible($data){
    $this->db->where('id', classe()->voiture_attribue);
    $this->db->update('voiture' ,$data);

  }
  function list_voiture()
  {
    //liste les voitures du service
    $this->db->select('voiture.id, code_plaque, voiture.statut, modele, commentaire, libelle, disponible_journee');
    $this->db->join('service', 'service.id = voiture.fk_service');
    $query = $this->db->get('voiture');
    if($query->num_rows() > 0)
    {
        foreach($query->result() as $row)
        {
          $data[] = $row;
        }
      return $data;
    }
  }
}