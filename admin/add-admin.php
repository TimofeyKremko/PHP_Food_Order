<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Добавить Админа</h1>
        <br /><br />

        <?php 
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']); // Удаляем сессионное сообщение

            }
        ?>

        <form action="" method="POST">

            <table class ="tbl-30">
                <tr>
                    <td>ФИО:</td>
                    <td><input type="text" name="full_name" placeholder="Введите ваше Имя"></td>
                </tr>
                <tr>
                    <td>Логин:</td>
                    <td><input type="text" name="username" placeholder="Введите ваш логин"></td>
                </tr>
                <tr>
                    <td>Пароль:</td>
                    <td><input type="password" name="password" placeholder="Введите ваш пароль"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Добавить Админа" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php 
    //Обработка данных из формы, отправка в БД

    if(isset($_POST['submit'])) {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //шифрование с помощью md5

        // SQL Запрос
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        //Выполнение запроса и сохра данных в БД
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //Проверка вставки данных и показ соответствующего сообщения
        if ($res==TRUE) {
           // Переменная сессии для показа сообщения
           $_SESSION['add'] = '<div class="success">Администратор добавлен успешно</div>';
           // Перенаправляющая страница на админа
           header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else {
            // Переменная сессии для показа сообщения
            $_SESSION['add'] = '<div class="error">Ошибка добавления Администратора</div>';
            // Перенаправляющая страница на добавление админа
            header('location:'.SITEURL.'admin/add-admin.php');
        }

    }

?>