<?php include('partials/menu.php');?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Добавить Категорию</h1>

            <br><br>
            <?php 
            
                if(isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['upload'])) {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

            ?>
            <br><br>

            <form action="" method="POST" enctype="multipart/form-data">
                
                <table class="tbl-30">
                    <tr>
                        <td>Название:</td>
                        <td>
                            <input type="text" name="title" placeholder="Название категории">
                        </td>
                    </tr>
                    <tr>
                        <td>Выберите изображение:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Отбражение на главной странице:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Да
                            <input type="radio" checked name="featured" value="No"> Нет
                        </td>
                    </tr>
                    <tr>
                        <td>Активно:</td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Да
                            <input type="radio" checked name="active" value="No"> Нет
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Добавить категорию" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
            
            if(isset($_POST['submit'])) {
                $title = $_POST['title'];

                //для радиокнопок нужно проверять выбрана ли кнопка
                if(isset($_POST['featured'])) {
                    $featured = $_POST['featured'];
                } else {
                    $featured = "No";
                }

                if(isset($_POST['active'])) {
                    $active = $_POST['active'];
                } else {
                    $active = "No";
                }

                if(isset($_FILES['image']['name'])) {
                    $image_name = $_FILES['image']['name'];

                    // Загрузка изображения тольео если оно выбрано
                    if($image_name != "") {

                        //Автопереименование картинки
                        // Получить расширение картинки (jpj png gif ...) "food1.jpg"
                        $ext = end(explode('.', $image_name));

                        // переименование картинки
                        $image_name="Food_Category_".rand(0000, 9999).'.'.$ext; // -> Food_Category_834.jpg

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload==false) {
                            $_SESSION['upload']= "<div class='error'>Ошибка загрузки изображения</div>";
                            header('location:'.SITEURL.'admin/add-category.php');
                            die();
                        }
                    }

                } else {
                    $image_name = "";
                }
                // print_r($_FILES['image']);

                // die();

                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                $res = mysqli_query($conn, $sql);

                if($res==true) {
                    $_SESSION['add'] = "<div class='success'>Категория добавлена успешно.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                } else {
                    $_SESSION['add'] = "<div class='error'>Не удалось добавить категорию.</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
            
            ?>

        </div>
    </div>

<?php include('partials/footer.php');?>