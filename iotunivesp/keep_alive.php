<?php
	include('/var/sentora/hostdata/bi112616/public_html/iotunivesp/conexao.php');

	$sql = "SELECT id_channel, email, max(datetime_info) datetime_info FROM channel_data
			/*WHERE alert_type <> 'Sem sinal'*/
			GROUP BY id_channel, email";
	$result = mysqli_query($con,$sql);	
	while($row = mysqli_fetch_array($result)){
		echo $row['datetime_info'].'<br>';
		echo date('Y-m-d H:i:s').'<br>';
		$now = strtotime(date('Y-m-d H:i:s'));
		$dt = strtotime($row['datetime_info']);
		echo $now.'<br>';
		echo $dt.'<br>';
		$timeDiff=$now-$dt;
		echo $timeDiff.'<br>';
		echo ($timeDiff/60).'<br>';
		if(($timeDiff/60) > (60)){
			echo "entrei";
			$datetime = date_create()->format('Y-m-d H:i:s');
			$sql = "INSERT INTO channel_data (id_channel, datetime_info, value_info, ip_source, alert, alert_type, email, email_message, email_sent)
			VALUES (".$row['id_channel'].",'".$datetime."',0,'',1,'Sem sinal','".$row['email']."','Alerta! Sensor sem sinal, 5 minutos sem receber dados',0)";

			echo $sql;
			$result_insert = mysqli_query($con, $sql);			
			
		}
	}
	
	mysqli_close($con);		

?>