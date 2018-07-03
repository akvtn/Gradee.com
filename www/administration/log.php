<?php
    require_once 'common.php';
    $users = new TableHandler("../db/users.txt");

    $salt = "#!%";
    $username = $_POST["login-username"];
    $password = $_POST["login-password"];
    $hash = hash("sha256",$username."^_^".$password.$salt);


    $current = $users->get("username",$username);
    if(!$current){
        echo "1";
    }elseif ($current["banned"] == "1") {
        echo "2";
    }elseif ($current["password"] !== $hash) {
        echo "3";
    }else {
        setcookie("user",$username,time() + (86400 * 30), "/");
    }
?>
