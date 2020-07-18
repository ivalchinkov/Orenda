/*
function validate_form(){
    var username = document.my_form.username.value;
    var password = document.my_form.password.value;
    var repeat_password = document.my_form.repeat_pass.value;
    //check if fields are empty
    if(username == "" || password == ""){
        alert ("Всички полета трябва да са попълнени.");
        return;
    }
    //check size of password
    if(password.length < 6){
        alert("Паролата трябва да е поне 6 символа.");
        return;
    }
    //username should not start with _,@, or a number
    var str = username.slice(0,1);
    if(username.slice(0,1) == "_" || username.slice(0,1) == "@" || str.match(/[0-9]/g)!null){
        alert ("Username shoul not start with _, @, or a number");
        return;
    }
    if (password !=== repeat_password){
        alert ("Both passwords don't match");
    }
}

function ValidateEmail(mail)
{
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(myForm.emailAddr.value))
    {
        return (true)
    }
    alert("You have entered an invalid email address!")
    return (false)
}
*/

function validateForm(){
    var username = document.getElementById("username");
    var password = document.getElementById("password");
    var repeat_pass = document.getElementById("repeat_pass");
        if(username.value.trim() == ""){
            alert ("Моля въведете потребителско име");
            return false;
        }
    else if(password.value.trim() == ""){
            alert("Моля въведете парола");
            return false;
        }
    else if (password.value.trim().length < 6){
            alert ("Минимална парола 6 символа.");
        }
    if(password.value != repeat_pass.value){
        alert("Въведените пароли не съвпадат");
    }
    else {
        true;
    }
}
