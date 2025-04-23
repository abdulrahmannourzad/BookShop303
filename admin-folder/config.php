<?php
    $link = mysqli_connect("localhost:3306", "root", "","db_bookshop");
    mysqli_query($link, "SET NAMES utf8");

    function getStatus(){
        global $link;
        $res = mysqli_query($link , "SELECT * FROM tbl_orders_status");
        $arr=[];
        while($row = mysqli_fetch_assoc($res)){
            $arr[$row['status_order_id']] = $row['status_order_name'];
        }
        return $arr;
    }
?>