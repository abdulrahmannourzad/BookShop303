<?php
    session_start();
    include("pheader.php");
    
    // جهت صدور پیام
    if (isset($_SESSION['fb'])) {
?>
        <div class="alert alert-success">
            <?php
                echo $_SESSION['fb'];
                unset($_SESSION['fb']);
            ?>
        </div>
<?php 
    }
?>
<?php
    $bid= $_GET['bid'];
    // $link = mysqli_connect("localhost:3306","root","","db_bookshop");
    include('../admin-folder/config.php');
    $result = mysqli_query($link , "SELECT * FROM tbl_books where bid=$bid");
    $book = mysqli_fetch_assoc($result);

    $cover_src = $book['cover'];
    $src = "../admin-folder/covers/".$cover_src;
?>
<div class="row">
    <div class="col-sm-4 text-center">
        <img src="<?=$src?>" class="img-fluid"  style="width:250px; height:350px;">
        <h3>مؤلف: <?=$book['author']?></h3>
        <h3>قیمت: <?=$book['price']?></h3>
        <a class="btn btn-success" href="card_add.php?bid=<?=$book['bid']?>">
            افزودن به سبد
        </a>
    </div>
    <div class="col-sm-8">
        <h1><?=$book['bname']?></h1>
        <?=nl2br($book['des'])?>
    </div>
</div>
<?php 
    include("pfooter.php");
?>