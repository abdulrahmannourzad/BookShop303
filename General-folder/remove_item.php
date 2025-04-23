<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_bid'])) {
    $bid = intval($_POST['remove_bid']); // تبدیل شناسه به عدد صحیح برای امنیت بیشتر

    // بررسی وجود سبد خرید
    if (isset($_SESSION['cart'])) {
        // بررسی وجود شناسه کتاب در سبد خرید
        if (isset($_SESSION['cart'][$bid])) {
            unset($_SESSION['cart'][$bid]); // حذف کتاب از سبد
            $_SESSION['fb'] = "کتاب با شناسه $bid با موفقیت حذف شد."; // پیام موفقیت
        } else {
            $_SESSION['fb'] = "کتاب با شناسه $bid در سبد خرید یافت نشد."; // پیام خطا
        }
    } else {
        $_SESSION['fb'] = "سبد خرید وجود ندارد."; // پیام خطا
    }

    // هدایت به صفحه سبد خرید
    header("Location: card_show.php");
    exit();
} else {
    $_SESSION['fb'] = "خطا: درخواست نامعتبر."; // پیام خطا در صورت ارسال نامعتبر
    header("Location: card_show.php");
    exit();
}
?>
