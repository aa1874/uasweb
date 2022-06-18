<?php
    require_once "includes/connect.php";
    if (isset($_GET["q"])) {
        $q = $_GET["q"];
        $stmt = "SELECT * FROM videos WHERE MATCH (title) AGAINST (:keyword IN BOOLEAN MODE) ORDER BY MATCH (title) AGAINST (:keyword IN BOOLEAN MODE) DESC";
        $sth = $connect->prepare($stmt);
        $sth->bindValue(':keyword', '%'.$q.'%', PDO::PARAM_STR);
        $sth->execute();
        $details = $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    
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
    <div class="container pt-3">
        <?php
        echo '<h1>Hasil pencarian untuk "'.$q.'"</h1>';
        foreach ($details as $detail) {
            echo '<div class="row py-2">';
                echo '<div class="col-2">';
                    echo '<img src="/assets/images/posters/'.$detail["poster"].'" class="img-fluid">';
                echo '</div>';
                echo '<div class="col-8">';
                    echo '<h1>'.$detail["title"].'</h1>';
                    echo '<p class="py-1"><span class="badge bg-secondary">'.$detail["rating"].'</span>&nbsp;&nbsp;&nbsp;'.$detail["genre"].'</p>';
                    echo '<p class="py-1">'.$detail["teaser"].'</p>';
                    echo '<a href="watch.php?id='.$detail["id"].'" class="btn btn-dark">Mainkan</a> ';
                    echo '<a href="info.php?id='.$detail["id"].'" class="btn btn-outline-dark">Lebih lanjut</a> ';
                echo '</div>';
        }
        ?>
    </div>
</body>
</html>