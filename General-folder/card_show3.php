<?php
session_start();
if (isset($_POST['cart']))
    $_SESSION['cart'] = $_POST['cart'];
include('pheader.php');

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    echo '<h5 class="title1">سبد خرید شما خالی است</h5>';
} else {
    // نمایش محتوای سبد
?>
    <h1 class="title2">سبد خرید</h1>
    <form action="card_show.php" method="post">
        <table class="table table-bordered">
            <tr>
                <td>شناسه کتاب</td>
                <td>نام کتاب</td>
                <td>قیمت</td>
                <td>تعداد</td>
                <td>مجموع</td>
                <td><a href="book_index.php">صفحه اصلی</a></td>
            </tr>
<?php
            $cart = $_SESSION['cart'];
            $total = 0;
            include('../admin-folder/config.php');
            foreach ($cart as $bid => $qty) {
                $sql = "SELECT * FROM tbl_books WHERE bid = $bid";
                $res = mysqli_query($link, $sql);
                $book = mysqli_fetch_assoc($res);
                $subtotal = intval($qty) * $book['price'];
                $total += $subtotal;
?>
                <tr>
                    <td><?= $book['bid'] ?></td>
                    <td><?= $book['bname'] ?></td>
                    <td><?= number_format($book['price']) ?> تومان</td>
                    <td width="300">
                        <input type="text" size="10" name="cart[<?= $bid ?>]" value="<?= $qty ?>" class="form-control" />
                    </td>
                    <td><?= number_format($subtotal) ?> تومان</td>
                    <td><a href="" class="btn btn-warning form-control">حذف</a></td>
                </tr>
<?php
            }
?>
                <tr>
                    <td colspan="3">جمع کل :</td>
                    <td>
                        <input type="submit" class="btn btn-info form-control" value="ثبت تغییرات">
                    </td>
                    <td colspan="2"><?= number_format($total) ?> تومان</td>
                    
                </tr>
        </table>
    </form>
<?php
}
include('pfooter.php');
?>
