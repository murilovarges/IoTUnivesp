<?php

	include('conexao.php');
	$sql = "SELECT * FROM (
			SELECT datetime_info, value_info
			FROM channel_data 
			where id_channel = 1			
			ORDER BY id_channel_data desc LIMIT 30
			) sub ORDER BY datetime_info";
	$result = mysqli_query($con,$sql);		
	$data = array();
	foreach ($result as $row) {
		$data[] = $row;
	}
	mysqli_close($con);
	echo json_encode($data);	

?>