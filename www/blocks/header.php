<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/administration/default.php';
 ?>
<div id="header">
    <div id="header-block">
        <a href="http://gradee.com/" id="logo">GRADEE</a>
        <div id="header-items">
            <a href="/articles">Articles</a>
            <a href="/top">Top</a>
            <?php $current = $users->get("username",$_COOKIE["user"])?>
                <?php if(isset($_COOKIE["user"])): ?>
                    <a href="/add">Add</a>
                    <?php if($current["admin"] == "1"): ?>
                        <a href="/admin">Admin</a>
                    <?php endif ?>
                <?php endif ?>
        </div>
    </div>
    <div id="header-items">
        <?php if(isset($_COOKIE["user"])): ?>
            <form id="logIn-form" method="post">
                <button type="submit" name="logout">Log Out</button>
            </form>
            <span href="" id="reg"><?=$_COOKIE["user"]?><span>
        <?php else: ?>
            <form id="logIn-form" method="post">
                <span id="LogError"></span>
                <input type="text" id="login-username" name="login-username" placeholder="Username...">
                <input type="password" id="login-password" name="login-password" placeholder="Password...">
                <button type="submit" id="login">Log In</button>
            </form>
            <a href="/registration" id="reg">Sign Up</a>
        <?php endif ?>
    </div>
</div>
