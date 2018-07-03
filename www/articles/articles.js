window.addEventListener("load",function() {
    var likesButton = document.getElementById('likes');
    var dateButton = document.getElementById('date');
    var container = document.getElementById('all-articles');
    likesButton.addEventListener("click",function() {
        if(likesButton.className == "") {
            swapClasses(likesButton,dateButton);
            AJAXHelper.get("sorted-articles.php/?id=1",function(data) {
                container.innerHTML = data.target.response;
            });
        }
    });
    dateButton.addEventListener("click",function() {
        if(dateButton.className == "") {
            swapClasses(likesButton,dateButton);
            AJAXHelper.get("sorted-articles.php/?id=0",function(data) {
                container.innerHTML = data.target.response;
            });
        }
    });
});

function swapClasses(first,second) {
    var temp = first.className;
    first.className = second.className;
    second.className = temp;
}
