<?php
$this->post ('/present', \Kehadiran::class . ":present");
$this->post ('/absent', \Kehadiran::class . ":absent");
$this->post ('/verify', \Kehadiran::class . ":verifiedPresent");
$this->post ('/cantcome', \Kehadiran::class . ":cantCome");

	class Kehadiran extends MarkIt {
		
    // *
    // *    @POST Kehadiran
    // *	
    public function present ( $request, $response, $args ) {

        // Initialize model
        $this->initModel("kehadiran");
		// Get request params
		$this->params = $request->getParsedBody();

        // Insert data
        $data = $this->kehadiranModel->addPresent( array(
			':lokasi' =>$this->params['lokasi'],
			':waktu' =>$this->params['waktu'],
			':tanggal' =>$this->params['tanggal'],
			':user_id' =>$this->params['user_id'],
			':kantor_id' =>$this->params['kantor_id'],
			':status' =>0,
			':detail' =>$this->params['detail'],
		));
		
		if ( $data ) {
            // Return feedback data
            return $response->withJSON ( array (
			    "status"    => true,
				"data"      => $data
            ));
        }
        // Return feedback data
        return $response->withJSON ( array (
            "status" => false
        ));

    }
	
	public function absent ( $request, $response, $args ) {

        // Initialize model
        $this->kehadiranModel ( "kehadiran" );
		// Get request params
		$this->params = $request->getParsedBody();

        // Insert data
        $data = $this->kehadiranModel->addAbsent ( array(
			':waktu' =>$this->params['waktu'],
			':tanggal' =>$this->params['tanggal'],
			':user_id' =>$this->params['user_id'],
			':name' =>$this->params['name'],
			':kantor_id' =>$this->params['kantor_id'],
			':status' =>$thid->params['status'],
			':reason' =>$this->params['reason']
		));
		
		if ( $data ) {
            // Return feedback data
            return $response->withJSON ( array (
			    "status"    => true,
				"data"      => array(
					':waktu' =>$this->params['waktu'],
					':tanggal' =>$this->params['tanggal'],
					':user_id' =>$this->params['user_id'],
					':name' =>$this->params['name'],
					':kantor_id' =>$this->params['kantor_id'],
					':status' =>$this->params['status'],
					':reason' =>$this->params['reason']
				)
            ));
        }
        // Return feedback data
        return $response->withJSON ( array (
            "status" => false
        ));

	}
	
	//cant come system
	public function cantCome ( $request, $response, $args ) {
		
		// Initialize model
		$this-> initModel ( "kehadiran" );
		// Get request params
		$this->params = $request->getParsedBody();

		//input data
		$data = $this->kehadiranModel->cant ( array(
			':lokasi' =>"null",
			':tanggal' =>$this->params['tanggal'],
			':waktu' =>$this->params['waktu'],
			':user_id' =>$this->params['user_id'],
			':kantor_id' =>$this->params['kantor_id'],
			':status' => "false",
			':detail' =>$this->params['detail'],
			':reason' =>$this->params['reason']
		));
		
		if ( $data ) {
            // Return feedback data
            return $response->withJSON ( array (
				"status"    => true,
				"massage"   => "Good To Go",
				"data"      => array(
					':tanggal' =>$this->params['tanggal'],
					':waktu' =>$this->params['waktu'],
					':user_id' =>$this->params['user_id'],
					':kantor_id' =>$this->params['kantor_id'],
					':status' =>"unverified",
					':detail' =>$this->params['detail'],
					':reason' =>$this->params['reason']
				)
            ));
		}
		
		// Return feedback data
		return $response->withJSON ( array (
			"status" => false,
			"massage" => "Sending Failed Please Try Again"
		));
		
	}

	public function verifiedPresent ( $request, $response, $args ) {

        // Initialize model
        $this->initModel("kehadiran");
		// Get request params
		$this->params = $request->getParsedBody();

        // Insert data
        $data = $this->kehadiranModel->verifikasi ( array(
			':user_id' =>$this->params['user_id'], 
			':tanggal' =>$this->params['tanggal'], 
			':status' =>1,
			
		));
		
		if ( $data ) {
            // Return feedback data
            return $response->withJSON ( array (
			    "status" => true,
				"data" => $data,
            ));
        }
        // Return feedback data
        return $response->withJSON ( array (
            "status" => false
        ));

	}

	//get if already absent
	public function cant ( $request, $response, $args ) {
		
		// Initialize model
		$this-> initModel ( "kehadiran" );
		// Get request params
		$this->params = $request->getParsedBody();

		//input data
		$data = $this->kehadiranModel->cant ( array(
			':lokasi' =>"null",
			':tanggal' =>$this->params['tanggal'],
			':waktu' =>$this->params['waktu'],
			':user_id' =>$this->params['user_id'],
			':kantor_id' =>$this->params['kantor_id'],
			':status' => "unverified",
			':detail' =>$this->params['detail'],
			':reason' =>$this->params['reason']
		));
		
		if ( $data ) {
            // Return feedback data
            return $response->withJSON ( array (
				"status"    => true,
				"massage"   => "Good To Go",
				"data"      => array(
					':tanggal' =>$this->params['tanggal'],
					':waktu' =>$this->params['waktu'],
					':user_id' =>$this->params['user_id'],
					':kantor_id' =>$this->params['kantor_id'],
					':status' =>"unverified",
					':detail' =>$this->params['detail'],
					':reason' =>$this->params['reason']
				)
            ));
		}
		
		// Return feedback data
		return $response->withJSON ( array (
			"status" => false,
			"massage" => "Sending Failed Please Try Again"
		));
		
		
	}	
	

}

?>