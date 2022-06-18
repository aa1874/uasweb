<?php
    require_once "includes/connect.php";

    $stmt1 = $connect->query("SELECT id, title, poster, teaser FROM videos ORDER BY RAND(id) LIMIT 10");
    $rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    $stmt2 = $connect->query("SELECT id, title, poster, teaser FROM videos ORDER BY id DESC LIMIT 10");
    $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nonton.com - Streaming untuk para nerd</title>
    <link rel="stylesheet" href="/assets/css/style.css">
<body>
    <?php include "includes/header.php"; ?>
    <div id="featuredcarousel" class="carousel slide py-3 mb-3 bg-dark bg-opacity-25" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            foreach ($rows1 as $row1) {
                if ($row1["id"] == 4) {
                    $active = "active";
                } else {
                    $active = "";
                }
                    echo '<div class="carousel-item '.$active.'">';
                        echo '<div class="container">';
                            echo '<div class="row">';
                                echo '<div class="col-sm-2">';
                                    echo '<img src="/assets/images/posters/'.$row1["poster"].'" class="img-fluid">';
                                echo '</div>';
                                echo '<div class="col-sm-7">';
                                    echo '<h1>'.$row1["title"].'</h1>';
                                    echo '<p>'.$row1["teaser"].'</p>';
                                    echo '<p>';
                                        echo '<a href="watch.php?id='.$row1["id"].'" class="btn btn-dark">Mainkan</a> ';
                                        echo '<a href="info.php?id='.$row1["id"].'" class="btn btn-outline-dark">Lebih lanjut</a>';
                                    echo '</p>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';  
                                 
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#featuredcarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#featuredcarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section class="container">
        <h3>Yang Baru di Nonton.com</h3>
        <div class="movie-list py-3">
            <div class="row">
                <?php
                foreach ($rows2 as $row2) {
                    echo '<div class="col-2">';
                        echo '<a href="info.php?id='.$row2["id"].'">';
                            echo '<img src="/assets/images/posters/'.$row2["poster"].'" class="img-fluid">';
                        echo '</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>