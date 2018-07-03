<?php require_once '../administration/default.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            $page = "REGISTRATION";
            require_once $root.'/blocks/head.php';
         ?>
        <script src="registration.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header-container">
                <?php require_once '../blocks/header.php';?>
            </div>
            <div id="content">
                <div id="registration-container">
                    <form id="registration-form" method="post">
                        <h3>Sign Up</h3>
                        <span>Username</span>
                        <input type="text" name="username" id="username">
                        <span>E-mail</span>
                        <input type="text" name="email" id="email">
                        <span>Password</span>
                        <input type="password" name="password" id="password">
                        <span>Repeat password</span>
                        <input type="password" name="repeated-password" id="repeated-password">
                        <button type="submit" id="SignUp">Go!</button>
                        <span id="error"></span>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
