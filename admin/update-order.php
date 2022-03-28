<?php include('partials/menu.php') ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Обновить заказ</h1>
    <br><br>

    <?php 
    //Проверка на установленный id
    if(isset($_GET['id'])) {

      $id = $_GET['id'];
      //Получаем все детали на основе id
      $sql = "SELECT * FROM tbl_order WHERE id=$id";

      $res = mysqli_query($conn, $sql);

      $count = mysqli_num_rows($res);

      if($count==1) {
        //Детали доступны
        $row = mysqli_fetch_assoc($res);

        $food = $row['food'];
        $price = $row['price'];
        $qty = $row['qty'];
        $status = $row['status'];
        $customer_name = $row['customer_name'];
        $customer_contact = $row['customer_contact'];
        $customer_email = $row['customer_email'];
        $customer_adress = $row['customer_adress'];

      } else {
      header('location:'.SITEURL.'admin/manage-order.php');
      }

    } else {
      header('location:'.SITEURL.'admin/manage-order.php');
    }
    ?>

    <form action="" method="POST">
      <table class="tbl-30">
        <tr>
          <td>Название блюда</td>
          <td><b><?php echo $food ?></b></td>
        </tr>
        <tr>
          <td>Price</td>
          <td><b>$<?php echo $price ?></b></td>
        </tr>
        <tr>
          <td>Количесво:</td>
          <td>
            <input type="number" name="qty" value="<?php echo $qty ?>">
          </td>
        </tr>
        <tr>
          <td>Статус:</td>
          <td>
            <select name="status">
              <option <?php if($status=="Ordered"){echo "selected";} ?>value="Ordered">Заказан</option>
              <option <?php if($status=="On Delivery"){echo "selected";} ?>value="On Delivery">Доставляется</option>
              <option <?php if($status=="Delivered"){echo "selected";} ?>value="Delivered">Доставлен</option>
              <option <?php if($status=="Cancelled"){echo "selected";} ?>value="Cancelled">Отменен</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>ФИО заказчика:</td>
          <td>
            <input type="text" name="customer_name" value="<?php echo $customer_name ?>">
          </td>
        </tr>
        <tr>
          <td>Телефон:</td>
          <td>
            <input type="text" name="customer_contact" value="<?php echo $customer_contact ?>">
          </td>
        </tr>
        <tr>
          <td>Email:</td>
          <td>
            <input type="text" name="customer_email" value="<?php echo $customer_email ?>">
          </td>
        </tr>
        <tr>
          <td>Адрес:</td>
          <td>
            <textarea name="customer_adress" cols="30" rows="5"><?php echo $customer_adress ?></textarea>
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="price" value="<?php echo $price ?>">
            <input type="submit" name="submit" value="Обновить заказ" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>

    <?php 
    
    //Проверка нажатия кнопки
    if(isset($_POST['submit'])) {
      //получаем все значения с формы и обновляем в БД
      $id = $_POST['id'];
      $price = $_POST['price'];
      $qty = $_POST['qty'];
      $total = $price * $qty;
      $status = $_POST['status'];
      $customer_name = $_POST['customer_name'];
      $customer_contact = $_POST['customer_contact'];
      $customer_email = $_POST['customer_email'];
      $customer_adress = $_POST['customer_adress'];

      $sql2 = "UPDATE tbl_order SET
        qty = $qty,
        total = $total,
        status = '$status',
        customer_name = '$customer_name',
        customer_contact = '$customer_contact',
        customer_email = '$customer_email',
        customer_adress = '$customer_adress'
        WHERE id=$id
      ";

      $res2 = mysqli_query($conn, $sql2);

      //проверка на обновление 
      if($res2 == true) {
        $_SESSION['update'] = "<div class='success'>Заказ обновлен успешно</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
      } else {
        $_SESSION['update'] = "<div class='success'>Ошибка обновления заказа</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
      }
    }
    
    ?>

  </div>
</div>

<?php include('partials/footer.php') ?>
