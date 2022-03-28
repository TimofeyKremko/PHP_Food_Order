<?php include('partials/menu.php') ?>

<div class="main-content">
        <div class="wrapper">
            <h1>Управление заказами</h1>
            <br />
            <br />
            <?php 
            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            ?>
            <br>
            <br>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Блюдо</th>
                    <th>Цена</th>
                    <th>Количесво</th>
                    <th>Итого</th>
                    <th>Дата заказа</th>
                    <th>Статус</th>
                    <th>ФИО заказчика</th>
                    <th>Телефон</th>
                    <th>Email</th>
                    <th>Адресс</th>
                    <th>Действия</th>
                </tr>

                <?php 
                    //Получаем все заказы из БД
                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    $sn = 1; // для корректного нуммерования

                    if($count>0) {
                        //Заказ доступен
                        while($row=mysqli_fetch_assoc($res)) {
                            //Получаем все данные заказов
                            $id = $row['id'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_adress = $row['customer_adress'];

                            ?>

                            <tr>
                                <td><?php echo $sn++ ?>.</td>
                                <td ><?php echo $food ?></td>
                                <td>$<?php echo $price ?></td>
                                <td class='text-center'><?php echo $qty ?></td>
                                <td>$<?php echo $total ?></td>
                                <td class='text-center'><?php echo $order_date ?></td>

                                <td>
                                    <?php
                                        if($status=="Ordered") {
                                            echo "<label>Заказан</label>";
                                        } else if($status=="On Delivery") {
                                            echo "<label style='color: orange;'>Доставляется</label>";
                                        } else if($status=="Delivered") {
                                            echo "<label style='color: green;'>Доставлен</label>";
                                        } else if($status=="Cancelled") {
                                            echo "<label style='color: red;'>Отменен</label>";
                                        }
                                    ?>
                                </td>

                                <td><?php echo $customer_name ?></td>
                                <td><?php echo $customer_contact ?></td>
                                <td><?php echo $customer_email ?></td>
                                <td><?php echo $customer_adress ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>"class="btn-secondary">Обновить</a>
                                </td>
                            </tr>

                            <?php
                        }
                    } else {
                        //нет заказов
                        echo "<tr><td colspan='12' class='error'>Заказов нет</td></tr>";
                    }
                ?>

                
                
            </table>
           
        </div>
    </div>

<?php include('partials/footer.php') ?>
