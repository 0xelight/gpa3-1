<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog_model extends CI_Model {
	function liste_article_service()
	{
		//retourne la liste des articles du service
		$this->db->where('fk_service',classe()->service);
		$query = $this->db->get('blog');
      	if($query->num_rows() > 0)
      	{
        		foreach($query->result() as $row)
        		{
        			$data[] = $row;
        		} 
      		return $data;
      	}
	}
	function add_article($data)
	{
		//ajoute une article en base de données
    	$this->db->insert('blog',$data);
	}
	function modifier_article($data)
	{
	    //modifier l'article
	    $this->db->where('id', $data['id']);
	    $this->db->update('blog' ,$data);
	}
	function get_article($id)
  	{
      //retourne les infos d'un article
    	$this->db->where('id',$id);
    	$query = $this->db->get('blog');
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