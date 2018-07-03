var errors = {
    "1": ["Invalid username","username"],
    "2": ["Username already used","username"],
    "3": ["Wrong email","email"],
    "4": ["Email already used","email"],
    "5": ["Invalid password","password"],
    "6": ["Password are not equal","repeated-password"]
}

window.addEventListener("load",function() {
    var signUpButton = document.getElementById('SignUp');
    signUpButton.addEventListener("click",function(e) {
        e.preventDefault();
        deleteErrors(["username","password","email","repeated-password"]);
        AJAXHelper.post("registration.php",$("#registration-form").serialize(),onSuccess)

        function onSuccess(data) {
            if(data.target.response){
                raiseError(errors[data.target.response][1],{"error":errors[data.target.response][0]});
            }else {
                document.location.replace("http://gradee.com/");
            }
        }
    });
});
