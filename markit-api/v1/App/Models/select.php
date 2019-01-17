<?php
	Class selectModel extends MarkIt {
		
		//
		//Get All User Data
		//
		public function getUser($params){

			$get = $this->db->prepare(

			"SELECT * FROM `user` WHERE `user_id` = :user_id");
			
			$get->execute ($params);
			return $get->fetchAll(PDO::FETCH_ASSOC);
		}

		//
		//Get All Detail
		//
		public function get ($params) {
        
			//prepare query
			$get = $this->db->prepare(
			"SELECT * FROM `kehadiran` WHERE `user_id` = :user_id && `kantor_id` = :kantor_id && `tanggal` = :tanggal");
			
			$get->execute ($params);
			return $get->fetchAll(PDO::FETCH_ASSOC);
        
		}
		
		//
		//Get data After Scan
		//
		public function getresult ($params) {
			
			$result = $this->db->prepare (
			"SELECT * FROM `kehadiran` WHERE `user_id` = :user_id && `kantor_id` = :kantor_id"
			);
			$result = $this->execute ($params);
			return $result->fetchAll();
			
		}
		
		//
		//Get data berdasarkan kantor
		//
		public function getoffice ($params) {
			
			$office = $this->db->prepare (
			"SELECT * FROM `kantor` WHERE `kantor_id` = :kantor_id"
			);
			$office->execute($params);
			return $office->fetchAll(PDO::FETCH_ASSOC);
			
		}
		
		//
		// Get Verified data
		//
		public function getverified ($params) {
			
			$verified = $this->db->prepare (
			"SELECT * FROM `kehadiran` WHERE status = `verified`"
			);
			$verified = $this->execute ($params);
			return $rekap->fetchAll(PDO::FETCH_ASSOC); 
		}
		
		
		//
		// Get UnVerified data
		//
		public function getunverified ($params){
			$unverified = $this->db->prepare (
			
			"SELECT user.user_id, user.name, user.profile, kehadiran.detail, kehadiran.status, kehadiran.reason, kehadiran.waktu
			FROM `kehadiran` 
			INNER JOIN `user` ON kehadiran.user_id = user.user_id && kehadiran.status = :status && kehadiran.kantor_id = :kantor_id && kehadiran.tanggal = :tanggal && kehadiran.detail = :detail"); 

			$unverified->execute($params);
			return $unverified->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getunverifiedDouble ($params){
			$unverified = $this->db->prepare(
			
			"SELECT user.user_id, user.name, user.profile, kehadiran.detail, kehadiran.status, kehadiran.reason, kehadiran.waktu
			FROM `kehadiran` 
			INNER JOIN `user` ON kehadiran.user_id = user.user_id && kehadiran.status = :status && kehadiran.kantor_id = :kantor_id && kehadiran.tanggal = :tanggal && kehadiran.detail = :detail1 || kehadiran.detail = :detail2"); 
			
			$unverified->execute($params);
			return $unverified->fetchAll(PDO::FETCH_ASSOC);
		}
		
		//
		// Get data Hari Ini
		//
		public function getnow ($params) {
			
			$now = $this->db->prepare (			
				"SELECT waktu,status FROM `kehadiran` WHERE `tanggal` = :tanggal && `kantor_id` = :kantor_id && `user_id` = :user_id"
			);

			$now->execute($params);
			return $now->fetchAll(PDO::FETCH_ASSOC);
			
		}

		//
		// Get Absent Stats
		//
		public function getstats ($params) {
			
			$stats= $this->db->prepare (			
				"SELECT * FROM `kehadiran` WHERE `tanggal` = :tanggal && `user_id` = :user_id && `kantor_id` = :kantor_id"
			);

			$stats->execute($params);
			return $stats->fetchAll(PDO::FETCH_ASSOC);
			
		}

		//
		// Month report
		//
		public function monthreport ($params) {
			$sql = 
			"SELECT * FROM `kehadiran` WHERE `user_id` = :user_id && `kantor_id` = :kantor_id && `tanggal` LIKE %:tanggal% ";
			foreach ($params AS $input -> $value){
				$sql = str_replace($input,$value,$sql);
			}
			$stats= $this->db->prepare ($sql);
			$stats->execute($params);
			return $stats->fetchAll(PDO::FETCH_ASSOC);
			
		}
	}	
?>