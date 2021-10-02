<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilisateur_model extends CI_Model {

	function get_admin()
  	{
  		//retourne la liste des admin
    	$this->db->where('compte','2');
    	$query = $this->db->get('user');
    	if($query->num_rows() > 0)
    	{
      		foreach($query->result() as $row)
      		{
      			$data[] = $row;
      		} 
    		return $data;
    	}
  	}
  function verifier_pseudo($pseudo)
  {
    //vérifie si un compte existe déjà avec le pseudo $pseudo
    $this->db->where('login', $pseudo);
    $query = $this->db->get('user');
    if ($query->num_rows() > 0) {
      return false;
    }
    else
    {
      return true;
    }
  }
  function inscription($data)
  {
    //ajoute un utilisateur en base de donnée
    $this->db->insert('user',$data);
  }
  function verifier_infos($pseudo , $question, $reponse)
  {
    //vérifie que les infos de la modification de mot de passe corresponde à celle de l'utilisateur ciblé
    $this->db->where('login' , $pseudo);
    $this->db->where('question' , $question);
    $this->db->where('reponse' , $reponse);
    $query = $this->db->get('user');
    if ($query->num_rows() > 0) {
      return true;
    }
    else
    {
      return false;
    }
  }
  function modifier_passe($data , $pseudo)
  {
    //change le mot de passe
    $this->db->where('login' , $pseudo);
    $this->db->update('user', $data);
  }
  function check_id($pseudo,$pass)
  {
    //si le pseudo et le mot de passe sont bons, stock les donnée de l'utilisateur dans un array
    $this->db->select('user.id id, login, nom, fk_service, prenom, mail, compte, telephone, adresse, CP, ville, distance_domicile, voiture_attribue, libelle, REGATE, option_registre, superieur');
    $this->db->where('login',$pseudo);
    $this->db->where('password',sha1($pass));
    $this->db->from('user');
    $this->db->join('service', 'service.id = user.fk_service');
    $query = $this->db->get();

    if ($query->num_rows() > 0) 
    {
      $row = $query->row();
      var_dump($row);

      $data=new ArrayObject;
      $data->log = $row->login;
      $data->nom = $row->nom; 
      $data->id = $row->id; 
      $data->service = $row->fk_service;
      $data->prenom = $row->prenom; 
      $data->mail = $row->mail;
      $data->compte = $row->compte;
      $data->telephone = $row->telephone;
      $data->adresse = $row->adresse;
      $data->CP = $row->CP;
      $data->ville= $row->ville;
      $data->distance_domicile = $row->distance_domicile;
      $data->voiture_attribue = $row->voiture_attribue;
      $data->superieur = $row->superieur;   
      $data->logged = TRUE; 
      $data->option_registre = $row->option_registre;
      $data->REGATE = $row->REGATE;
      $data->libelle = $row->libelle;
      return $data;
    } 
    else 
    {
      return false;
    }          
  }
  function get_user($id)
  {
    //chercher les infos de l'utilisateur avec id == $id
    $this->db->select('u.id, u.nom, u.prenom, u.login, u.compte, libelle, u.mail, u.telephone, u.adresse, u.ville, u.CP,u.distance_domicile, u.fk_service service, u.voiture_attribue, code_plaque, u.superieur, supp.nom nomsupp, supp.prenom prenomsupp');
    $this->db->where('u.id',$id);
    $this->db->from('user u');
    $this->db->join('service', 'service.id = u.fk_service');
    $this->db->join('voiture', 'voiture.id = u.voiture_attribue');
    $this->db->join('user supp', 'u.superieur=supp.id');
    $query = $this->db->get();
    if($query->num_rows() > 0)
    {
      foreach($query->result() as $row)
      {
      $data[] = $row;
      } 
    
    }
    //si l'utilisateur n'a pas de voiture attribuer on cherche sans
    else
    {
      $this->db->select('u.id, u.nom, u.prenom, u.login, u.compte, libelle, u.mail, u.telephone, u.adresse, u.ville, u.CP,u.distance_domicile, u.fk_service service, u.voiture_attribue ,u.superieur, supp.nom nomsupp, supp.prenom prenomsupp');
      $this->db->where('u.id',$id);
      $this->db->from('user u');
      $this->db->join('service', 'service.id = u.fk_service');
      $this->db->join('user supp', 'u.superieur=supp.id');
      $query = $this->db->get();
      if ($query->num_rows() > 0)
      {
        foreach($query->result() as $row)
        {
        $data[] = $row;
        }
      }
      //si l'utilisateur n'a pas de supérieur on cherche sans
      else
      {
        $this->db->select('u.id, u.nom, u.prenom, u.login, u.compte, libelle, u.mail, u.telephone, u.adresse, u.ville, u.CP,u.distance_domicile, u.fk_service service, u.voiture_attribue ,u.superieur');
        $this->db->where('u.id',$id);
        $this->db->from('user u');
        $this->db->join('service', 'service.id = u.fk_service');
        $query = $this->db->get();
        foreach($query->result() as $row)
        {
        $data[] = $row;
        }

      } 
    }
    return $data;
  }
  function list_utilisat()
  {
    //liste tout les utilisateurs
    $this->db->select('user.id, nom, prenom, login, compte, libelle');
    $this->db->join('service', 'service.id = user.fk_service');
    $query = $this->db->get('user');
    if($query->num_rows() > 0)
      {
        foreach($query->result() as $row)
        {
          $data[] = $row;
        }
      return $data;
    }
  }
  function list_utilisat_service()
  {
    //liste les utilisateur appartenant au même service que l'utilisateur connecté
    $this->db->select('user.id, nom, prenom, login, compte, libelle');
    $this->db->join('service', 'service.id = user.fk_service');
    $this->db->where('fk_service', classe()->service);
    $query = $this->db->get('user');
    if($query->num_rows() > 0)
      {
        foreach($query->result() as $row)
        {
          $data[] = $row;
        }
      return $data;
    }
  }
  function activer_utilisateur($id)
  {
    $data = array(
               'compte' => '1',
               );
    $this->db->where('id', $id);
    $this->db->update('user' ,$data);
  }
  function admin_utilisateur($id)
  {
    $data = array(
               'compte' => '2',
               );
    $this->db->where('id', $id);
    $this->db->update('user' ,$data);
  }
  function supprimer_utilisateur($id)
  {
      //supprime l'utilisateur et les ligne ou il est présent dans les autres tables
      $this->db->where('fk_user',$id);
      $this->db->delete('registre');
      $this->db->where('fk_user',$id);
      $this->db->delete('reservation');
      $this->db->where('id', $id);
      $this->db->delete('user');
      
  }
  function check_superieur($id)
  {
    //vérifie si l'utilisateur est désigné comme supérieur
    $this->db->select('nom, prenom, login');
    $this->db->where('superieur',$id);
    $query = $this->db->get('user');
    if($query->num_rows() == 0)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
   function modifier_utilisateur($data)
  {
    //change les donnée de l'utilisateur
    $this->db->where('id', $data['id']);
    $this->db->update('user' ,$data);
  }
}