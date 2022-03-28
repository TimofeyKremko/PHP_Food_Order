<?php 
    include ('../config/constants.php');
    //1. Удаляем сессию 
    session_destroy(); 

    //2. Направляем на login
    header('location:'.SITEURL.'admin/login.php');
?>
