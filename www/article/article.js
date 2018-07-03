window.addEventListener("load",function(){
    var addCommentButton = document.getElementById('sendComment');
    addCommentButton.addEventListener("click",function(e) {
        e.preventDefault();
        AJAXHelper.post("article.php",$("#commentForm").serialize(),onSuccess);
    });

    var likesButton = document.getElementById('likeContainer');
    likesButton.addEventListener("click",function() {
        var pageId = document.getElementById("articleId").value;
        var user = document.getElementById("author").value;
        AJAXHelper.post("article.php?type=liked",$("#commentForm").serialize(),function(e) {
            console.log(e.target.response);
            AJAXHelper.get("update.php?type=likes&user="+user+"&articleId="+pageId,function(data) {
                likesButton.innerHTML = data.target.response;
            });
        });
    });
});

function onSuccess(e) {
    if(e.target.response){
        document.getElementById("input-error").style.display = "inline";
        raiseError("comment-message",{
            "input-error" : "Comment has to be longer than 3 sumbols"
        });
    }else {
        deleteErrors(["comment-message"]);
        document.getElementById("input-error").style.display = "none";
        document.getElementById("comment-message").value = "";
        var pageId = document.getElementById("articleId").value;
        AJAXHelper.get("update.php?type=comments&id="+pageId,function(e) {
            console.log(e.target.response);
            var container = document.getElementById("article-comments");
            container.innerHTML = e.target.response;
        });
    }
};
