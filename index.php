<head>
    <style>
        .box{
            width:70px;
            height:100px;
            border:1px solid #444;
            float:right;
            margin:5px;
            padding: 5px;
            text-align: center;
        }
        .box img{
            width:70px;
            height:70px;
        }
    </style>
    
</head>
    <body dir="rtl">
        <!-- هدر -->
        <?php include('General-folder/pheader.php'); ?>

        <!-- محتوای صفحه -->
        <h1 class="title2"> تازه ترین کتاب ها </h1>

        <div class="row">
        <?php
            require_once('admin-folder/config.php');
            $sql = "SELECT * FROM tbl_books WHERE status=1 ORDER By bid DESC LIMIT 0, 8";
            $res = mysqli_query($link, $sql);
            while($row=mysqli_fetch_assoc($res)){ 
        ?>
            <div class="col-sm-3">
                <div class="box">
                    <a href="book-show.php?bid=<?=$row['bid']?>">
                        <img src="admin-folder/covers/<?=$row['cover']?>" >
                        <strong><?=$row['bname']?></strong>
                    </a><br>
                    <span><?=$row['price']?>ریال</span>
                </div>
            </div>
            <?php 
            } ?>
        </div>

        <!-- فوتر -->
        <?php include('General-folder/pfooter.php');?>
    </body>
    </html>