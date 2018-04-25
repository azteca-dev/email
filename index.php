<?php
include_once 'Classes/Mail.class.php';
	$sendEmail = new Mail();

	// estos son los datos que se recibiran
	$data = array(
	     'nombre' 	=> "David Paz",
	     'zona' 	=> "La zona norte", 
	     'sucursal' 	=> "la sucursal"
	    );
	
	//$sendEmail->sendMail("he.santy@gmail.com", "Prueba con clase", $data);

	$sendEmail->sendMail("para@eldominio.com", "Prueba con clase", $data);

?>



