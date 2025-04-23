<?php
    // $_SESSION['user'] = 'عبدالرحمان نورزاد';
?>
<!doctype html>
<html dir="rtl">
<head>
    <meta charset="utf-8">
    <title><?=$title_page?></title>
    <script src="../bs/js/jquery.min.js"></script>
    <script src="../bs/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bs/css/bootstraprtl.min.css">
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 sidebar">
                <h3>
                    <a href="../general-folder/book_index.php">
                        <img src="images/logo.png" class="logo" style="border-radius: 40%;"/>
                    </a>
                    <br>
                    فروشگاه کتاب 
                </h3>
                <ul>
                    <li><a style="text-decoration:none;" href="home.php">پیشخوان</a></li>
                    <li><a style="text-decoration:none;" href="profile.php">پروفایل</a></li>
                    <li><a style="text-decoration:none;" href="password.php">تغییر کلمه عبور</a></li>
                    <li><a style="text-decoration:none;" href="my_orders.php">سفارشات من</a></li>
                    <?php
                        if($_SESSION['user']['role']=='مدیر'){ 
                    ?>
                        <li><a style="text-decoration:none;" href="book_list.php">مدیریت کتابها </a></li>
                        <li><a style="text-decoration:none;" href="sub_list.php">مدیریت موضوعات</a></li>
                        <li><a style="text-decoration:none;" href="user_list.php">مدیریت مشتریان</a></li>
                        <li><a style="text-decoration:none;" href="order_list.php">مدیریت سفارشات</a></li>
                        <li><a style="text-decoration:none;" href="book_price.php">ویرایش گروهی قیمت ها</a></li>
                    <?php
                        }
                    ?>
                    <br>
                    <li><a style="text-decoration:none;" href="../admin-folder/Logout.php" class="btn btn-primary form-control">خروج</a></li>
                </ul>
            </div>
            <div class="col-sm-10 main">
                <!-- header -->
                <div class="header">
                    <?=$title_page ?>
                    <span class="user">
                        کاربر جاری : <?=$_SESSION['user']['uname']?>
                        [<a href="../admin-folder/Logout.php" style="text-decoration:none; color:red">خروج </a>]
                    </span>
                </div>
                <!-- Content -->
                <div class="content"> 
