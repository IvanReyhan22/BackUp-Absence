<?php
	
	class registModel extends MarkIt {
		
		
	//==================================
    //     		Insert Method
	//==================================
	
    public function insert ($params) {

        // Set query
        $user = $this->db->prepare (
		"INSERT INTO `user`
		(`user_id`,`profile`,`name`,`kantor_id`,`divisi`, `email`,`password`,`status`) VALUES (NULL,:profile,:name,:kantor_id,:divisi,:email,:password,:status)");

        // Query execution		
		return $user->execute($params);

    }
	
	public function insertOffice ($params) {
		
		$office = $this->db->prepare(
		"INSERT INTO 
		`kantor`
		(`kantor_id`,`password`,`nama_kantor`,`alamat`,`hour`,`minutes`,`type`) 
		VALUES 
		(:kantor_id,:password,:nama_kantor,:alamat,:hour,:minutes,:type)");
		
		return $office->execute($params);
		
	}
	
	}
?>