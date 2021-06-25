<?php
	include('conexao.php');
	$sql = "SELECT channel_data.*, channel.name FROM channel_data 
			INNER JOIN channel on channel.id_channel = channel_data.id_channel
			ORDER BY id_channel_data desc LIMIT 20";
	$result = mysqli_query($con,$sql);			
	
?>					

<table id="datatablesSimple">
	<thead>
		<tr>
			<th>#</th>
			<th>Data</th>
			<th>Sensor</th>
			<th>Valor</th>
			<th>IP Origem</th>                                            
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>#</th>
			<th>Data</th>
			<th>Sensor</th>
			<th>Valor</th>
			<th>IP Origem</th>                                                                                    
		</tr>
	</tfoot>
	<tbody>
	<?php
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr>";
			echo "<td>".$row['id_channel_data']."</td>";
			echo "<td>".$row['datetime_info']."</td>";
			echo "<td>".$row['name']."</td>";
			echo "<td>".$row['value_info']."</td>";
			echo "<td>".$row['ip_source']."</td>";											
			echo "</tr>";					
		}
	?>
	</tbody>
</table>
