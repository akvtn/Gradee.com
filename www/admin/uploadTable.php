<?php
require_once '../administration/default.php';
if($_GET['type']) $type = htmlspecialchars($_GET['type']);


if($type == "users"){
    foreach ($users->table as $key => $item):?>
        <tr>
            <td><?=$item["id"]?></td>
            <td><label for="chooseUser<?=$key?>"><?=$item["username"]?></label></td>
            <td><?=$item["email"]?></td>
            <td><?=$item["password"]?></td>
            <td><?=($item["banned"]?"Yes":"No")?></td>
            <td><?=($item["admin"]?"Yes":"No")?></td>
            <td><input type="checkbox" id="chooseUser<?=$key?>" name="choosen[]" value="<?=$item["id"]?>"></td>
        </tr>
    <?php endforeach;
}
elseif ($type == "comments") {
    foreach ($comments->table as $key => $item): ?>
        <tr>
            <td><?=$item["id"]?></td>
            <td><?=$item["articleId"]?></td>
            <td><?=$item["author"]?></td>
            <td><label for="chooseComment<?=$key?>"><?=$item["text"]?></label></td>
            <td><?=$item["date"]?></td>
            <td><input type="checkbox" id="chooseComment<?=$key?>" name="choosen[]" value="<?=$item["id"]?>"></td>
        </tr>
    <?php endforeach;
}
elseif ($type == "articles") {
    foreach ($articles->table as $key => $item):?>
        <tr>
            <td><?=$item["id"]?></td>
            <td name="showArticleText[]"><?=$item["title"]?></td>
            <td><?=$item["series"]?></td>
            <td><?=$item["author"]?></td>
            <td><?=$item["date"]?></td>
            <td><?=$item["likes"]?></td>
            <td><input type="checkbox" name="choosen[]" value="<?=$item["id"]?>"></td>
        </tr>
    <?php endforeach;
}
elseif ($type == "proposed") {
    foreach ($proposed->table as $key => $item):?>
       <tr>
           <td><?=$item["id"]?></td>
           <td name="showProposedText[]"<?=$key?>><?=$item["title"]?></td>
           <td><?=$item["series"]?></td>
           <td><?=$item["author"]?></td>
           <td><?=$item["date"]?></td>
           <td><input type="checkbox" name="choosen[]" value="<?=$item["id"]?>"></td>
       </tr>
   <?php endforeach;
}
