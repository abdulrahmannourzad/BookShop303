<?php
    $title_page = "جستجوی کتاب ها";
    include("files/header.php");
    $srch = '';
    $price1 = '';
    $price2 = '';

    if(isset($_POST['srch'])){
        $srch = $_POST['srch'];
        $price1 = $_POST['price1'];
        $price2 = $_POST['price2'];
    }
    $sql = "select * from tbl_books where 1=1";
    if($price1 != '')
        $sql .= "and price >= $price1 ";
    if($price2 != '')
        $sql .= "and price <= $price2 ";
    if($srch != '')
        $sql .= "and (bname like '%$srch%' or des like '%$srch%')";
?>

<form action="book_search.php" method="post">
    <div class="row">
        <div class="col-sm-1">عبارت:</div>
        <div class="col-sm-3">
            <input type="text" name="srch" value="<?=$srch?>" class="form-control"/>
        </div>
        <div class="col-sm-1">از قیمت:</div>
        <div class="col-sm-2">
            <input type="text" name="price1" size="10" value="<?=$price1?>" class="form-control" />
        </div>
        <div class="col-sm-1">تا قیمت:</div>
        <div class="col-sm-2">
            <input type="text" name="price2" size="10" value="<?=$price2?>" class="form-control" />
        </div>
        <div class="col-sm-2">
            <input type="submit" value="جستجو" class="btn btn-info"/>
        </div>
    </div>
</form>

<table class="table table-bordered">
    <tr>
        <th>شناسه </th>
        <th> نام کتاب </th>
        <th>مؤلف </th>
        <th>قیمت </th>
        <th>موضوع </th>
        <th>
            <a href="book_add.php">افزودن کتاب ها</a>
        </th>
    </tr>
    <?php
        include('config.php');
        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_assoc($result)){
    ?>
    <tr>
        <td><?= $row['bid'] ?></td>
        <td><?= $row['bname'] ?></td>
        <td><?= $row['author'] ?></td>
        <td><?= $row['price'] ?></td>
        <td><?= $row['sid'] ?></td>
        <td>
            <a href="book_delete.php?bid=<?=$row['bid']?>">
                حذف
            </a>
            |
            <a href="book_edit1.php?bid=<?=$row['bid']?>">
                ویرایش
            </a>
            |
            <a href="book_price.php">
                ویرایش گروهی قیمت ها
            </a>
        </td>
    </tr>
    <?php 
        }
    ?>
</table>
<?php include('files/footer.php');
