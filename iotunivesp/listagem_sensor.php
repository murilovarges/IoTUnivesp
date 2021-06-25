<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Sensores</title>
		<script	src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="			crossorigin="anonymous"></script>
		<script> 
		$(function(){
		  $("#topnav").load("topnav.html"); 
		  $("#sidenav").load("sidenav.html"); 
		  $("#footer").load("footer.html"); 
		});
		</script> 
		
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
		<div id="topnav"></div>
	
        <div id="layoutSidenav">
			<div id="sidenav"></div>    
        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Sensores</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sensores</li>
                        </ol>
						<div class="d-flex align-items-center justify-content-between mt-4 mb-2">							
							<a class="btn btn-primary" href="cadastro_sensor.html">Cadastrar sensor</a>
						</div>
						<div>
						</div>
						

						<?php
							include('conexao.php');
							$sql = "SELECT * FROM channel";
							$result = mysqli_query($con,$sql);			
						?>						
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
											<th>Id</th>
                                            <th>Nome</th>
                                            <th>Descricao</th>
                                            <th>Campo</th>
                                            <th>Min</th>
                                            <th>Max</th>
                                            <th>Chave gravação</th>
                                            <th>Chave leitura</th>                                            
											<th>Excluir</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
											<th>Id</th>
                                            <th>Nome</th>
                                            <th>Descricao</th>
                                            <th>Campo</th>
                                            <th>Min</th>
                                            <th>Max</th>
                                            <th>Chave gravação</th>
                                            <th>Chave leitura</th>
											<th>Excluir</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
									<?php
										while($row = mysqli_fetch_array($result))
										{
											echo "<tr>";
											echo "<td>".$row['id_channel']."</td>";											
											//echo "<td><a href='altera_sensor.php?id_sensor=".$row['id_channel']."'>".$row['name']."</a></td>";					
											echo "<td>".$row['name']."</td>";
											echo "<td>".$row['description']."</td>";
											echo "<td>".$row['field']."</td>";
											echo "<td>".$row['min_value']."</td>";
											echo "<td>".$row['max_value']."</td>";
											echo "<td>".$row['write_key']."</td>";
											echo "<td>".$row['read_key']."</td>";
											echo "<td><a href='excluir_sensor.php?id_channel=".$row['id_channel']."'>Excluir</td>";
											echo "</tr>";					
										}
									?>                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; IoT UNIVESP 2021</div>
                            <div>
                                <a href="#">Política de Privacidade</a>
                                &middot;
                                <a href="#">Termos &amp; Condições de Uso</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
