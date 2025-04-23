<?php
    $title_page='مدیریت کتاب ها';
    include('files/header.php');

    //تعیین صفحه جاری
    if (isset($_GET['page'])) 
    {
        $page = intval ( $_GET['page'] ) ;
    } 
    else 
    {
        $page = 1;
    }

    //محاسبه ردیف شروع
    $max = 3;
    $offset = ($page-1) * $max;

    //محاسبه تعداد  صفحات
    include('config.php');
    $sql = "SELECT COUNT(*) as total FROM tbl_books";
    $res = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($res);
    $total = $row['total'];
    $pages = ceil($total / $max);
    $sql = "SELECT * FROM tbl_books LIMIT $offset, $max ";
    
    //تعیین دستور برای انتخاب رکوردها از بانک
    $sql = "SELECT * FROM tbl_books LIMIT $offset, $max ";

    //نمایش صفحه بندی
?>
    <ul class="pagination" style="text-align: center">
        <li><a class="page-link" href="?page=1">صفحه اول</a></li>
        <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($page > 1){ echo "?page=".($page - 1);} ?>">صفحه قبل</a>
        </li>
        <li class="page-item disabled">
            <a class="page-link">صفحه<?=$page?>از<?=$pages?></a>
        </li>
        <li class="page-item <?php if($page >= $pages){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($page < $pages) { echo "?page=".($page + 1); } ?>">
                صفحه بعد</a>
        </li>
        <li><a class="page-link" href="?page=<?php echo $pages; ?>">صفحه آخر</a></li>
    </ul>

<table class="table table-bordered" >
    <tr>
        <th>شناسه</th>
        <th>نام کتاب</th>
        <th>مؤلف</th>
        <th>قیمت</th>
        <th>موضوع</th>
        <th><a href="book_add.php">افزودن کتاب</a></th>
    </tr>
    <?php
    $res = mysqli_query($link , $sql );
    while($row = mysqli_fetch_assoc( $res )) { ?>
    <tr>
        <td><?= $row['bid'] ?></td>
        <td><?= $row['bname'] ?></td>
        <td><?= $row['author'] ?></td>
        <td><?= $row['price'] ?></td>
        <td><?= $row['sid'] ?></td>
        <td>
            <a href="book_del.php?bid=<?=$row['bid']?>">حذف</a> | 
            <a href="book_edit.php?bid=<?=$row['bid']?>">ویرایش</a>
        </td>
    </tr>
    <?php } ?>
</table>
<?php include('files/footer.php');