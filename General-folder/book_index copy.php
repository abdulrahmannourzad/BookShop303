<?php include("pheader.php");?>
<div class="row">
    <?php
        include('../admin-folder/config.php');
        $result = mysqli_query($link, "SELECT * FROM tbl_books");
        while($book = mysqli_fetch_assoc( $result )) {
            $cover_src = $book['cover'];
            $src = "../admin-folder/covers/".$cover_src;
    ?>
            <div class="col-sm-3">
                <div class="box">
                    <a href="book_show.php?bid=<?=$book['bid']?>">
                        <img src="<?=$src?>" class="imageBook">
                    </a>
                    <a href="book_show.php?bid=<?=$book['bid']?>">
                        <h3 align="center">
                            <?=$book['bname']?>
                        </h3>
                    </a>
                </div>
            </div>
    <?php 
        } 
    ?>
</div>
<?php include("pfooter.php");?>