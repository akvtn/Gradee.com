<?php
require_once '../administration/default.php';
$articleId = $_POST["articleId"];
$author = $_POST["author"];
$user = $users->get("username",$author);
$userId = $user["id"];

if($_GET["type"] == "liked"){
    $json = file_get_contents("../db/likes.json");
    $data = json_decode($json,true);
    $currentArticle = $articles->get("id",$articleId);
    $quantity = json_decode($currentArticle["likes"]);

    if(!in_array($articleId,$data[$userId])){
        $data[$userId][] = $articleId;
        $quantity += 1;
    }else {
        array_splice($data[$userId],array_search($articleId,$data[$userId]),1);
        $quantity -= 1;
    }

    $articles->change($articleId,"likes",$quantity);
    $encoded = json_encode($data);
    file_put_contents("../db/likes.json",$encoded);

}else {
    $text = $_POST["comment-message"];
    $date = date("F j, Y");
    if(strlen($text) < 3) {
        echo "error";
    }else {
        $comments->add(array($articleId,$author,$text,$date));
    }
}


?>
