<?php
	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	//include('PHPMailer.php');
	//include('SMTP.php');
	//include('Exception.php');
	include('/var/sentora/hostdata/bi112616/public_html/iotunivesp/PHPMailer.php');
	include('/var/sentora/hostdata/bi112616/public_html/iotunivesp/SMTP.php');
	include('/var/sentora/hostdata/bi112616/public_html/iotunivesp/Exception.php');	
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	//Load Composer's autoloader
	//require 'vendor/autoload.php';


	include('/var/sentora/hostdata/bi112616/public_html/iotunivesp/conexao.php');	
	$sql = "SELECT * from channel_data where alert=1 and email_sent= 0";
	$result = mysqli_query($con,$sql);	
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result)){
			$email = $row['email'];
			if(!empty($email)){
				$message = $row['email_message'];
				SendEmail($email, $message);
				echo '<br>'.$row['id_channel_data'].'<br>';
				$sql = "UPDATE channel_data set email_sent=1 WHERE id_channel_data=".$row['id_channel_data'];
				$result_update = mysqli_query($con,$sql);				
			}
		}			
	}


	function SendEmail($to, $message){
		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
			$mail->isSMTP();                                          //Send using SMTP
			//$mail->Host       = 'smtp.gmail.com';                   //Set the SMTP server to send through
			$mail->Host       = 'webmail.ifsp.edu.br';                //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                 //Enable SMTP authentication
			//$mail->Username   = 'user';          					  //SMTP username
			$mail->Username   = 'user';						          //SMTP username
			//$mail->Password   = 'password';                         //SMTP password
			$mail->Password   = 'password';                           //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       //Enable implicit TLS encryption
			$mail->Port       = 587;                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			//Recipients
			$mail->setFrom('murilo.varges@ifsp.edu.br', 'IoTUnivesp');
			$mail->addAddress($to, 'IoTUnivesp');     //Add a recipient

			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = 'Alerta Temperatura Anormal';
			$mail->Body    = $message;
			$mail->AltBody = $message;

			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
?>