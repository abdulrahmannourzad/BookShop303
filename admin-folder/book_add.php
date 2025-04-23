<?php
    $role='مدیر';
    include('check.php');
    
    include('config.php');
    if (isset($_POST['bname'])) {

        //بخش پردازش داده های فرم
        $bname = $_POST['bname'];
        $author= $_POST['author'];
        $price = intval($_POST['price']);
        $sid = $_POST['sid'];
        $des = $_POST['des'];
        $status = 0;
        if (isset($_POST['status'])) 
            $status=1;
        $errors=array();
        if ($bname=='')
            $errors[] = 'نام کتاب تعیین نشده است';
        if ($price==0)
            $errors[] = 'قیمت کتاب نامعتبراست';
        $cover='';
        $fsize = $_FILES['cover']['size'];
        $fname ='';
        if($fsize>0){
            $fname = $_FILES['cover']['name'];
            $tname = $_FILES['cover']['tmp_name'];
            $arr = explode('.',$fname);
            $ext = end($arr);
            if($ext !='jpg' && $ext!='png')
                $errors[] = 'فرمت فایل غیرمجاز است';
            if($fsize > 100 * 1024)
                $errors[] = 'اندازه فایل بیشتر از حد مجاز است';
        }
        if (count($errors)== 0){
            if ($fname!='') {
                $cover = time()."_".$fname;
                move_uploaded_file($tname,"covers/$cover");
            }
            $sql= "INSERT INTO tbl_books (bname,author,price,sid,des,status,cover)
                    VALUES ('$bname','$author',$price, $sid,'$des',$status,'$cover')" ;
            $res = mysqli_query ($link, $sql);
            if($res){
                // echo "رکورد جدید اضافه شد";
                // exit;
                $_SESSION['fb'] = 'رکورد جدید اضافه شد';
                header("location:book_list.php");
            }
            else echo mysqli_error($link);
        }
    }

    // بخش طراحی فرم
    $title_page="افزودن کتاب";
    include('files/header.php');
    include('show_errors.php');
?>

</div>
<form method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="bname">نام کتاب</label>
    <input type="text" maxlength="100" name="bname" class="form-control" />
</div>
<div class="form-group">
    <label for="author">نام مؤلف</label>
    <input type="text" name="author" class="form-control" />
</div>
<div class="form-group">
    <label for="price">قیمت</label>
    <input type="number" name="price" class="form-control" />
</div>
<div class="form-group">
    <label for="sid">موضوع کتاب</label>
    <select name="sid" class="form-control">
        <option value="0" >---</option>
        <?php
            $res2 = mysqli_query($link ,'SELECT * FROM tbl_subs');
            while($row2 = mysqli_fetch_assoc($res2)) { 
        ?>
                <option value="<?=$row2['sid']; ?>">
                    <?=$row2['sname']; ?>
                </option>
        <?php 
            } 
        ?>
    </select>
</div>
<div class="form-group">
    <label for="cover">تصویر جلد</label>
    <input type="file" name="cover" accept=".jpg, .png" class="form-control" />
</div>
<div class="form-group">
    <label for="des">توصیف کتاب</label>
    <textarea name="des" rows="5" class="form-control" ></textarea>
</div>
<div class="form-group">
    <br>
    <input type="submit" value="ثبت کتاب" class="btn btn-info" />
    <input type="reset" value=" بازنویسی " class="btn btn-warning" />
</div>
</form>
<?php include('files/footer.php');
