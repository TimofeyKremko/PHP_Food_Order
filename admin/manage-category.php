<?php include('partials/menu.php')?>

<div class="main-content">
        <div class="wrapper">
            <h1>Управление категориями</h1>
            <br /><br />
            <?php 
            
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['remove'])) {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['no-category-found'])) {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }
            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['failed-remove'])) {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
        ?>
        <br /><br />

            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Добавить категорию</a>
            <br />
            <br />
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Название</th>
                    <th>Изображение</th>
                    <th>Отображение</th>
                    <th>Активно</th>
                    <th>Действия</th>
                </tr>

                <?php 
                
                    $sql = "SELECT * FROM tbl_category";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    //создаем переменную S.N.
                    $sn = 1;

                    if($count > 0 ) {

                        while($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>

                            <tr>
                                <td><?php echo $sn++ ?>.</td>
                                <td><?php echo $title ?></td>

                                <td>
                                    <?php 
                                        //проверка на доступность названия картинки
                                        if($image_name!="") {
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>"width='200px'>
                                            <?php
                                        } else {
                                            echo "<div class='error'>Изображение не добавлено</div>";
                                        }
                                    ?>
                                </td>

                                <td><?php echo $featured ?></td>
                                <td><?php echo $active ?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Обновить категорию</a>
                                    <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Удалить категорию</a>
                                </td>
                            </tr>

                            <?php
                        }

                    } else {
                        //Будем показывать сообщение внутри таблицы
                        ?>

                        <tr>
                            <td colspan="6">
                                <div class="error">Категории не добавлены.</div>
                            </td>
                        </tr>

                        <?php
                    }

                ?>

                
                
            </table>
           
        </div>
    </div>

<?php include('partials/footer.php') ?>
