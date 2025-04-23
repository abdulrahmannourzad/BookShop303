<?php
    // session_start();
    $role='مدیر';
    include('check.php');

    $bid=$_GET['bid'];
    include('config.php');
    $sql="delete from tbl_books where bid=$bid";
    $res= mysqli_query( $link , $sql);
    if ( $res ){
        $_SESSION['fb'] = 'رکورد با موفقیت حذف شد';
        header("location:book_list.php");
    }
    else 
        echo mysqli_error($link);
?>