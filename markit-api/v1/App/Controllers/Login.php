<?php

    $this->post('/loginuser',\Login::class . ":loginUser");
	$this->post ('/loginadmin',\Login::class . ":loginOffice");
	
    class Login extends MarkIt {
		
        public function loginUser ($request, $response, $args ) {
            //model
            $this-> initModel ("login");
            $this->params = $request->getParsedBody();
            
            $data = $this->loginModel->get( array(
                ":email" => $this->params["email"],
                ":password" => $this->encrypt_password($this->params)
            ));

            //Return data                           
            if($data){
            return $response->withJSON (array(
                "status" => true,
                "data" => $data
            ));
        }
            return $response->withJSON (array(
                "message" => 'Failed',
				"data" => $data
            ));
        }
		
		
        public function loginOffice ($request, $response, $args ) {
            //model
            $this-> initModel ("login");
            $this->params = $request->getParsedBody();
            
            $data = $this->loginModel->getOffice( array(
                ":id" => $this->params["id"],
                ":password" => $this->encrypt_password($this->params)
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
		
    }
?>