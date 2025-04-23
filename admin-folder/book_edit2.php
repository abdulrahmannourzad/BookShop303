<?php
    $bid = $_GET['bid'];
    include('config.php');
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
    // بخش طراحی فرم
?>