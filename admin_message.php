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
        mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
        header('location:admin_message.php');

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
    <section class="message-container">
        <h1 class="title">unread message</h1>
        <div class="box-container">
        <?php
            $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
            if (mysqli_num_rows($select_message)>0){
                 while ($fetch_message = mysqli_fetch_assoc($select_message)){
        ?>
                <div class="box">
                    <p>user id : <span><?php echo $fetch_message['id']; ?> </span></p>
                    <p>name : <span><?php echo $fetch_message['name']; ?> </span></p>
                    <p>email : <span><?php echo $fetch_message['email']; ?> </span></p>
                    <p><?php echo $fetch_message['message']; ?></p>
<!--                    <a href="admin_message.php?delete=--><?php //echo $fetch_message['id']; ?><!--" onclick="return confirm('delete this message');">delete</a>-->
                    <a href="admin_message.php?delete=<?php echo htmlspecialchars($fetch_message['id']); ?>"
                       onclick="return confirm('Are you sure you want to delete this message?');" class="delete">Delete</a>

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
    <div class="line"></div>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
