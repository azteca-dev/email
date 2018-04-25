<?php

include_once 'mail/PHPMailerAutoload.php';

date_default_timezone_set('America/Mexico_City');
	
class Mail{

	private $global_debug;
	private $global_host;
	private $global_port;
	private $global_smtpSecure;
	private $global_smptAuth;
	private $global_userName;
	private $global_password;
	private $global_mailFrom;
	private $global_nameFrom;

	function __construct(){
		$this->global_debug = 2;
		$this->global_host = 'xxxxxxxxxxxx';
		$this->global_port = 465;
		$this->global_smtpSecure = 'ssl' ;
		$this->global_smptAuth = true ;
		$this->global_userName = "contacto@xxxxxxxx.mx";
		$this->global_password = "xxxxxxxxxxxxx";
		$this->global_mailFrom = "contacto@xxxxxx.mx";
		$this->global_nameFrom = "NameFrom";
	}


	function sendMail($emailTo, $subject, $data){

		$body = $this->getPlantilla();
		$body= str_replace("<<--name-->>",$data['nombre'], $body);
		$body= str_replace("<<--zona-->>",$data['zona'], $body);
		$body= str_replace("<<--sucursal-->>",$data['sucursal'], $body);
		
		//Create a new PHPMailer instance
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPDebug = $this->global_debug;
		$mail->Debugoutput = 'html';		
		$mail->Host = $this->global_host;
		$mail->Port = $this->global_port;
		$mail->SMTPSecure = $this->global_smtpSecure;
		$mail->SMTPAuth = $this->global_smptAuth;
		$mail->Username = $this->global_userName;
		$mail->Password = $this->global_password;
		$mail->setFrom($this->global_mailFrom, $this->global_nameFrom);
		$mail->CharSet = 'UTF-8';

		$mail->addAddress($emailTo, $data['nombre']);
		$mail->Subject = 'Prueba para easyhost'.$data['nombre'];
		$mail->IsHTML(true); // El correo se envía como HTML
		$mail->Body = $body; // Mensaje a enviar

		$mail->AltBody = 'This is a plain-text message body';

		if (!$mail->send()) {
		    return "Error". $mail->ErrorInfo;
		} else {
		    return "OK!";
		}

	}

	private function getPlantilla(){

		$body = '';

		$body.= '<div id="imprimir-container" style="margin: 0 auto 0 auto; width: 800px;">';
	    $body.= '      <label><<--sucursal-->></label><br>';
	    $body.= '      <label><<--sucursal-->></label><br>';
	    $body.= '      <label><<--sucursal-->></label>';
	    $body.= '  </div>';

		return $body;
	}
}

?>
