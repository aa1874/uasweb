<?php
    require_once "includes/connect.php";
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $stmt = "SELECT * FROM videos WHERE id = ?";
        $sth = $connect->prepare($stmt);
        $sth->execute(array($id));
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
        foreach ($details as $detail) {
            echo '<div class="row">';
                echo '<div class="col-lg-7 col-md-9">';
                    echo '<video class="img-fluid" autoplay controls>';
                        echo '<source src="/videos/'.$detail["video"].'" type="video/mp4">';
                        echo 'Your browser does not support the video tag.';
                    echo '</video>';
                    echo '<h1>'.$detail["title"].'</h1>';
                    echo '<p class="py-1"><span class="badge bg-secondary">'.$detail["rating"].'</span>&nbsp;&nbsp;&nbsp;'.$detail["genre"].'</p>';
                    echo '<p class="py-1">'.$detail["teaser"].'</p>';
                echo '</div>';
        }
        ?>
    </div>
</body>
</html>