<?php
if(isset($_POST["logout"])) {
    setcookie('user', '', time() - 3600,'/');
    header('Location: http://gradee.com/');

};


$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root.'/administration/common.php';
$users = new TableHandler($root."/db/users.txt");
$articles = new TableHandler($root."/db/articles.txt");
$comments = new TableHandler($root."/db/comments.txt");
$series = new TableHandler($root."/db/series.txt");
$proposed = new TableHandler($root."/db/proposed.txt");

?>
