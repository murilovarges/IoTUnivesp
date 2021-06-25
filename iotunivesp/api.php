<?php
	header("Content-Type:application/json");
	if (isset($_GET['api_key']) && $_GET['field']!="") {
		include('conexao.php');
		$api_key = $_GET['api_key'];
		$sql = "SELECT * from channel where write_key='$api_key'";
		$result = mysqli_query($con,$sql);	
		if(mysqli_num_rows($result)>0){
			$row = mysqli_fetch_array($result);
			
			$min_value = $row['min_value'];
			$max_value = $row['max_value'];
			$email    = $row['email_alert'];
			$ip_addres = getIPAddress();  
			$field = $_GET['field'];
			echo $field;
			$datetime = date_create()->format('Y-m-d H:i:s');
			$alert = 0;
			$alert_type = 'Normal';
			$email_message = '';
			if($field < $min_value){
				$alert = 1;
				$alert_type = 'Abaixo Mínimo';				
				$email_message = 'Alerta! Sensor de temperatura abaixo do minimo: '.$field;
			}else if($field > $max_value){
				$alert = 1;
				$alert_type = 'Acima Máximo';								
				$email_message = 'Alerta! Sensor de temperatura acima do maximo: '.$field;
			}
			$sql = "INSERT INTO channel_data (id_channel, datetime_info, value_info, ip_source, alert, alert_type, email, email_message, email_sent)
			VALUES (".$row['id_channel'].",'".$datetime."',".$field.",'".$ip_addres."',".$alert.",'".$alert_type."','".$email."','".$email_message."',0)";

			echo $sql;
			$result = mysqli_query($con, $sql);
			if($result){
				response($api_key, $field, 200,"Ok");
			}
			else{
				response($api_key, $field, 500,"Insert error".mysqli_error($con));
			}												
			
			mysqli_close($con);		
			
		}else{
			response(NULL, NULL, 200,"No Record Found");
			}
	}else{
		response(NULL, NULL, 400,"Invalid Request");
		}

	function response($key_id,$field,$response_code,$response_desc){
		$response['key_id'] = $key_id;
		$response['field'] = $field;
		$response['response_code'] = $response_code;
		$response['response_desc'] = $response_desc;
		
		$json_response = json_encode($response);
		echo $json_response;
	}
	
	function getIPAddress() {  
		//whether ip is from the share internet  
		 if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
					$ip = $_SERVER['HTTP_CLIENT_IP'];  
			}  
		//whether ip is from the proxy  
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
		 }  
		//whether ip is from the remote address  
		else{  
				 $ip = $_SERVER['REMOTE_ADDR'];  
		 }  
		 return $ip;  
}  	
?>