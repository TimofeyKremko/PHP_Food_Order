<?php 
    include('../config/constants.php');
    // Проверка на наличие id и названия картинки 
    if(isset($_GET['id']) AND isset($_GET['image_name'])) {

        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Удаление файла изображения
        if($image_name != '') {
            $path = '../images/category/'.$image_name;
            $remove = unlink($path);

            // Если ошибка удаления изображения -> сообщение ошибки и остановка процесса
            if($remove==false) {
                $_SESSION['remove'] = "<div class='error'>Ошибка удаления изображения</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }
        }
        // Удаление данных из БД
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res==true) {
            $_SESSION['delete'] = "<div class='success'>Категория удалена успешно.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        } else {
            $_SESSION['delete'] = "<div class='error'>Ошибка удаления категории.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }


    } else {
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>