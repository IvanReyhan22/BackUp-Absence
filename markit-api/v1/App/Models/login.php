<?php
// *
// *    Hello Model
// *    Author: Alfan Hidayatullah
// *

class loginModel extends MarkIt {
    
    // *
    // *    Get Method
    // *
    public function get($params) {

        // Preparing query
        $select = $this->db->prepare ("
            SELECT * FROM `user` WHERE `email` = :email && `password` = :password
        ");

        // Query execution
        $select->execute($params);

        // Get fetched data
        return $select->fetchAll(PDO::FETCH_ASSOC);

    }
	
	public function getOffice ( $params ) {

        // Preparing query
        $select = $this->db->prepare ("
            SELECT * FROM `kantor` WHERE kantor_id = :id && password = :password 
        ");

        // Query execution
        $select->execute ( $params );

        // Get fetched data
        return $select->fetchAll(PDO::FETCH_ASSOC);

    }

}

?>