<?php
    // session_start();
    $role='مدیر';
    include('check.php');
    $title_page="مدیریت کتاب ها";
    include('files/header.php');
    if (isset($_SESSION['fb'])) {
?>
        <div class="alert alert-success">
            <?php
                echo $_SESSION['fb'];
                unset($_SESSION['fb']);
            ?>
        </div>
    <?php 
        }
    ?>

<?php

        //تعیین صفحه جاری
        if (isset($_GET['page'])) 
        {
            $page = intval($_GET['page']);
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
        $res = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($res);
        $total = $row['total'];
        $pages = ceil($total / $max);
        // $sql = "SELECT * FROM tbl_books LIMIT $offset, $max ";
        
        //تعیین دستور برای انتخاب رکوردها از بانک
        $sql = "SELECT * FROM tbl_books LIMIT $offset, $max ";
    
        //نمایش صفحه بندی
?>
<form method="GET" action="">
    <ul class="pagination" style="text-align: center">
        <li><a class="page-link" href="?page=1">صفحه اول</a></li>
        <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($page > 1){ echo "?page=".($page - 1);} ?>">صفحه قبل</a>
        </li>
        <li class="page-item disabled">
            <a class="page-link">صفحه <?=$page?> از <?=$pages?></a>
        </li>
        <li class="page-item <?php if($page >= $pages){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($page < $pages) { echo "?page=".($page + 1); } ?>">صفحه بعد</a>
        </li>
        <li><a class="page-link" href="?page=<?php echo $pages; ?>">صفحه آخر</a></li>
    </ul>
    <div style="text-align: center; margin-top: 10px;">
        <label for="page-number">شماره صفحه:</label>
        <input type="number" id="page-number" name="page" min="1" max="<?=$pages?>" required>
        <button type="submit">برو</button>
    </div>
</form>

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

<table class="table table-bordered">
    <tr>
        <th>شناسه </th>
        <th> نام کتاب </th>
        <th>مؤلف </th>
        <th>قیمت </th>
        <th>موضوع </th>
        <th>
            <a href="book_add.php" style= "text-decoration:none;">افزودن کتاب ها</a>
            |
            <a href="book_search.php" style= "text-decoration:none;"> جستجوی کتاب </a>
        </th>
    </tr>
    <?php
        // include('config.php');
        // $sid = $_GET['sid'];
        // if(isset($_GET['sid'])){
        //     $sid = $_GET['sid'];
        //     $sql = "SELECT * FROM tbl_books where sid = $sid";
        // }
        // else
        //     $sql = "SELECT * FROM tbl_books";
        // $result = mysqli_query($link, $sql);
        // while($row = mysqli_fetch_assoc( $result )) {
            $res = mysqli_query($link , $sql);
            while($row = mysqli_fetch_assoc($res)) { 
    ?>
    <tr>
        <td><?= $row['bid'] ?></td>
        <td><?= $row['bname'] ?></td>
        <td><?= $row['author'] ?></td>
        <td><?= $row['price'] ?></td>
        <td><?= $row['sid'] ?></td>
        <td>
            <a href="book_delete.php?bid=<?=$row['bid']?>" style="text-decoration:none;">
                حذف
            </a>
            |
            <a href="book_edit.php?bid=<?=$row['bid']?>" style="text-decoration:none;">
                ویرایش
            </a>
            |
            <a href="book_price.php" style="text-decoration:none;">
                ویرایش گروهی قیمت ها
            </a>
        </td>
    </tr>
    <?php 
        }
    ?>
</table>
<?php include('files/footer.php');
