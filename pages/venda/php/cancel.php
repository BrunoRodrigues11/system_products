<?php
    session_start();
    unset($_SESSION['produtos']);
    unset($_SESSION['total_venda']);
    header('location: ../listagem.php');
?>