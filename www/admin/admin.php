<?php

require_once '../administration/default.php';
$action = htmlspecialchars($_GET['action']);

if(isset($_POST["ids"])){
    $elements = $_POST["ids"];
    $ids =  explode(",",$elements);

    foreach ($ids as $id) {
        switch ($action) {
            case '1':
                $users->delete($id);
                break;
            case '2':
                $users->change($id,"banned","1");
                break;
            case '3':
                $users->change($id,"banned","0");
                break;
            case '4':
                $comments->delete($id);
                break;
            case '5':
                $articles->delete($id);
                unlink($root."/db/articles/".$id.".txt");
                unlink($root."/images/articles/".$id.".jpg");
                break;
            case '6':
                $proposed->delete($id);
                unlink($root."/db/proposed/".$id.".txt");
                unlink($root."/images/proposed/".$id.".jpg");
                break;
            case '7':
                $lastArticle = $articles->table[0];
                $current = $proposed->get("id",$id);
                $articles->add(array($current["title"],
                                    $current["series"],
                                    ($lastArticle["id"]+1).".jpg",
                                    $current["author"],
                                    $current["date"],
                                    0));
                $last = $articles->table[0];
                rename($root."/db/proposed/".$id.".txt",$root."/db/articles/".$last["id"].".txt");
                rename($root."/images/proposed/".$id.".jpg",$root."/images/articles/".$last["id"].".jpg");
                $proposed->delete($id);
                break;
        }
    }


}
?>
