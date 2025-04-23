<?php 
    $role='مدیر';
    include('check.php');
    
    require('config.php');
    if(isset($_POST['tbl_books'])) {
        $books= $_POST['tbl_books'];
        foreach($books as $bid=>$price) {
        $price=intval($price);
        $sql = "UPDATE tbl_books SET price=$price WHERE bid=$bid";
        $res=mysqli_query($link , $sql);
        }
    }
    $title_page='اصلاح قیمت کتاب ها'; 
    include('files/header.php'); ?>
    <form action="book_price.php" method="post">
         <table class="table table-bordered" >
            <tr>
                <td>شناسه</td><td>کتاب نام</td>
                <td>مؤلف</td><td>قیمت</td>
            </tr>
            <?php
            $sql ="SELECT * FROM tbl_books";
            $result = mysqli_query( $link , $sql );
            while($row = mysqli_fetch_assoc( $result )) { ?>
            <tr>
                <td><?= $row['bid'] ?></td>
                <td><?= $row['bname'] ?></td>
                <td><?= $row['author'] ?></td>
                <td width="300">
                    <input type="text" size="10"
                    name="tbl_books[<?=$row['bid']?>]"
                    value="<?= $row['price']?>"
                    class="form-control"
                    />
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="4" >
                    <input type="submit" class="btn btn-info" value="ثبت قیمت ها"/>
                    <input type="reset" class="btn btn-warning" value="بازنویسی "/>
                    <a href="book_list.php" style= "text-decoration:none;"> برگشت به لیست کتاب ها </a>
                </td>
            </tr>
        </table>
</form>
<?php include('files/footer.php');?>