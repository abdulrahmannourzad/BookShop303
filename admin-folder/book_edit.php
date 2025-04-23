<?php
    $role='مدیر';
    include('check.php');
    
    $bid = $_GET['bid']; //دریافت پارامتر شناسنامه کتاب
    include('config.php');
    $result = mysqli_query($link, "select * from tbl_books where bid = $bid");
    $row = mysqli_fetch_assoc($result);

    
    // .................................................

    if(isset($_POST['bname'])){
        // بخش پردازش داده های فرم
        $bname = $_POST['bname'];
        $author = $_POST['author'];
        $price = intval($_POST['price']);
        $sid = $_POST['sid'];
        $des = $_POST['des'];
        $cover1 = $_POST['cover1'];
        $cover = $_POST['cover1'];
        $status = 0;
        if(isset($_POST['status']))
            $status = 1;
        $errors = array();
        if($bname == '')
            $errors[] = 'نام کتاب تعیین نشده است';
        if($price == 0)
            $errors[] = 'قیمت کتاب نامعتبر است';
        $fsize = $_FILES['cover']['size'];
        $fname = '';
        if($fsize > 0){
            $fname = $_FILES['cover']['name'];
            $tname = $_FILES['cover']['tmp_name'];
            $arr = explode('.', $fname);
            $ext = end($arr);
            if($ext != 'jpg' && $ext != 'png')
                $errors[] = 'فرمت فایل غیرمجاز است';
            if($fsize > 100 * 1024)
                $errors[] = 'اندازه فایل بیشتر از حد مجاز است';
        }
        if(count($errors) == 0)
        {
            if($fname !=''){
                @unlink("covers".DIRECTORY_SEPARATOR.$cover1);
                $cover = time().'_'.$fname;
                move_uploaded_file($tname, "covers/$cover");
            }
            $sql = "update tbl_books set bname = '$bname', author = '$author', price = $price, sid = $sid, des = '$des', status = $status, cover = '$cover' where bid = $bid";
            $res = mysqli_query($link, $sql);
            if($res){
                $_SESSION['fb'] = "اطلاعات با موفقیت به‌روزرسانی شد.";
                header("location:book_list.php");
            }   
            else
                echo mysqli_error($link);
        }
    }

    // .......................................................

    // بخش طراحی فرم
    $title_page="ویرایش کتاب";
    include('files/header.php');
    include('show_errors.php');
?>
</div>

<form action = "book_edit.php?bid=<?=$row['bid']?>" method="post">
    <div class="form-group">
        <label for="bname"> نام کتاب </label>
        <input type="text" name="bname" value="<?=$row['bname'] ?>" class="form-control" />
    </div>
    <div class="form-group">
        <label for="author"> نام مؤلف </label>
        <input type="text" name="author" value="<?=$row['author'] ?>" class="form-control" />
    </div>
    <div class="form-group">
        <label for="price"> قیمت </label>
        <input type="text" name="price" value="<?=$row['price'] ?>" class="form-control" />
    </div>
    <div class="form-group">
        <input type="checkbox" name="status" <?php if($row['status']==1) echo 'checked'; ?> />
        <label for="status">قابل نمایش </label>
    </div>
    <div class="form-group">
        <label for="sid"> موضوع کتاب </label>
        <select name="sid" class="form-control">
            <option value="0" >---</option>
            <?php
                $res2 = mysqli_query($link ,"SELECT * FROM tbl_subs");
                while($row2 = mysqli_fetch_assoc($res2)) { 
            ?>
                <option value="<?=$row2['sid'];?>" <?php if($row['sid']==$row2['sid']) echo 'selected'; ?>>
                    <?=$row2['sname']; ?>
                </option>
            <?php
                } 
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="cover"> تصویر جلد </label>
        <?php if($row['cover']!=''): ?>
        <img src="covers/<?=$row['cover']?>" width="150" height="150">
        <?php endif; ?> <br><br>
        <input type="hidden" name="cover1" value="<?=$row['cover']?>" />
        <input type="file" name="cover" accept=".jpg,.png" class="form-control" />
    </div>
    <div class="form-group">
        <label for="des"> توصیف کتاب </label>
        <textarea name="des" rows="5" class="form-control" ><?=$row['des']?></textarea>
    </div>
    <br>
    <div class="form-group">
        <input type="submit" value="ثبت تغییرات" class="btn btn-info"/>
    </div>
</form>
<?php include('files/footer.php');