<?php require_once '../administration/default.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            $page = "TOP";
            require_once $root.'/blocks/head.php';
         ?>
    </head>
    <body>
        <div id="wrapper">
            <div id="header-container">
                <?php require_once '../blocks/header.php';?>
            </div>
            <div id="content" class="vertical">
                <div class="title-container">
                    <span class="title-text">SERIES RATING</span>
                </div>
                <div id="top-series-container">
                    <div id="top-series">
                        <?php
                        $sorted = $series->sortedRange(0,count($series->table),"rating","-");
                        foreach ($sorted as $key => $series):
                        ?>
                        <div class="top-article">
                            <img src="../images/series/<?=$series["id"]?>.jpg">
                            <div>
                                <a href=""><?=($key+1)?>. <?=$series["title"]?></a>
                                <span><?=$series["rating"]?></span>
                            </div>
                        </div>
                    <?php endforeach ?>
                    </div>
                </div>
            </div>
            <div id="footer-container">
                <?php require_once $root.'/blocks/footer.php'; ?>
            </div>
        </div>
    </body>
</html>
