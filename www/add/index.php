<?php require_once '../administration/default.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            $page = "ARTICLES";
            require_once $root.'/blocks/head.php';
            require_once 'add.php';
         ?>
    </head>
    <body>
        <div id="wrapper">
            <div id="header-container">
                <?php require_once '../blocks/header.php'; ?>
            </div>
            <div id="content">
                <div id="add-article-container">
                    <div class="title-container">
                        <span class="title-text">ADD NEW ARTICLE</span>
                    </div>
                    <form id="add-article-form" method="post" enctype="multipart/form-data">
                        <span>Title</span>
                        <input type="text" name="title" id="title">
                        <span>TV series</span>
                        <input type="text" name="series" id="series">
                        <span>Image</span>
                        <input type="file" name="image">
                        <span>Text</span>
                        <textarea name="text" id="text"></textarea>
                        <input type="hidden" name="author" value="<?=$_COOKIE['user']?>">
                        <div>
                            <button type="submit" id="add-article" name="add-article" class="common-button">Add</button>
                            <span id="input-error"></span>
                        </div>
                    </form>
                </div>
            </div>
            <div id="footer-container">
                <?php require_once $root.'/blocks/footer.php'; ?>
            </div>
        </div>
    </body>
</html>
