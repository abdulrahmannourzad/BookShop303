<?php
    $errors=[];
    if(isset($_POST['mobile'])){
        $mobile =$_POST['mobile'];
        $pass =$_POST['pass'];
        if($mobile=='')
            $errors[]='شماره همراه وارد نشده است';
        if(count($errors)==0)
        {
            require('../admin-folder/config.php');
            $sql="SELECT * FROM tbl_users WHERE mobile='$mobile' AND `password`='$pass'";
            $res= mysqli_query($link, $sql);
            $row= mysqli_fetch_assoc($res);
            if($row)
            {
                session_start();
                $_SESSION['user'] = $row;
                header('location:../admin-folder/home.php');
            }
            else
                $errors[]='شماره همراه یا کلمه عبور نادرست است';
        }
    }
    include('pheader.php');
    include('../admin-folder/show_errors.php'); // نمایش خطاها
?>
<form action="Login.php" method="post" class="col-6">
    <h2 class="title2"> ورود به سایت </h2>
    <div class="form-group">
        <label for="mobile"> شماره همراه </label>
        <input type="text" name="mobile" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="pass"> رمز عبور </label>
        <input type="password" name="pass" class="form-control" />
    </div>
    <br>
    <div class="form-group">
        <input type="submit" value=" ورود به سایت " class="btn btn-info" />
    </div>
</form>
<br>
<a href="" class="tilte2" style="text-decoration:none;"> فراموشی کلمه عبور </a>
<hr>
<a href="register_user.php" class="btn btn-warning" style="text-decoration:none;"> ثبت نام جدید </a>
<?php include('pfooter.php'); ?>