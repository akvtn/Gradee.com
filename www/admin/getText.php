<?php
require_once '../administration/default.php';
if($_GET["title"]) $title = htmlspecialchars($_GET["title"]);
if($_GET["table"]) $table = htmlspecialchars($_GET["table"]);


switch ($table) {
    case 'articles':
        $current = $articles->get("title",$title);
        $text = uploadFile($root."/db/articles/".$current["id"].".txt");
        break;
    case 'proposed':
        $current = $proposed->get("title",$title);
        $text = uploadFile($root."/db/proposed/".$current["id"].".txt");
        break;
}

echo $text;
 ?>
