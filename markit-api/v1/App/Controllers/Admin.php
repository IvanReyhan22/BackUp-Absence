<?php

    $this->post ('/gettime',\Admin::class . ":getTimeLimit");
    $this->post ('/updateinfo',\Admin::class . ":updateInfo");

    class Admin extends MarkIt {

        //
        //Get Time Limit
        //
        public function getTimeLimit ( $request, $response, $args ){
            
            $this-> initModel ("admin");
            $this->params = $request->getParsedBody();
            
            $data = $this->adminModel->getUser( array(
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
                "status" => false,
				"data" => $data
            ));
        }

        //
        //Update Time 
        //
        public function updateInfo ( $request, $response, $args ){
            
            $this-> initModel ("admin");
            $this->params = $request->getParsedBody();
            
            $data = $this->adminModel->update( array(
                ":kantor_id" => $this->params["kantor_id"],
                ":code" => $this->params["code"],
                ":hour" => $this->params["hour"],
                ":minutes" => $this->params["minutes"]
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