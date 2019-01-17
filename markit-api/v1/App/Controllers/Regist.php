<?php
$this->post('/adduser', \Regist::class . ":addUser");
$this->post('/addoffice', \Regist::class . ":addOffice");

    // *
    // *    @POST Regist Method
    // *
    // *
	class Regist extends MarkIt {
				
	//*
	//*		Regist User
	//*
	
    public function addUser ( $request, $response, $args ) {
        $image = '';
        $uploadedFile   = $_FILES['profile']['tmp_name'];
        $filename       = $_FILES['profile']['name'];
        $extension      = getExtension($filename);
        $extension      = strtolower($extension);
		
        if(($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")){
            $json   = array("message" => "error", "code" => 500);
            return;
        }
        else{
            $size   = filesize($uploadedFile);
            if($extension == "jpg" || $extension == "jpeg"){
                $src    = imagecreatefromjpeg($uploadedFile);
            }
			else if($extension == "png"){
                $src    = imagecreatefrompng($uploadedFile);
            }
			else{
                $src    = imagecreatefromgif($uploadedFile);
            }
            list($width, $height) = getimagesize($uploadedFile);
            $imratio = 1;
			
            if($width != 0 && $height != 0) $imratio = $width/$height;
            $genImageName = basename(microtime(true).".".$extension);
            $tmp=imagecreatetruecolor($width, $height);
            imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
            $filename="./ImageProfile/".$genImageName;
            imagejpeg($tmp, $filename, 100);
            imagedestroy($src);
            imagedestroy($tmp);
        }
        // Get request params
        $this->params   = $request->getParsedBody();

        // Initialize model
        $this->initModel ( "regist" );

        // Insert data
        $user = $this->registModel->insert ( array (
		
			":profile" => $filename,
            ":name" => $this->params["name"],
            ":kantor_id" => $this->params["kantor_id"],			
            ":divisi" => $this->params["divisi"],
			":email" => $this->params["email"],
			":password" => $this->encrypt_password($this->params),
			":status" => "user"
        ));

        // if Insert success
        if ( $user ) {
            // Return feedback data
            return $response->withJSON ( array (
                "status"    => true,
                "data"      => $user
            ));
        }

        // If failed
        return $response->withJSON ( array (
            "status"    => $user,
            "message"   => "Insert failed"
        ));

    }
	
	//*
	//*		Regist Office
	//*
	
    public function addOffice ( $request, $response, $args ) {

        // $image = '';
        // $uploadedFile   = $_FILES['picture']['tmp_name'];
        // $filename       = $_FILES['picture']['name'];
        // $extension      = getExtension($filename);
        // $extension      = strtolower($extension);
		
        // if(($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")){
        //     $json   = array("message" => "error", "code" => 500);
        //     return;
        // }
        // else{
        //     $size   = filesize($uploadedFile);
        //     if($extension == "jpg" || $extension == "jpeg"){
        //         $src    = imagecreatefromjpeg($uploadedFile);
        //     }
		// 	else if($extension == "png"){
        //         $src    = imagecreatefrompng($uploadedFile);
        //     }
		// 	else{
        //         $src    = imagecreatefromgif($uploadedFile);
        //     }
        //     list($width, $height) = getimagesize($uploadedFile);
        //     $imratio = 1;
			
        //     if($width != 0 && $height != 0) $imratio = $width/$height;
        //     $genImageName = basename(microtime(true).".".$extension);
        //     $tmp=imagecreatetruecolor($width, $height);
        //     imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
        //     $filename="./ImageProfile/".$genImageName;
        //     imagejpeg($tmp, $filename, 100);
        //     imagedestroy($src);
        //     imagedestroy($tmp);
        // }

        // Get request params
        $this->params   = $request->getParsedBody();

        // Initialize model
        $this->initModel ( "regist" );

        // Insert data
        $office = $this->registModel->insertOffice ( array (
            // ":picture" => $filename,
            ":kantor_id" => $this->params["kantor_id"],
			":nama_kantor" => $this->params["nama_kantor"],
            ":alamat" => $this->params["alamat"],
            ":hour" => $this->params["hour"],
            ":minutes" => $this->params["minutes"],
            ":type" => $this->params["type"],
            ":password" => $this->encrypt_password($this->params),
        ));

        // if Insert success
        if ( $office ) {
            // Return feedback data
            return $response->withJSON ( array (
                "status"    => true,
                "data"      => array (
                    ":kantor_id" => $this->params["kantor_id"],
					":nama_kantor" => $this->params["nama_kantor"],
					":alamat" => $this->params["alamat"], 
                )
            ));
        }

        // If failed
        return $response->withJSON ( array (
            "status"    => $office,
            "message"   => "Insert failed"
        ));

    }
	
}
    function getExtension($filename){
		$pos = strrpos($filename,".");
		if(!$pos)return "";
		$end = strlen($filename) - $pos;
		$ext = substr($filename, $pos+1, $end);
		return $ext;
	}
?>