<?php
   $hostname = "localhost";
   $database = "iotunivesp";
   $username = "root";   
   $password = "";  
   //$database = "bi112616_iotunivesp";
   //$username = "murilo";   
   //$password = "123456";   

   
   $con = mysqli_connect($hostname, $username, $password)
   or die (mysql_error()."Erro ao tentar conectar-se ao banco de dados");
   mysqli_select_db ($con, $database);
?>


