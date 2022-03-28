<?php include('../config/constants.php') ?>

<html>
    <head>
        <title>Вход - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        
        <div class="login">
            <h1 class="text-center">Авторизация</h1>  
            <br><br>

            <?php 
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset ($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);  
            }
            ?>

            <br><br>
            
            <form action="" method="POST" class="text-center">
                Логин: <br>
                <input type="text" name="username" placeholder="Введите логин"><br><br>

                Пароль: <br>
                <input type="password" name="password" placeholder="Введите пароль"><br><br>

                <input type="submit" name="submit" value="Войти" class="btn-primary">
                <br><br>
            </form>

            <p class="text-center">&copy;Created By - Tsimafei Kremko</p>
        </div>

    </body>
</html>

<?php 

    if(isset($_POST['submit'])) {
        //1. получаем данные с формы
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQL провека на наличие юзера
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Выполнить запрос
        $res = mysqli_query($conn, $sql);

        //4. подсчет строк для проверки, существует ли пользователь или нет
        $count = mysqli_num_rows($res);

        if($count==1) {
            $_SESSION['login'] = "<div class='success' >Вход успешно выполнен.</div>";
            $_SESSION['user'] = $username; //проверка на авторизацию юзера
            header('location:'.SITEURL.'admin/');
        } else {
            $_SESSION['login'] = "<div class='error text-center' >Неверный логин или пароль</div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>