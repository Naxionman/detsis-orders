<?php 
$upload = 'err'; 

if(!empty($_FILES['file'])){ 
     
    // File upload configuration 
    $targetDir = "/"; 
    //$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'gif'); 
    var_dump("here!");
    $fileName = basename($_FILES['file']['name']); 
    $targetFilePath = $targetDir.$fileName; 
    
    // Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
    // Upload file to the server 
    if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){ 
        $upload = 'ok'; 
    } 
     
} 
echo $upload; 
?>