<?php
require_once '../administration/default.php';
if(isset($_GET["type"])) $type = htmlspecialchars($_GET["type"]);

switch ($type) {
    case 'comments':
        if(isset($_GET["id"])) $id = htmlspecialchars($_GET["id"]);
        $set = array();
        foreach ($comments->table as $array) {
            if($array["articleId"] === $id) $set[] = $array;
        }
        if(count($set)): ?>
            <div class="title-container">
                <span class="title-text">COMMENTS</span>
            </div>
            <?php foreach ($set as $array): ?>
                <div class="single-comment">
                    <div class="discription">
                        <span><?=$array["author"] ?></span>
                        <span><?=$array["date"] ?></span>
                    </div>
                    <p><?=$array["text"] ?></p>
                </div>
            <?php endforeach;
        endif;
        break;
    case 'likes':
            if(isset($_GET["user"])) $user = htmlspecialchars($_GET["user"]);
            if(isset($_GET["articleId"])) $articleId = htmlspecialchars($_GET["articleId"]);

            $json = file_get_contents("../db/likes.json");
            $data = json_decode($json,true);

            $currentUser = $users->get("username",$user);
            $userId = $currentUser["id"];
            $currentArticle = $articles->get("id",$articleId);

            if(!$data[$userId]){$data[$userId] = array();}

            if(!in_array($articleId,$data[$userId])): ?>
                <img src="../images/common/doLike.png">
                <style> #likeContainer span {color:#a0a0a0} </style>
            <?php else: ?>
                <img src="../images/common/doLiked.png">
                <style> #likeContainer span {color:red} </style>
        <?php endif;?>
                <span><?=$currentArticle["likes"] ?></span>
        <?php break;
};
?>
