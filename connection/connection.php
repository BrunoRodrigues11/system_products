<?php
    $conn = mysqli_connect("localhost","root","","bgg_technologies");
    
    if(!$conn){
        echo "Erro na conexão com o banco de dados";
        echo 'Erro: '.mysqli_connect_error();
        exit;
    }
?>