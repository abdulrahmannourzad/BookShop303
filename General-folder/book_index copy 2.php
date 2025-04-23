<?php include("pheader.php");?>
<style>
    .book-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin: 20px auto;
    }
    .book-card {
        width: 250px;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #fff;
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
        text-align: center;
        color: #333;
        font-size: 18px;
        margin: 15px 10px;
        font-weight: bold;
    }
    .book-card a {
        text-decoration: none;
    }
    .book-card .details-btn {
        display: block;
        text-align: center;
        background: #007bff;
        color: #fff;
        padding: 10px;
        font-weight: bold;
        border-top: 1px solid #ddd;
        text-decoration: none;
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
                <a href="book_show.php?bid=<?= $book['bid'] ?>">
                    <img src="<?= $src ?>" alt="<?= htmlspecialchars($book['bname']) ?>">
                </a>
                <h3>
                    <a href="book_show.php?bid=<?= $book['bid'] ?>"><?= htmlspecialchars($book['bname']) ?></a>
                </h3>
                <a href="book_show.php?bid=<?= $book['bid'] ?>" class="details-btn">مشاهده جزئیات</a>
            </div>
    <?php 
        }
    ?>
</div>
<?php include("pfooter.php");?>
