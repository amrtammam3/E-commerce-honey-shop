<?php
global $conn;
include 'connection.php';
session_start();
$admin_id = $_SESSION['user_name'];

if(!isset($admin_id)){
    header('location:login.php');
}

if(isset($_POST['logout'])){
    session_destroy();
    header('location:login.php');
}
?>
<style type="text/css">
        <?php
            include 'main.css';
        ?>
</style>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="main.css">


</head>
<body>
    <?php include 'header.php'; ?>

<!--    home slider--------------------------------------------------->
    <div class="container-fluid">
        <div class="hero-slider">
            <div class="slider-item">
                <div class="slider-caption">
                    <span>test the quality</span>
                    <h1>organic premium <br>honey</h1>
                    <p>enjoy sweet aromatic honey made by hardworking people of <br>clean row </p>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="slider-item">
                <img src="img/back.jpg">
                <div class="slider-caption">
                    <span>test the quality</span>
                    <h1>organic premium <br>honey</h1>
                    <p>enjoy sweet aromatic honey made by hardworking people of <br>clean row </p>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
        </div>
        <div class="controls">
            <i class="bi bi-chevron-left prev"></i>
            <i class="bi bi-chevron-right next"></i>
        </div>
    </div>
    <div class="services">
        <div class="row">
            <div class="box">
                <img src="img/back.jpg">
                <div>
                    <h1>free shipping</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Autem pariatur atque, deserunt facilis rem aliquid voluptas labore optio nostrum dolore, ad necessitatibus delectus omnis! Consequuntur aliquid neque expedita possimus ducimus.</p>
                </div>
            </div>
            <div class="box">
                <img src="img/back.jpg">
                <div>
                    <h1>money back & gurantee</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Autem pariatur atque, deserunt facilis rem aliquid voluptas labore optio nostrum dolore, ad necessitatibus delectus omnis! Consequuntur aliquid neque expedita possimus ducimus.</p>
                </div>
            </div>
            <div class="box">
                <img src="img/back.jpg">
                <div>
                    <h1>online support 24/7</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Autem pariatur atque, deserunt facilis rem aliquid voluptas labore optio nostrum dolore, ad necessitatibus delectus omnis! Consequuntur aliquid neque expedita possimus ducimus.</p>
                </div>
            </div>
        </div>
    </div>
<!--    <div class="line"></div>-->
    <?php include 'footer.php'; ?>
    <script src="jquery.js"></script>
    <script src="slick.js"></script>
    <script type="text/javascript">
        <?php include 'script2.js'?>
    </script>




    <!--slick slider link--------------------------------------->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carouse1/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="script2.js"></script>


    <!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css">-->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>



</body>
</html>