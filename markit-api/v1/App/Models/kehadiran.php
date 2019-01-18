<?php
    class kehadiranModel extends MarkIt {
		
		public function addPresent ($params){
			$present = $this->db->prepare(
				"INSERT INTO `kehadiran`
				(`absent_id`,`lokasi`, `tanggal`, `waktu`, `user_id`, `kantor_id`, `status`, `detail`) 
				VALUES 
				(null,:lokasi,:tanggal,:waktu,:user_id,:kantor_id,:status,:detail)"
			);
			
			return $present->execute($params);
		}
		
		public function addAbsent ($params){
			$present = $this->db->prepare(
			"INSERT INTO `kehadiran` (`waktu`,`tanggal`,`user_id`,`kantor_id`,`status`,`reason`)VALUES (:waktu,:tanggal,:user_id,:kantor_id,:status,:reason)");
			
			$present->execute ($params);
		}

		public function verifikasi ($params){
			$verify = $this->db->prepare(
				"UPDATE `kehadiran` SET `status` = :status WHERE `user_id` = :user_id && `tanggal` = :tanggal");
			
			return $verify->execute($params);
			// return $verify;
		}

		public function cant ($params){
			
			$cantCome = $this->db->prepare(
			
				"INSERT INTO `kehadiran` (`lokasi`,`tanggal`, `waktu`, `user_id`,`kantor_id`, `status`, `detail`, `reason`) VALUES (:lokasi,:tanggal,:waktu,:user_id,:kantor_id,:status,:detail,:reason)");
		
			return $cantCome->execute($params);
			
			// return $cantCome->fetchAll(PDO::FETCH_ASSOC);
		}

		
}
?>