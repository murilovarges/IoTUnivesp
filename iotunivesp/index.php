
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - IoT UNIVESP</title>
		<script	src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="			crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
		<script>
		$.get("topnav.html", function(data){
			$("#topnav").replaceWith(data);
		});
		$.get("sidenav.html", function(data){
			$("#sidenav").replaceWith(data);
		});
		$.get("footer.html", function(data){
			$("#footer").replaceWith(data);
		});		
		</script> 		
		<script type = "text/JavaScript">         
            function AutoRefresh( t ) {
               setTimeout("location.reload(true);", t);
            }         
		</script>		
		
    </head>
    <body class="sb-nav-fixed" onload = "JavaScript:AutoRefresh(60000);">	 
		<div id="topnav"></div>
	
        <div id="layoutSidenav">
			<div id="sidenav"></div>    
            
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Painel de Controle</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Monitoramento</li>
                        </ol>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
									<!--
                                    <div id="chart-container">
										<canvas id="graphCanvas"></canvas>
									</div>
									
									<div class="card-header">									
                                        <i class="fas fa-chart-area me-1"></i>
                                        Sensor de temperatura refrigerador 1
                                    </div>
									-->
									<div class="card-header">									
                                        <i class="fas fa-chart-area me-1"></i>
                                        Sensor de temperatura refrigerador 1
                                    </div>
									<canvas id="graphCanvas"></canvas>
                                    <!--<div class="card-body"><canvas id="myAreaChart1" width="100%" height="40"></canvas></div>-->
                                </div>
                            </div>
							<div class="col-xl-6">
							
							
								<?php
									include('conexao.php');
									$sql = "SELECT channel_data.*, channel.name FROM channel_data 
											INNER JOIN channel on channel.id_channel = channel_data.id_channel
											ORDER BY id_channel_data desc LIMIT 100";
									$result = mysqli_query($con,$sql);			
								?>	
								
								<div class="card mb-4">
									<div class="card-header">
										<i class="fas fa-table me-1"></i>
										Últimos dados recebidos
									</div>
									<div class="card-body">
										<table id="datatablesSimple">
											<thead>
												<tr>
													<th>#</th>
													<th>Data</th>
													<th>Sensor</th>
													<th>Valor</th>
													<th>Situação</th>
													<th>IP Origem</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>#</th>
													<th>Data</th>
													<th>Sensor</th>
													<th>Valor</th>
													<th>Situação</th>
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
													echo "<td>".$row['alert_type']."</td>";											
													echo "<td>".$row['ip_source']."</td>";											
													echo "</tr>";					
												}
												?>
											
											</tbody>
										</table>
									</div>
								</div>

							
							</div>
                        </div>
                    </div>
                </main>
				<div id="footer"></div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <!--<script src="assets/demo/chart-area-demo.js"></script> -->
		<script src="assets/demo/chart-area.js"></script>        		
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
		<script src="js/scripts.js"></script>		
		
    </body>
</html>
