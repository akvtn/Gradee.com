<?php
if($_GET["id"]) $id = htmlspecialchars($_GET["id"]);
require_once '../administration/default.php';

if($id == 1) $set = $articles->sortedRange(0,count($articles->table),"likes","-");
else $set = $articles->table;

foreach ($set as $array):?>

    <a href="../article?id=<?= $array["id"]?>" id="main-article">
        <img src="../images/articles/<?= $array["image"]?>" alt="" id="main">
        <div class="big info">
            <span><?= $array["title"]?> [<?= $array["series"]?>]</span>
            <div class="discription">
                <p><?= $array["date"]?> - <?= $array["author"]?></p>
                <div id="likes">
                    <img src="../images/common/likes.png" alt="">
                    <p><?= $array["likes"]?></p>
                </div>
            </div>
        </div>
    </a>
<?php endforeach; ?>
