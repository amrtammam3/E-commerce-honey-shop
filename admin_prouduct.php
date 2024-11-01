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

//add products to database--------------------------
if (isset($_POST['add_product'])) {
    // Get and sanitize inputs
    $product_name = $conn->real_escape_string($_POST['name']);
    $product_price = $conn->real_escape_string($_POST['price']);
    $product_detail = $conn->real_escape_string($_POST['detail']);

    // Handle image upload
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'img/' . $image;

    // Check if the product name already exists
    $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$product_name'");
    if (mysqli_num_rows($select_product_name) > 0) {
        $message[] = 'Product name already exists';
    } else {
        // Validate image size
        if ($image_size > 2000000) {
            $message[] = 'Image is too large';
        } else {
            // Move uploaded image to the target folder
            if (move_uploaded_file($image_tmp_name, $image_folder)) {
                // Insert product into the database
                $insert_product = mysqli_query($conn, "INSERT INTO `products`(`name`, `price`, `product-detail`, `image`) VALUES ('$product_name', '$product_price', '$product_detail', '$image')");
                if ($insert_product) {
                    $message[] = 'Product added successfully';
                } else {
                    $message[] = 'Failed to add product';
                }
            } else {
                $message[] = 'Failed to upload image';
            }
        }
    }
}

//    delete products from database------------------------------------------------------
    if (isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $select_delete_image = mysqli_query($conn, "SELECT image FROM `products` WHERE '$delete_id'") or die('query failed');
        $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
        unlink('img/' .$fetch_delete_image['image']);
        mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
        mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('query failed');
        mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid = '$delete_id'") or die('query failed');
        header('location:admin_prouduct.php');

    }

//    update product--------------------------------------------------------------------------------


//if (isset($_POST['update'])) {
//    // Assuming these variables are set from a form submission
//    $update_id = $_POST['id'];
//    $update_name = $_POST['name'];
//    $update_price = $_POST['price'];
//    $update_detail = $_POST['product_detail'];
//    $update_image = $_FILES['image']['name'];
//    $update_image_tmp_name = $_FILES['image']['tmp_name'];
//    $update_image_folder = 'uploads/' . basename($update_image);
//
//    echo " UPDATE `products` SET `name`=?, `price`=?, `product-detail`=?, `image`=? WHERE `id`=?";die;
//    // Prepare the SQL query to prevent SQL injection
//    $stmt = $conn->prepare("UPDATE `products` SET `name`=?, `price`=?, `product-detail`=?, `image`=? WHERE `id`=?");
//
//    if ($stmt) {
//        // Bind parameters (s for string, i for integer)
//        $stmt->bind_param("sdssi", $update_name, $update_price, $update_detail, $update_image, $update_id);
//
//        // Execute the query
//        if ($stmt->execute()) {
//            // Check if the image file was uploaded successfully
//            if (move_uploaded_file($update_image_tmp_name, $update_image_folder)) {
//                // Redirect on success
//                header('Location: admin_product.php');
//                exit();
//            } else {
//                echo "Failed to upload the image.";
//            }
//        } else {
//            echo "Failed to update the product.";
//        }
//
//        // Close the prepared statement
//        $stmt->close();
//    } else {
//        die("Failed to prepare the SQL statement.");
//    }
//}


// how to fix this error  en.mohamed amr---------------------------------------------------------------
    if(isset($_POST['update_product'])){
        $update_id = $_POST['update_id'];
        $update_name = $_POST['update_name'];
        $update_price = $_POST['update_price'];
        $update_detail = $_POST['update_detail'];
        $update_image = $_FILES['update_image']['name'];
        $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
        $update_image_folder = 'img/'.$update_image;


        $update_query = mysqli_query($conn, "UPDATE `products` SET `id`='$update_id',`name`= '$update_name',`price`='$update_price',`product-detail`='$update_detail',`image`='$update_image' WHERE id = '$update_id'") or die ('query failed');
        if ($update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
            header('location:admin_prouduct.php');
        }

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
<!--    <link rel="stylesheet" type="text/css" href="style.css">-->
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
    <div class="line2"></div>
    <section class="add-products form-container">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="input-field">
                <label>product name</label>
                <input type="text" name="name" required>
            </div>
            <div class="input-field">
                <label>product price</label>
                <input type="text" name="price" required>
            </div>
            <div class="input-field">
                <label>product detail</label>
                <textarea name="detail" required></textarea>
            </div>
            <div class="input-field">
                <label>product image</label>
                <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" required>
            </div>
            <input type="submit" name="add_product" value="add_product" class="btn">
        </form>

    </section>
    <div class="line3"></div>
    <div class="line4"></div>
    <section class="show-products">
        <div class="box-container">
            <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products` ") or die('query failed');
                if (mysqli_num_rows($select_products) > 0){
                    while ($fetch_products = mysqli_fetch_assoc($select_products)){

            ?>
            <div class="box">
                <img src="image/<?php echo $fetch_products['image']; ?>">
                <p>price : $<?php echo $fetch_products['price']; ?> </p>
                <h4><?php echo $fetch_products['name']; ?> </h4>
                <details><?php echo $fetch_products['product-detail']; ?></details>
                <a href="admin_prouduct.php?edit=<?php echo $fetch_products['id'];?>" class="edit">edit</a>
                <a href="admin_prouduct.php?delete=<?php echo $fetch_products['id'];?>" class="delete" onclick="return confirm('want to delete this product');">delete</a>
            </div>
            <?php
                    }
                }else{
                    echo `
                            <div class="empty">
                                <p>no products added yet</p>
                            </div>
                        `;
                }
            ?>
        </div>
    </section>
<!--    <div class="line"></div>-->
    <section class="update-container">
        <?php
            if (isset($_GET['edit'])){
                $edit_id = $_GET['edit'];
                $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$edit_id'") or die('query failed');
                if(mysqli_num_rows($edit_query) > 0){
                    while ($fetch_edit = mysqli_fetch_assoc($edit_query)){

        ?>
          <form method="post" action="admin_prouduct.php" enctype="multipart/form-data">
              <img src="img/<?php echo $fetch_edit['image'];?>">
              <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
              <input type="text" name="update_name" value="<?php echo $fetch_edit['name']; ?>">
              <input type="number" name="update_price" min="0" value="<?php echo $fetch_edit['price']; ?>">
              <textarea> <?php echo $fetch_edit['product-detail']; ?> </textarea>
              <input type="file" name="update_image" accept="image/jpeg, image/jpg, image/png, image/webp">
              <input type="submit" name="update_product" value="update" class="edit">
              <input type="reset" name="" value="cancle" class="option-btn btn" id="close-form">
          </form>
        <?php
                    }
                }
                echo "<script>document.querySelector('.update-container').style.display='block'</script>";
            }
        ?>

    </section>

    <script type="text/javascript" src="script.js"></script>
 </body>
</html>
