<?php 
//проверка на автризацию пользователя
if (!isset($_SESSION['user'])) {

    $_SESSION['no-login-message'] = "<div class='error text-center'>Пожалуйста, войдите для доступа к панели Админа</div>";
    header('location:'.SITEURL.'admin/login.php' );
}

?>