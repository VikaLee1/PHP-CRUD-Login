<?php
require_once "db_connect.php";
function file_upload($picture, $source = "user")
{
    $result = new stdClass(); //this object will carry status from file upload
    // var_dump_pretty($result); 
    // if there is no picture for the record, then this default image will be taken
    if (isset($_SESSION['adm'])) {
        $result->fileName = 'product.png';
    } else {
        $result->fileName = 'avatar.png';
    }
    $result->error = 1; //it could also be a boolean true/false / 1 stands for true
    
    //collect data from object $picture
    $fileName = $picture["name"];
    $fileType = $picture["type"];
    $fileTmpName = $picture["tmp_name"];
    $fileError = $picture["error"];
    $fileSize = $picture["size"];
    // pathinfo takes only the extension from the object
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $filesAllowed = ["png", "jpg", "jpeg"];
    
    
    //  UPLOAD_ERR_NO_FILE Value: 4; No file was uploaded
    if ($fileError == 4) {
        $result->ErrorMessage = "No picture was chosen. It can always be updated later.";
        return $result;
        // if the picture was uploaded then we proceed with 
    } else {
        if (in_array($fileExtension, $filesAllowed)) {
            
            if ($fileError === 0) {
                if ($fileSize < 500000) { //500kb this number is in bytes
                    //it gives a file name based microseconds
                    $fileNewName = uniqid('') . "." . $fileExtension; // 1233343434.jpg i.e
                    if ($source = "product") {
                        $destination = "../../pictures/$fileNewName"; 
                    } else {
                        $destination = "pictures/$fileNewName"; 
                    }                
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        $result->error = 0;
                        $result->fileName = $fileNewName;
                        return $result;
                    } else {
                        $result->ErrorMessage = "There was an error uploading this file.";
                        return $result;
                    }
                } else {
                    $result->ErrorMessage = "This picture is bigger than the allowed 500Kb. <br> Please choose a smaller one and update the product.";
                    return $result;
                }
            } 
            // if the file could not be uploaded 
            else {
                $result->ErrorMessage = "There was an error uploading - $fileError code. Check the PHP documentation.";
                return $result;
            }
        } else {
            $result->ErrorMessage = "This file type can't be uploaded.";
            return $result;
        }
    }
}

// file_upload(null);