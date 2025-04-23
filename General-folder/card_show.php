<?php
session_start();

// بررسی و اعمال تغییرات در سبد خرید
if (isset($_POST['cart'])) {
    foreach ($_POST['cart'] as $bid => $qty) {
        // اعتبارسنجی تعداد (باید یک عدد معتبر و بزرگتر از صفر باشد)
        if (filter_var($qty, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
            $_SESSION['cart'][$bid] = $qty;
        }
    }
}

include('pheader.php');

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    echo '<h5 class="title1">سبد خرید شما خالی است</h5>';
} else {
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
                // استفاده از Prepared Statements برای جلوگیری از تزریق SQL
                $stmt = $link->prepare("SELECT * FROM tbl_books WHERE bid = ?");
                $stmt->bind_param("i", $bid);
                $stmt->execute();
                $res = $stmt->get_result();
                $book = $res->fetch_assoc();

                $subtotal = intval($qty) * $book['price'];
                $total += $subtotal;
?>
                <tr>
                    <td><?= htmlspecialchars($book['bid']) ?></td>
                    <td><?= htmlspecialchars($book['bname']) ?></td>
                    <td><?= number_format($book['price']) ?> تومان</td>
                    <td width="300">
                        <input type="text" size="10" name="cart[<?= htmlspecialchars($bid) ?>]" value="<?= $qty ?>" class="form-control" />
                    </td>
                    <td><?= number_format($subtotal) ?> تومان</td>
                    <td>
                        <form method="post" action="remove_item.php">
                            <input type="hidden" name="remove_bid" value="<?= htmlspecialchars($bid) ?>" />
                            <input type="submit" class="btn btn-warning form-control" value="حذف" />
                        </form>
                    </td>
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
