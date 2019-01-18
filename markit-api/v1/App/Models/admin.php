<?php
    class adminModel extends MarkIt {
        
        //
        //Get Time Limit
        //
		public function getUser($params){

			$stats = $this->db->prepare(

			"SELECT hour,minutes FROM `kantor` WHERE `kantor_id` = :kantor_id");
			
			$stats->execute($params);
			return $stats->fetchAll(PDO::FETCH_ASSOC);
        }
        
        //
        //Update Time Hour
        //
        public function update($params){

			$update = $this->db->prepare(

			"UPDATE `kantor` SET `hour` = :hour,`minutes` = :minutes, `code` = :code WHERE `kantor_id` = :kantor_id");
            

            return $update->execute($params);
		}

		
}
?>