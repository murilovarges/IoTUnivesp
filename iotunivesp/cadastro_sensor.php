<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Cadastro de sensores</title>
		<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
		<script	src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="			crossorigin="anonymous"></script>
		<script> 
		$(function(){
		  $("#topnav").load("topnav.html"); 
		  $("#sidenav").load("sidenav.html"); 
		  $("#footer").load("footer.html"); 
		});
		</script> 
		
    </head>
    <body class="sb-nav-fixed">
	
		<div id="topnav"></div>
	
        <div id="layoutSidenav">
			<div id="sidenav"></div>    
            
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
						<div class="row justify-content-center">
							<div class="row justify-content-center">
								<div class="col-lg-7">
									<h1 class="text-center">Cadastro de sensor</h1>		
									
									<div class="panel-heading">Dados do sensor</div>
									<?php
									   include('conexao.php');
									   $name  		= $_POST['inputName'];
									   $description = $_POST['inputDescription'];
									   $field		= $_POST['inputField'];
									   $minValue	= $_POST['inputMinValue'];
									   $maxValue	= $_POST['inputMaxValue'];
									   $writeKey	= $_POST['inputWriteKey'];
									   $readKey		= $_POST['inputReadKey'];							   
									   $email		= $_POST['inputEmail'];		

									   echo '<div class="panel-body">Nome: '.$name.'</div>';
									   echo '<div class="panel-body">Descrição: '.$description.'</div>';
									   echo '<div class="panel-body">Campo: '.$field.'</div>';
									   echo '<div class="panel-body">Valor mínimo: '.$minValue.'</div>';
									   echo '<div class="panel-body">Valor máximo: '.$maxValue.'</div>';
									   echo '<div class="panel-body">Chave de gravação: '.$writeKey.'</div>';
									   echo '<div class="panel-body">Chave de leitura: '.$readKey.'</div>';
									   echo '<div class="panel-body">E-mail alerta: '.$email.'</div>';
									   
									   $sql="INSERT INTO channel (name, description, field, min_value, max_value, write_key, read_key, email_alert) 
											 VALUES ('".$name."','".$description."','".$field."',".$minValue.",".$maxValue.",'".$writeKey."','".$readKey."','".$email."')";
									   //echo $sql;
									   $result = mysqli_query($con, $sql);
									   if($result){
										   echo '<div class="alert alert-success">';
										   echo '<strong>Successo!</strong> Dados cadastrados com sucesso!';
										   echo	'</div>';		   
									   }else{
										   echo '<div class="alert alert-danger">';
										   echo '<strong>Atenção!</strong> Erro ao gravar dados!';
										   echo "<strong>".mysqli_error($con)."</strong>";
										   echo	'</div>';		   
										   
									   }
									   echo '<a class="btn btn-primary" href="listagem_sensor.php" role="button">Voltar</a>';	   
									?>
								</div>									
							</div>
						</div>
                    </div>
                </main>
				<div id="footer"></div>
            </div>
			
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
							
