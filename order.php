<?php include('./partials-front/menu.php') ?>


<?php 
    //проверка установлен ли id 
    if(isset($_GET['food_id'])) {
        //получаем id еды и детали выбранной еды
        $food_id = $_GET['food_id'];

        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1) {

            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];

        } else {
            // Еды нет
            header('location:'.SITEURL);
        }

    } else {
        header('location:'.SITEURL);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            <h2 class="text-center text-white">Заполните форму для подтверждения заказа</h2>

            <form action="" method="POST" class="order">
                
                <fieldset>
                    
                    <legend>Выбранное блюдо</legend>
                    

                    <div class="food-menu-img">
                        
                        <?php
                            //Проверка на наличие изображения
                            if($image_name=="") {
                                echo "<div class='error'>Изображение недоступно</div>";
                            } else {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                <?php
                            }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        
                        <p class="food-price">$<?php echo $price ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Количество</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Ваше ФИО</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Номер телефона</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Адрес</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
            
            //проверка на нажатие кнопки
                if(isset($_POST['submit'])) {
                    //Получаем детали из формы
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty; // Полная цена заказа
                    $order_date = date("Y-m-d h:m:s");
                    $status = "Заказан"; //Заказан Доставляется Доставлен Отказаться
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_adress = $_POST['address'];

                    $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_adress = '$customer_adress'
                    ";

                    echo $sql2;
                    
                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == true) {
                        $_SESSION['order'] = "<div class='success text-center'>Заказ успешно создан</div>";
                        header('location:'.SITEURL);

                    } else {
                        $_SESSION['order'] = "<div class='error text-center'>Ошибка добавления заказа</div>";
                        header('location:'.SITEURL);
                    }
                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <!-- footer Section Starts Here -->
    <section class="footer">
        <div class="container text-center">
            <p>&copy; All rights reserved. Designed By Tsimafei Kremko</p>
        </div>
    </section>
    <!-- footer Section Ends Here -->

</body>
</html>