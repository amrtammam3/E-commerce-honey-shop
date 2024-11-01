
<?php
global $conn;
include 'connection.php';
session_start();
$admin_id = $_SESSION['admin_name'];

if(!isset($admin_id)){
    header('location:login.php');
}

if(isset($_POST['logout'])){
    session_destroy();
    header('location:login.php');
}


//    delete products from database------------------------------------------------------
if (isset($_GET['delete'])){
    $delete_id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM `order` WHERE id = '$delete_id'") or die('query failed');
    $message[]='user removed successfully';
    header('location:admin_order.php');

}

//updating payment status------------------------------------------------------------------
if (isset($_POST['update_order'])){
    $order_id= $_POST['order_id'];
    $update_payment= $_POST['update_payment'];

    mysqli_query($conn, "UPDATE `order` SET `payment-status` = '$update_payment' WHERE id= '$order_id'") or die('query failed');
}


?>
<style type="text/css">
    <?php
        include 'style.css';
    ?>
</style>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>admin pannel</title>
</head>
<body>
<?php  include 'admin_header.php'; ?>
<?php
if(isset($message)){
    foreach ($message as $message){
        echo '
                       <div class="message">
                             <span>'.$message.'</span>
                             <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                        </div>
                  ';
    }
}
?>
<div class="line4"></div>
<section class="order-container">
    <h1 class="title">total order placed</h1>
    <div class="box-container">
        <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `order`") or die('query failed');
        if (mysqli_num_rows($select_orders)>0){
            while ($fetch_orders = mysqli_fetch_assoc($select_orders)){
                ?>
                <div class="box">
                    <p>user name : <span><?php echo $fetch_orders['name']; ?> </span></p>
                    <p>user id : <span><?php echo $fetch_orders['user-id']; ?> </span></p>
                    <p>placed on : <span><?php echo $fetch_orders['placed-on']; ?> </span></p>
                    <p>number : <span><?php echo $fetch_orders['number']; ?></span></p>
                    <p>email : <span><?php echo $fetch_orders['email']; ?></span></p>
                    <p>total price : <span><?php echo $fetch_orders['total-price']; ?></span></p>
                    <p>method : <span><?php echo $fetch_orders['method']; ?></span></p>
                    <p>address : <span><?php echo $fetch_orders['address']; ?></span></p>
                    <p>total product : <span><?php echo $fetch_orders['total-products']; ?></span></p>
                    <form method="post">
                        <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                        <select name="update_payment">
                            <option disabled selected><?php echo $fetch_orders['payment-status']; ?></option>
                            <option value="pending">pending</option>
                            <option value="complete">complete</option>
                        </select>
                        <input type="submit" name="update_order" value="update payment" class="btn">
                        <a href="admin_order.php?delete=<?php echo $fetch_orders['id']; ?>;" onclick="return confirm('delete this order');" class="delete">delete</a>
                    </form>

                </div>
                <?php
            }

        }else{
            echo `
                            <div class="empty">
                                <p>no order placed yet</p>
                            </div>
                        `;
        }
        ?>

    </div>
</section>
<div class="line"></div>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
