$(document).ready(function() {
    $("#show-users").click(function() {
        $("#all-users").slideToggle("slow");
    });

    $("#show-comments").click(function() {
        $("#all-comments").slideToggle("slow");
    });
    $("#show-articles").click(function() {
        $("#all-articles-admin").slideToggle("slow");
    });
    $("#show-proposed").click(function() {
        $("#all-proposed").slideToggle("slow");
    });
});


window.addEventListener("load",function() {
    var textContainer = document.getElementById('textContainer');
    var textContainerWrap = document.getElementById('wrap');

    document.getElementById('wrap').addEventListener("click",function() {
        textContainer.style.display = "none";
        textContainerWrap.style.display = "none";
    });

    getText("showArticleText","articles");
    getText("showProposedText","proposed");

    var adminActionButtons = document.getElementsByName("adminAction[]");
    var reloadId = 6;
    var reloadTable = "articles";
    for (let i = 0; i < adminActionButtons.length; i++) {
        adminActionButtons[i].addEventListener("click",function() {
            var table = this.getAttribute("id").split("-")[1];
            changeTable(i+1,table);
            if(i === reloadId) changeTable(0,reloadTable);
        });
    }

});

function changeTable(action,type) {
    var allCheckboxes = document.getElementsByName('choosen[]');
    var usersIds = [].filter.call(allCheckboxes,(box) => box.checked).map(box => box.value);
    AJAXHelper.post("admin.php?action="+action,{"ids":usersIds},function(data) {
        console.log(data.target.response);
        var container = document.querySelector("#"+type+"-data");
        AJAXHelper.get("uploadTable.php?type="+type,function(data) {
            container.innerHTML = data.target.response;
        });
    });
}

function getText(name,table) {
    var textContainerWrap = document.getElementById('wrap');
    var array = document.getElementsByName(name+"[]");
    for (var i = 0; i < array.length; i++) {
        array[i].addEventListener("click",function() {
            AJAXHelper.get("getText.php?table="+table+"&title="+this.innerHTML,function(data) {
                textContainer.innerHTML = data.target.response;
                textContainer.style.display = "flex";
                textContainerWrap.style.display = "block";
            });

        });
    }
}
