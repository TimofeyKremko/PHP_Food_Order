<?php 

    include('../config/constants.php');
    include('login-check.php');

?>





<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Food Order - Home</title>
</head>
<body>
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Домой</a></li>
                <li><a href="manage-admin.php">Админ</a></li>
                <li><a href="manage-category.php">Категории</a></li>
                <li><a href="manage-food.php">Блюда</a></li>
                <li><a href="manage-order.php">Заказы</a></li>
                <li><a href="logout.php">Выйти из системы</a></li>
            </ul>
        </div>
    </div>