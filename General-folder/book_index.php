<?php include("pheader.php"); ?>
<style>
    .book-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        padding: 20px;
    }
    .book-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        text-align: center;
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        background: #f9f9f9;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .book-card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }
    .book-card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }
    .book-card h3 {
        color: #333;
        font-size: 18px;
        margin: 15px 0;
        font-weight: bold;
    }
    .book-card .details-btn {
        margin-top: auto;
        background: #007bff;
        color: #fff;
        padding: 10px;
        width: 100%;
        text-decoration: none;
        font-weight: bold;
        border: none;
        border-top: 1px solid #ddd;
        border-radius: 0;
        transition: background 0.3s ease;
    }
    .book-card .details-btn:hover {
        background: #0056b3;
    }
</style>

<div class="book-container">
    <?php
        include('../admin-folder/config.php');
        $result = mysqli_query($link, "SELECT * FROM tbl_books");
        while ($book = mysqli_fetch_assoc($result)) {
            $cover_src = $book['cover'];
            $src = "../admin-folder/covers/" . $cover_src;
    ?>
        <div class="book-card">
            <img src="<?= $src ?>" alt="<?= htmlspecialchars($book['bname']) ?>">
            <h3><?= htmlspecialchars($book['bname']) ?></h3>
            <a href="book_show.php?bid=<?= $book['bid'] ?>" class="details-btn">مشاهده جزئیات</a>
        </div>
    <?php } ?>
</div>
<?php include("pfooter.php"); ?>
