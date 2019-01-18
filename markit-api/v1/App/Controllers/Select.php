<?php

    $this->post ('/getresult',\getData::class . ":getResult");
	$this->post ('/getoffice',\getData::class . ":getOffice");
	$this->post ('/getverified',\getData::class . ":getVerified");
    $this->post ('/getunverifiedontime',\getData::class . ":getUnverifiedOnTime");
    $this->post ('/getunverifiedlate',\getData::class . ":getUnverifiedLate");
    $this->post ('/getunverifiedother',\getData::class . ":getUnverifiedOther");
    $this->post ('/getit',\getData::class . ":getNow");
    $this->post ('/getuser',\getData::class . ":getUserData");
    $this->post ('/getstats',\getData::class . ":getAbsentStats");
    $this->post ('/getmonthreport',\getData::class . ":monthReport");
    $this->post ('/getcount',\getData::class . ":getCount");

	
    class getData extends MarkIt {

        //
        //Get User Data
        //
        public function getUserData ( $request, $response, $args ){
            
            $this-> initModel ("select");
            $this->params = $request->getParsedBody();
            
            $data = $this->selectModel->getUser( array(
                ":user_id" => $this->params["user_id"]
            ));

            //Return data                           
            if($data){
                return $response->withJSON (array(
                    "status" => true,
                    "data" => $data
                ));
            }
            return $response->withJSON (array(
                "status" => false,
                "message" => "Failed",
				"data" => $data
            ));
        }

		//
        //Get User Absent Data
        //
        public function getResult ($request, $response, $args ) {
            //model
            $this-> initModel ("select");
            $this->params = $request->getParsedBody();
            
            $data = $this->selectModel->get( array(
                ":user_id" => $this->params["user_id"],
                ":kantor_id" => $this->params["kantor_id"],
                ":tanggal" => $this->params["tanggal"]
            ));

            //Return data                           
            if($data){
                return $response->withJSON (array(
                    "status" => true,
                    "data" => $data
                ));
            }
            return $response->withJSON (array(
                "status" => false,
                "message" => "Failed",
				"data" => $data
            ));

        }
		
		
        public function getVerified ($request, $response, $args ) {
            //model
            $this-> initModel ("select");
            $this->params = $request->getParsedBody();
            
            $data = $this->selectModel->getverified( array(
				":status" => "verified",
				":kantor_id" => $this->params["kantor_id"],
            ));

            //Return data                           
            if($data){
            return $response->withJSON (array(
                "status" => true,
                "data" => $data
            ));
        }
            return $response->withJSON (array(
                "Gagal"
            ));
        }
		
		
        public function getUnverifiedOnTime ($request, $response, $args ) {
            //model
            $this-> initModel ("select");
            $this->params = $request->getParsedBody();
            
            $data = $this->selectModel->getunverified( array(
				":status" => $this->params["status"],
                ":kantor_id" => $this->params["kantor_id"],
                ":tanggal" => $this->params["tanggal"],
                ":detail" => "on time",
            ));

            //Return data                           
            if($data){
            return $response->withJSON (array(
                "status" => true,
                "data" => $data
            ));
        }
            return $response->withJSON (array(
                "status" => false
            ));
        }		

        public function getUnverifiedLate ($request, $response, $args ) {
            //model
            $this-> initModel ("select");
            $this->params = $request->getParsedBody();
            
            $data = $this->selectModel->getunverified( array(
				":status" => $this->params["status"],
                ":kantor_id" => $this->params["kantor_id"],
                ":tanggal" => $this->params["tanggal"],
                ":detail" => "late",
            ));

            //Return data                           
            if($data){
            return $response->withJSON (array(
                "status" => true,
                "data" => $data
            ));
        }
            return $response->withJSON (array(
                "status" => false
            ));
        }		

        public function getUnverifiedOther ($request, $response, $args ) {
            //model
            $this-> initModel ("select");
            $this->params = $request->getParsedBody();
            
            $data = $this->selectModel->getunverifiedDouble( array(
				":status" => $this->params["status"],
                ":kantor_id" => $this->params["kantor_id"],
                ":tanggal" => $this->params["tanggal"],
                ":detail1" => "sick",
                ":detail2" => "permit",
            ));

            //Return data                           
            if($data){
            return $response->withJSON (array(
                "status" => true,
                "data" => $data
            ));
        }
            return $response->withJSON (array(
                "status" => false
            ));
        }		        	
		
		public function getOffice ($request, $response, $args ) {
            //model
            $this-> initModel ("select");
            $this->params = $request->getParsedBody();
            
            $data = $this->selectModel->getOffice( array(
                ":kantor_id" => $this->params["kantor_id"]
            ));

            //Return data                           
            if($data){
            return $response->withJSON (array(
                "status" => true,
                "data" => $data
            ));
        }
            return $response->withJSON (array(
                "Gagal"
            ));
        }
        
        //
        //Get Wheter you alreay absent or not
        //
		public function getAbsentStats ($request, $response, $args ) {
			//model
			$this-> initModel ("select");
			$this->params = $request->getParsedBody();
            
			$data = $this->selectModel->getstats( array(
				":tanggal" => $this->params["tanggal"],
				":user_id" => $this->params["user_id"]
			));

			//Return data                           
			if($data){
   
                return $response->withJSON (array(
                    "status" => true,
                    "data" => $data
                ));
		
			}
			return $response->withJSON (array(
                "status" => false,
			));
		
		
        }
        
        //
        //Get Wheter you alreay absent or not
        //
		public function getNow ($request, $response, $args ) {
			//model
			$this-> initModel ("select");
			$this->params = $request->getParsedBody();
            
			$data = $this->selectModel->getnow( array(
				":tanggal" => $this->params["tanggal"],
                ":user_id" => $this->params["user_id"],
                ":kantor_id" => $this->params["kantor_id"],
			));

			//Return data                           
			if($data){
   
                return $response->withJSON (array(
                    "status" => true,
                    "data" => $data
                ));
		
			}
			return $response->withJSON (array(
                "status" => false,
                "data" => $data
			));
		
		
        }
        
        //
        //Monthly report
        //
		public function monthReport ($request, $response, $args ) {
			//model
			$this-> initModel ("select");
			$this->params = $request->getParsedBody();
            
			$data = $this->selectModel->monthreport( array(
                ":user_id" => $this->params["user_id"],
                "tanggal" => $this->params["tanggal"],
                ":kantor_id" => $this->params["kantor_id"],
			));

			//Return data                           
			if($data){
   
                return $response->withJSON (array(
                    "status" => true,
                    "data" => $data
                ));
		
			}
			return $response->withJSON (array(
                "status" => false,
                "data" => $data
			));
		
		
        }
        
        public function getCount ($request, $response, $args ) {
			//model
			$this-> initModel ("select");
			$this->params = $request->getParsedBody();
			$data =$this->selectModel->hitung( array(
				":user_id" => $this->params["user_id"],
                ":detail" => $this->params["detail"],
                ":tanggal" => $this->params["tanggal"]
			));

			//Return data                           
			if($data){
			return $response->withJSON (array(
				"status" => true,
				"data" => $data
			));
		
			}
		
			return $response->withJSON (array(
				"status" => true,
				"data" => $data
			));
		}
    }
?>