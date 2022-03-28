<?php 

    include('../config/constants.php');

    //1 получить id админа 
    echo $id = $_GET['id'];
    //2 создать запрос на удаление админа
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    //выполнение запроса
    $res = mysqli_query($conn, $sql);

    if ($res==true) {
        $_SESSION['delete'] = "<div class='success'>Админ удален успешно</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else {
        $_SESSION['delete'] = "<div class='error'>Ошибка удаления. Попробуйте удалить позже</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
?>