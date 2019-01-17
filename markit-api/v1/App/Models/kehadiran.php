<?php
    class kehadiranModel extends MarkIt {
		
		public function addPresent ($params){
			$present = $this->db->prepare(
			"INSERT INTO `kehadiran` (`lokasi`,`waktu`,`tanggal`,`user_id`,`kantor_id`,`status`)VALUES (:lokasi,:waktu,:tanggal,:user_id,:kantor_id,:status)");
			
			$present->execute ($params);
		}
		
		public function addAbsent ($params){
			$present = $this->db->prepare(
			"INSERT INTO `kehadiran` (`waktu`,`tanggal`,`user_id`,`kantor_id`,`status`,`reason`)VALUES (:waktu,:tanggal,:user_id,:kantor_id,:status,:reason)");
			
			$present->execute ($params);
		}

		public function cant ($params){
			
			$cantCome = $this->db->prepare(
			
				"INSERT INTO `kehadiran` (`lokasi`,`tanggal`, `waktu`, `user_id`,`kantor_id`, `status`, `detail`, `reason`) VALUES (:lokasi,:tanggal,:waktu,:user_id,:kantor_id,:status,:detail,:reason)");
		
			return $cantCome->execute($params);
			
			// return $cantCome->fetchAll(PDO::FETCH_ASSOC);
		}

		
}
?>