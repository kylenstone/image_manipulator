<?php

/* ------ 
UPLOAD FORM -- validate form and handle submission
------- */

if (isset($_POST['upload_form_submitted'])) {

	//error type 1
	if(!isset($_FILES['img_upload']) || empty($_FILES['img_upload']['name'])) {
		$error = "Error: File not uploaded";

	//error type 2
	} else if (!isset($_POST['img_name']) || empty($_FILES['img_upload'])) {
		$error = "Error: file name not found";

	} else {

		$allowedMIMEs = array('image/jpeg', 'image/gif', 'image/png');
		foreach($allowedMIMEs as $mime) {
			if($mime == $_FILES['img_upload']['type']) {
				$mimeSplitter = explode('/', $mime);
				$fileExt = $mimeSplitter[1];
				$newPath = 'images/'.$_POST['img_name'].'.'.$fileExt;
				break;
			}
		}

	//error type 3
	if (file_exists($newPath)) {
		$error = "Error: A file with that name already exists";
	
	//error type 4
	} else if (!isset($newPath)) {
		$error = "Error: invalid file format -- upload a picture file";
	
	//error type 5
	} else if (!copy($_FILES['img_upload']['tmp_name'], $newPath)) {
		$error = "Error: Could not save file to server";

	// validation case	
	} else {
		$_SESSION['newPath'] = $newPath;
		$_SESSION['fileExt'] = $fileExt;
	}
}
}

/* ------ 
CROP saved image
------- */

if(isset($_GET["crop_attempt"])){
	//crop code here
}

?>