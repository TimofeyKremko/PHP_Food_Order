<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Обновить категорию</h1>
        <br><br>

        <?php 
        
            if(isset($_GET['id'])) {
                $id = $_GET['id'];

                $sql="SELECT * FROM tbl_category WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                } else {
                    $_SESSION['no-category-found'] = "<div class='error'>Категория не найдена</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            } else {
                header('location:'.SITEURL.'admin/manage-category.php');
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Название</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Текущее изображение</td>
                    <td>
                        <?php
                        
                        if($current_image != '') {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="250px">
                            <?php

                        } else {
                            echo "<div class='error'>Изображение не добавлено</div>";
                        }
                        
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Новое изображение</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Отображение</td>
                    <td>
                        <input <?php if($featured=="Yes") { echo "checked";} ?> type="radio" name="featured" value="Yes"> Да
                        <input <?php if($featured=="No") { echo "checked";} ?> type="radio" name="featured" value="No"> Нет
                    </td>
                </tr>
                <tr>
                    <td>Активно</td>
                    <td>
                        <input <?php if($active=="Yes") { echo "checked";} ?> type="radio" name="active" value="Yes"> Да
                        <input <?php if($active=="No") { echo "checked";} ?> type="radio" name="active" value="No"> Нет 
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name='current_image' value='<?php echo $current_image; ?>'>
                        <input type="hidden" name='id' value='<?php echo $id; ?>'>
                        <input type="submit" name="submit" value="Обновить категорию" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 

            if(isset($_POST['submit'])) {
                // 1. Получить все значения с формы
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                
                // 2. Обновление изображения
                if(isset($_FILES['image']['name'])) {
                    $image_name = $_FILES['image']['name'];

                    if($image_name != '') {
                        // загрузка новой картинки
                        //Автопереименование картинки
                        // Получить расширение картинки (jpj png gif ...) "food1.jpg"
                        $ext = end(explode('.', $image_name));

                        // переименование картинки
                        $image_name="Food_Category_".rand(000, 999).'.'.$ext; // -> Food_Category_834.jpg

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload==false) {
                            $_SESSION['upload']= "<div class='error'>Ошибка загрузки изображения</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();
                        }
                        // удаление старой
                        if($current_image !="") {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            if($remove==false) {
                                // Ошибка удаления 
                                $_SESSION['failed-remove'] = "<div class='error'>Ошибка удаления текущего изображения</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();
                            }
                        }
                        

                    } else {
                        $image_name = $current_image;
                    }

                } else {
                    $image_name = $current_image;
                }
                // 3. Обновление БД
                $sql2 = "UPDATE tbl_category SET
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id=$id
                ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2==true) {
                    $_SESSION['update'] = "<div class='success'>Категория обновлена успешно</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                } else {
                    $_SESSION['update'] = "<div class='error'>Ошибка обновления категории</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }

        ?>
    </div>
</div>

<?php include('partials/footer.php');?>
