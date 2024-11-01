<?php
 global $conn;
 include 'connection.php';
 session_start();

 if (isset($_POST['submit-btn'])){
    $filter_email =filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email= mysqli_real_escape_string($conn,$filter_email);

    $filter_password =filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
    $password= mysqli_real_escape_string($conn,$filter_password);

    $select_user = mysqli_query($conn,"SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

    if(mysqli_num_rows($select_user)>0){
        $row = mysqli_fetch_assoc($select_user);
        if ($row['user-type']=='admin'){
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_pannel.php');
        }else if($row['user-type']=='user'){
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:index.php');
        }else{
            $message[] = 'incorrect email or password';
        }
    }
 }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register page</title>
</head>
<body>


<section class="form-container">
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
    <form method="post">
        <h1>login now</h1>
        <div class="input-field">
            <label>your email</label><br>
            <input type="email" name="email" placeholder="enter your email" required>
        </div>
        <div class="input-field">
            <label>your password</label><br>
            <input type="password" name="password" placeholder="enter your password" required>
        </div>
        <input type="submit" name="submit-btn" value="login now" class="btn" required>
        <p>do not have an account ? <a href="register.php">register now</a></p>

    </form>
</section>
</body>
</html>


