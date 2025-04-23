<?php
    session_start();
    $bid=$_GET['bid'];
    if(isset($_SESSION['cart']))
        $cart = $_SESSION['cart'];
    else 
        $cart = array();
    if(isset($cart[$bid]))
        $cart[$bid]++;
    else
        $cart[$bid] = 1;
    $_SESSION['cart'] = $cart;

    $_SESSION['fb'] = "به سبد خرید اضافه شد";
    header("location:book_show.php?bid=$bid");
?>