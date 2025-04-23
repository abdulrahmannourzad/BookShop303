<?php
    session_start();
    if(isset($_POST['cart']))
        $_SESSION['cart']= $_POST['cart'];
    include('pheader.php');

    if (!isset($_SESSION['cart']) || count($_SESSION['cart'])== 0)
        echo '<h5 class="titleسبد خرید شما خالی است<"1 </h5>';
    else {
    // نمایش محتوای سبد
?>
    <h1 class="title2"> سبد خرید </h1>
    <form action="card_show.php" method="post">
        <table class="table table-bordered">
            <tr>
                <td> شناسه </td>
                <td> نام کتاب </td>
                <td> قیمت </td>
                <td> تعداد </td>
                <td> <a href="book_index.php"> صفحه اصلی </a> </td>
            </tr>
<?php
            $cart = $_SESSION['cart'];
            $total=0;
            // $link = mysqli_connect("localhost:3306","root","","db_bookshop");
            include('../admin-folder/config.php');
            foreach($cart as $bid => $qty)
            {
                $sql ="SELECT * FROM tbl_books where bid=$bid";
                $res = mysqli_query($link, $sql);
                $book = mysqli_fetch_assoc($res);
                $total += intval($qty) * $book['price'];
?>
                <tr>
                    <td><?= $book['bid'] ?></td>
                    <td><?= $book['bname'] ?></td>
                    <td><?= $book['price'] ?></td>
                    <td width="300">
                        <input type="text" size="10" name="cart[<?=$bid?>]" value="<?=$qty?>" class="form-control" />
                    </td>
                    <td><a href="" class="btn btn-warning form-control"> حذف </a></td>
                </tr>   
<?php 
            } 
?>
                <tr>
                    <td colspan="3">
                    جمع کل : <?=$total?> ریال
                    </td>
                    <td>
                        <input type="submit" class="btn btn-info form-control" value="ثبت تغییرات">
                    </td>
                    <td>
                    </td>
                </tr>
        </table>
    </form>
<?php
        }
    include('pfooter.php');
?>