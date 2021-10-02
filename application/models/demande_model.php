<?php 
class Demande_model extends CI_Model{
	function add_demande($data)
	{
		//ajoute une article en base de données
    	$this->db->insert('demande',$data);
	}
	function liste_demande()
	{
		//liste les remisage_domicile de l'utilisateur
		$query = $this->db->get('demande');
		if($query->num_rows() > 0)
	    {
	    	foreach($query->result() as $row)
	      	{
				$data[] = $row;
			}
			return $data;
		}
	}
	function valider_demande($id)
	{
		$data = array(
               'statut' => '1',
               );
    	$this->db->where('id', $id);
   	 	$this->db->update('demande' ,$data);
	}
}
?>