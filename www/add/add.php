<?php
    require_once '../administration/default.php';
    if(isset($_POST["title"]) && isset($_POST["series"]) && isset($_POST["text"])
        && isset($_FILES["image"]) && isset($_POST["add-article"])){

        $title = $_POST["title"];
        $series = $_POST["series"];
        $text = $_POST["text"];
        $author = $_POST["author"];
        $date = date("F j, Y");


        $tmp_name = $_FILES["image"]["tmp_name"];

        $current = $users->get("username",$author);
        if($users->status($current["id"],"admin") == "1"){
            $last = $articles->table[0];
            $name = ($last["id"]+1).".jpg";
            $articles->add(array($title,$series,$name,$author,$date,0));
            fillFile($root."/db/articles/".($last["id"]+1).".txt",$text);
            $directory = $root."/images/articles/";
            move_uploaded_file($tmp_name,$directory.$name);
        }else {
            $last = $proposed->table[0];
            $name = ($last["id"]+1).".jpg";
            $proposed->add(array($title,$series,$name,$author,$date));
            fillFile($root."/db/proposed/".($last["id"]+1).".txt",$text);
            $directory = $root."/images/proposed/";
            move_uploaded_file($tmp_name,$directory.$name);
        }
    }
 ?>
