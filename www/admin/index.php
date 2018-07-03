<?php require_once '../administration/default.php';
if (!$_COOKIE['user'] and !$_COOKIE['password']) {
    header('Location: http://gradee.com/');
}else {
    $current = $users->get("username",$_COOKIE['user']);
    if($current["admin"] !== "1"){
        header('Location: http://gradee.com/');
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            $page = "ADMIN";
            require_once $root.'/blocks/head.php';
         ?>
        <script src="admin.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header-container">
                <?php require_once '../blocks/header.php';?>
            </div>
            <div id="wrap"></div>
            <div id="textContainer"></div>
            <div id="content" class="vertical">
                <div id="lists-container">
                    <div class="single-list">
                        <div class="title-container">
                            <span class="title-text" id="show-users">USERS</span>
                            <div class="title-buttons">
                                <form id="title-buttons-form"  method="post">
                                    <input type="button" name="adminAction[]" id="delete-users" value="Delete">
                                    <input type="button" name="adminAction[]" id="ban-users" value="Ban">
                                    <input type="button" name="adminAction[]" id="unban-users" value="Unban">
                            </div>
                        </div>
                        <div class="list-items" id="all-users">
                            <table>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>E-mail</th>
                                    <th>Password</th>
                                    <th>Banned</th>
                                    <th>Admin</th>
                                    <th></th>
                                </tr>
                                <tbody id="users-data">
                                    <?php
                                        $type = "users";
                                        require $root.'/admin/uploadTable.php';
                                     ?>
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                    <div class="single-list">
                        <div class="title-container">
                            <span class="title-text" id="show-comments">COMMENTS</span>
                            <div class="title-buttons">
                                <form id="title-buttons-form"  method="post">
                                    <input type="button" name="adminAction[]" id="delete-comments" value="Delete">
                            </div>
                        </div>
                        <div class="list-items" id="all-comments">
                            <table>
                                <tr>
                                    <th>Id</th>
                                    <th>Article Id</th>
                                    <th>Author</th>
                                    <th>Text</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                <tbody id="comments-data">
                                    <?php
                                        $type = "comments";
                                        require $root.'/admin/uploadTable.php';
                                     ?>
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                    <div class="single-list">
                        <div class="title-container">
                            <span class="title-text" id="show-articles">ARTICLES</span>
                            <div class="title-buttons">
                                <form id="title-buttons-form"  method="post">
                                    <input type="button" name="adminAction[]" id="delete-articles" value="Delete">
                            </div>
                        </div>
                        <div class="list-items" id="all-articles-admin">
                            <table>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>TV Series</th>
                                    <th>Author</th>
                                    <th>Date</th>
                                    <th>Likes</th>
                                    <th></th>
                                </tr>
                                <tbody id="articles-data">
                                    <?php
                                        $type = "articles";
                                        require $root.'/admin/uploadTable.php';
                                     ?>
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                    <div class="single-list">
                        <div class="title-container">
                            <span class="title-text" id="show-proposed">PROPOSED</span>
                            <div class="title-buttons">
                                <form id="title-buttons-form"  method="post">
                                    <input type="button" name="adminAction[]" id="delete-proposed" value="Delete">
                                    <input type="button" name="adminAction[]" id="add-proposed" value="Add To Articles">
                            </div>
                        </div>
                        <div class="list-items" id="all-proposed">
                            <table>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>TV Series</th>
                                    <th>Author</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                <tbody id="proposed-data">
                                    <?php
                                        $type = "proposed";
                                        require $root.'/admin/uploadTable.php';
                                     ?>
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
