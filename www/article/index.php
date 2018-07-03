<?php require_once '../administration/default.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            $page = "ARTICLE";
            require_once $root.'/blocks/head.php';
         ?>
         <script src="article.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header-container">
                <?php require_once '../blocks/header.php'; ?>
            </div>
            <div id="content">
                <div id="full-article">
                    <?php
                    $id = htmlspecialchars($_GET["id"]);
                    $current = $articles->get("id",$id );
                    $text = uploadFile($root."/db/articles/".$id.".txt");
                    ?>
                    <div id="article-title">
                        <span><?=$current["title"]?> [<?=$current["series"]?>]</span>
                        <div id="article-info">
                            <span><?=$current["date"]?></span>
                            <span><?=$current["author"]?></span>
                        </div>
                    </div>
                    <img src="/images/articles/<?=$current["image"]?>" alt="">
                    <p><?=$text?></p>
                </div>
                <div id="comments-container">
                    <div id="form-container">
                    <?php if(isset($_COOKIE["user"])): ?>
                           <div class="title-container">
                               <span class="title-text">LEAVE THE COMMENT</span>
                               <div id="likeContainer">
                                   <?php
                                        $user = $_COOKIE["user"];
                                        $articleId = $id;
                                        $type = "likes";
                                        require 'update.php';
                                    ?>
                               </div>
                           </div>
                           <form id="commentForm" method="post">
                               <textarea name="comment-message" id="comment-message" placeholder="Only English comments are avialible..."></textarea>
                               <input type="hidden" name="articleId" value="<?=$id?>" id="articleId">
                               <input type="hidden" name="author" value="<?=$_COOKIE['user']?>" id="author">
                               <div>
                                   <button type="submit" id="sendComment" class="common-button">Add</button>
                                   <span id="input-error"></span>
                               </div>
                           </form>
                    <?php endif ?>
                    </div>
                    <div id="article-comments">
                        <?php
                            $type = "comments";
                            require 'update.php';
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
