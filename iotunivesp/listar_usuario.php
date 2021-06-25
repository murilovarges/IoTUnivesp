<?php
	include('conexao.php');
	$sql = "SELECT * FROM usuario";
	$result = mysqli_query($con,$sql);			
?>
<html>
	<head>
		<!-- Meta tags Obrigatórias -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<title>Consulta de usuários</title>
	</head>
	<body>		
		<h1 class="text-center">Consulta de usuários</h1>		
		<table class="table col-8 offset-2">
			<thead>
				<tr>
					<th>Código</th>
					<th>Nome</th>
					<th>E-mail</th>
					<th>Telefone</th>
					<th>Excluir</th>  
				</tr>
			</thead>
			<tbody>
			<?php
				while($row = mysqli_fetch_array($result))
				{
					echo "<tr>";
					echo "<td>".$row['id_usuario']."</td>";
					//echo "<td>".$row['nome_usuario']."</td>";
					echo "<td><a href='altera_usuario.php?id_usuario=".$row['id_usuario']."'>".$row['nome_usuario']."</a></td>";					
					echo "<td>".$row['email_usuario']."</td>";
					echo "<td>".$row['fone_usuario']."</td>";
					echo "<td><a href='excluir_usuario.php?id_usuario=".$row['id_usuario']."'>Excluir</td>";
					echo "</tr>";					
				}
			?>
			
			</tbody>			
		</table>
		<a class="btn btn-primary col-1 offset-2" href="index.html" role="button">Voltar</a>
		
		<footer>
			<script src="js/jquery-3.6.0.min.js"</script>
			<script src="js/bootstrap.bundle.min.js"</script>
		</footer>
				
	</body>
</html>
	
