<?php
session_start();

// بررسی ارسال داده
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_bid'])) {
    $bid = $_POST['remove_bid'];

    // بررسی وجود سبد خرید و شناسه کتاب
    if (isset($_SESSION['cart'][$bid])) {
        unset($_SESSION['cart'][$bid]); // حذف کتاب از سبد
    }

    // هدایت مجدد به صفحه سبد خرید
    header("Location: card_show.php");
    exit();
} else {
    // در صورتی که روش ارسال یا داده‌های مناسب وجود نداشته باشد
    echo "خطا: درخواست نامعتبر.";
    exit();
}
?>
