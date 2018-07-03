<?php require_once 'administration/default.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            $page = "HOME";
            require_once $root.'/blocks/head.php';
         ?>
    </head>
    <body>
        <div id="wrapper">
            <div id="header-container">
                <?php require_once 'blocks/header.php';?>
            </div>
            <div id="content" class="vertical">
                <div id="title-articles">
                    <?php $main = $articles->sortedRange(0,10,"likes","-"); ?>
                    <a href="/article?id=<?=$main[0]["id"] ?>" id="main-article">
                        <img src="images/articles/<?=$main[0]["image"] ?>" alt="" id="main">
                        <div class="big info">
                            <span><?=$main[0]["title"] ?> [<?=$main[0]["series"] ?>]</span>
                            <div class="discription">
                                <p><?=$main[0]["date"] ?> - <?=$main[0]["author"] ?></p>
                                <div id="likes">
                                    <img src="images/common/likes.png" alt="">
                                    <p><?=$main[0]["likes"]?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="articles vertical">
                    <?php for ($i=1; $i < 3; $i++):?>
                        <a href="/article?id=<?=$main[$i]["id"] ?>">
                            <img src="images/articles/<?=$main[$i]["image"] ?>" alt="" id="main">
                            <div class="small info">
                                <span><?=$main[$i]["title"] ?> [<?=$main[$i]["series"] ?>]</span>
                                    <div class="discription">
                                    <p><?=$main[$i]["date"] ?> - <?=$main[$i]["author"] ?></p>
                                    <div id="likes">
                                        <img src="images/common/likes.png" alt="">
                                        <p><?=$main[$i]["likes"] ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endfor; ?>
                    </div>
                </div>
                <div class="main-container">
                    <div class="title-container">
                        <span class="title-text">LAST POSTED</span>
                    </div>
                    <div class="articles">
                        <?php
                        $set = $articles->sortedRange(0,3);
                        foreach ($set as $value):
                        ?>
                        <a href="/article?id=<?=$value["id"]?>">
                            <img src="images/articles/<?=$value["image"]?>" alt="" id="main">
                            <div class="small info">
                                <span><?=$value["title"]?> [<?=$value["series"]?>]</span>
                                <div class="discription">
                                    <p><?=$value["date"]?> - <?=$value["author"]?></p>
                                    <div id="likes">
                                        <img src="images/common/likes.png" alt="">
                                        <p><?=$value["likes"]?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach ?>
                    </div>
                </div>
                <div class="main-container">
                    <div class="title-container">
                        <span class="title-text">ALL TIME TOP</span>
                    </div>
                    <div class="articles">
                        <?php
                        $set = $articles->sortedRange(0,count($articles->table),"likes","-");
                        for($i=0; $i<3; $i++):
                        ?>
                        <a href="/article?id=<?=$set[$i]["id"]?>">
                            <img src="images/articles/<?=$set[$i]["image"]?>" alt="" id="main">
                            <div class="small info">
                                <span><?=$set[$i]["title"]?> [<?=$set[$i]["series"]?>]</span>
                                <div class="discription">
                                    <p><?=$set[$i]["date"]?> - <?=$set[$i]["author"]?></p>
                                    <div id="likes">
                                        <img src="images/common/likes.png" alt="">
                                        <p><?=$set[$i]["likes"]?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endfor?>
                    </div>
                </div>
            </div>
            <div id="footer-container">
                <?php require_once 'blocks/footer.php'; ?>
            </div>
        </div>
    </body>
</html>
