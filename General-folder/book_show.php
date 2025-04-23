<?php
session_start();
include("pheader.php");

// نمایش پیام موفقیت
if (isset($_SESSION['fb'])) {
?>
    <div class="alert alert-success" style="margin: 10px; text-align: center; border-radius: 5px; background-color: #d4edda; color: #155724;">
        <?php
        echo $_SESSION['fb'];
        unset($_SESSION['fb']);
        ?>
    </div>
<?php 
}

// بازیابی جزئیات کتاب
$bid = intval($_GET['bid']);
include('../admin-folder/config.php');
$result = mysqli_query($link, "SELECT * FROM tbl_books WHERE bid=$bid");
$book = mysqli_fetch_assoc($result);

$cover_src = $book['cover'];
$src = "../admin-folder/covers/" . $cover_src;
?>
<style>
    .book-details {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        gap: 20px;
        margin: 20px auto;
        max-width: 1000px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        background: #f9f9f9;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .book-details img {
        max-width: 300px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .book-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .book-info h1 {
        font-size: 2rem;
        color: #333;
        margin-bottom: 15px;
        text-align: left;
    }
    .book-info h3 {
        font-size: 1.2rem;
        color: #555;
        margin-bottom: 10px;
    }
    .book-info p {
        font-size: 1rem;
        color: #666;
        margin-bottom: 20px;
        line-height: 1.6;
        text-align: justify;
    }
    .action-buttons {
        display: flex;
        gap: 10px;
    }
    .btn-custom {
        padding: 10px 20px;
        text-align: center;
        font-size: 1rem;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
        text-decoration: none;
    }
    .btn-custom-success {
        background: #28a745;
        color: #fff;
    }
    .btn-custom-success:hover {
        background: #218838;
    }
</style>

<div class="book-details">
    <!-- تصویر کتاب -->
    <div>
        <img src="<?= $src ?>" alt="<?= htmlspecialchars($book['bname']) ?>">
    </div>

    <!-- اطلاعات کتاب -->
    <div class="book-info">
        <h1><?= htmlspecialchars($book['bname']) ?></h1>
        <h3>مؤلف: <?= htmlspecialchars($book['author']) ?></h3>
        <h3>قیمت: <?= number_format($book['price']) ?> تومان</h3>
        <p><?= nl2br(htmlspecialchars($book['des'])) ?></p>

        <!-- دکمه‌ها -->
        <div class="action-buttons">
            <a class="btn-custom btn-custom-success" href="card_add.php?bid=<?= $book['bid'] ?>">افزودن به سبد</a>
        </div>
    </div>
</div>

<?php include("pfooter.php"); ?>
