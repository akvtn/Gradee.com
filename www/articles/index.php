<?php require_once '../administration/default.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            $page = "ARTICLES";
            require_once $root.'/blocks/head.php';
         ?>
        <script src="articles.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header-container">
                <?php require_once '../blocks/header.php'; ?>
            </div>
            <div id="content">
                <div id="all-articles-container">
                    <div class="title-container">
                        <span class="title-text">ALL ARTICLES</span>
                        <div class="title-switchers">
                            <span id="likes">LIKES</span>
                            <span id="date" class="current">DATE</span>
                        </div>
                    </div>
                    <div id="all-articles">
                        <?php
                        $id = 0;
                        require 'sorted-articles.php';
                         ?>
                    </div>
                </div>
            </div>
            <div id="footer-container">
                <?php require_once $root.'/blocks/footer.php'; ?>
            </div>
        </div>
    </body>
</html>
