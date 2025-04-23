<?php
$errors = [];
if (isset($_POST['mobile'])) {
    $mobile = trim($_POST['mobile']); // حذف فاصله‌های اضافی
    $pass = trim($_POST['pass']);
    if ($mobile == '') {
        $errors[] = 'شماره همراه وارد نشده است';
    }
    if (count($errors) == 0) {
        require('../admin-folder/config.php');
        $sql = "SELECT * FROM tbl_users WHERE mobile='$mobile' AND `password`='$pass'";
        $res = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($res);
        if ($row) {
            session_start();
            $_SESSION['user'] = $row;
            header('location:../admin-folder/home.php');
        } else {
            $errors[] = 'شماره همراه یا کلمه عبور نادرست است';
        }
    }
}
include('pheader.php');
include('../admin-folder/show_errors.php'); // نمایش خطاها
?>
<div class="login-container" style="max-width: 500px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background: #f9f9f9; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <form action="Login.php" method="post">
        <h2 class="title2" style="text-align: center; color: #333; margin-bottom: 20px;">ورود به سایت</h2>
        <div class="form-group" style="margin-bottom: 15px;">
            <label for="mobile" style="display: block; font-weight: bold; color: #555;">شماره همراه</label>
            <input type="text" name="mobile" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" placeholder="0912...">
        </div>
        <div class="form-group" style="margin-bottom: 15px;">
            <label for="pass" style="display: block; font-weight: bold; color: #555;">رمز عبور</label>
            <input type="password" name="pass" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" placeholder="••••••••">
        </div>
        <div class="form-group" style="text-align: center; margin-top: 20px;">
            <input type="submit" value="ورود به سایت" class="btn btn-info" style="background: #007bff; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
        </div>
    </form>
    <div style="text-align: center; margin-top: 20px;">
        <a href="#" style="text-decoration: none; color: #007bff;">فراموشی کلمه عبور</a>
        <hr style="margin: 20px 0;">
        <a href="register_user.php" class="btn btn-warning" style="text-decoration: none; background: #ffc107; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">ثبت نام جدید</a>
    </div>
</div>
<?php include('pfooter.php'); ?>
