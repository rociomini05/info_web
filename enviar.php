<?php

include "libraries/PHPMailer.php";

$recaptcha = $_POST['g-recaptcha-response'];
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
	'secret' => '6LdD-X4UAAAAADxJLvSGjCROK7bmNcFEXTTKhZTe',
	'response' => $recaptcha
);


$query = http_build_query($data);
$options = array(
	'http' => array(
		'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
		"Content-Length: ".strlen($query)."\r\n".
		"User-Agent:MyAgent/1.0\r\n",
		'method'  => "POST",
		'content' => $query,
	),
);
$context = stream_context_create($options);

$verify = file_get_contents($url, false, $context);
$captcha_success = json_decode($verify);
  // si es verdadero indica que se acepto el captcha
if ($captcha_success->success) {

	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$telefono = $_POST['telefono'];
	$empresa = $_POST['empresa'];
	$consulta = $_POST['consulta'];

	$cuerpo = "<!DOCTYPE>
	<html>
	<head>
	<title>Nueva Consulta en INFOCONTROL</title>
	</head>
	<body>";
	$cuerpo .="<table width='700px' style='font:Verdana, Geneva, sans-serif; font-size:12px;' >
	<tr><td>
	<h3>".$empresa."</h3>
	<p><strong>NOMBRE: </strong>".$nombre."</p>
	<p><strong>EMAIL: </strong>".$email."</p>
	<p><strong>TELEFONO: </strong>".$telefono."</p>
	<p><strong>CONSULTA: </strong>".$consulta."</p>
	</td></tr>
	</table>";
	$cuerpo .= "</body></html>";

	$mail = new PHPMailer();
	$mail->IsSMTP(true);
      $mail->Host = 'smtp.gmail.com'; // not ssl://smtp.gmail.com
      $mail->SMTPAuth= true;
      $mail->Username='administracion@infocontrol.com.ar';
      $mail->Password='aserto455';
      $mail->Port = 465; // not 587 for ssl 
      $mail->SMTPDebug = 0; 
      $mail->SMTPSecure = 'ssl';
      //$mail->SetFrom('administracion@infocontrol.com.ar', 'CONSULTA A LA PÁGINA DE INFOCONTROL');
      $mail->AddAddress('contacto@infocontrol.com.ar', 'CONSULTA A LA PÁGINA DE INFOCONTROL');
      $mail->AddAddress('lobosebastian7@gmail.com', 'CONSULTA A LA PÁGINA DE INFOCONTROL');
      $mail->AddAddress('ruffopontoriero@gmail.com', 'CONSULTA A LA PÁGINA DE INFOCONTROL');


      $mail->Subject = "CONSULTA A LA PÁGINA DE INFOCONTROL";
      $mail->Body    = $cuerpo;
      $mail->AltBody = "CONSULTA A LA PÁGINA DE INFOCONTROL";
      if(!$mail->Send()) {
      	echo json_encode("Error");
	      // echo 'Error : ' . $mail->ErrorInfo;
      } else {
      	echo json_encode("Ok");
          // echo 'Ok!!';

      } 
  }else{
  	echo json_encode("Captcha");
  }

  ?>