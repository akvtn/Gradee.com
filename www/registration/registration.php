<?php
    require_once '../administration/default.php';

    $salt = "#!%";
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeated_password = $_POST["repeated-password"];


    if (!preg_match('/^[A-Za-z][A-Za-z0-9]{2,31}$/', $username)){
        echo "1";
    }elseif ($users->get("username",$username)){
        echo "2";
    }elseif (!preg_match( '/^[-0-9a-z_\.]+@[-0-9a-z^\.]+\.[a-z]{2,4}$/i', $email)){
        echo "3";
    }elseif (!preg_match('/[A-Za-z0-9]{6,31}$/', $password)){
        echo "4";
    }elseif ($users->get("email",$email)){
        echo "5";
    }elseif ($password !== $repeated_password) {
        echo "6";
    }else{
        $hash = hash("sha256",$username."^_^".$password.$salt);
        $users->add(array($username,$email,$hash,0,0,0));
    }

 ?>
