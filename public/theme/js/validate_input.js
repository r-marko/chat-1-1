function isAlphabetic(input){
    let letters = /^[a-zA-Z ]+$/;
    if(input.match(letters)){
        return true;
    } else {
        return false;
    }
}

function isPassword(input){
    let letters = /[a-zA-Z0-9]+/;
    if(input.match(letters)){
        return true;
    } else {
        return false;
    }
}

function validate_username(input){
    if((input.length >= 5) && (input.length < 21) && isAlphabetic(input)){
        return true;
    } else {
        return false;
    }
}

function validate_password(input){
    if((input.length >=5) && (input.length < 21) && isPassword(input)){
        return true;
    } else {
        return false;
    }
}

function validate_login(input){
    if((input.length >=5) && (input.length < 21)){
        return true;
    } else {
        return false;
    }
}

function registerValidation(form){
    let error_message = "";

    if(!validate_username(form.registerName.value)){
        error_message += "Incorrect format of user name. ";
    }
    if(!validate_password(form.registerPassword.value)){
        error_message += "Incorrect format of password. ";
    }
    if(!validate_password(form.repeatPassword.value) || form.registerPassword.value !== form.repeatPassword.value){
        error_message += "Incorrect format of repeated password. ";
    }

    if(error_message.length > 0){
       // form.preventDefault();
        alert(error_message);
        return false;
    } else {
        return true;
    }
}

function loginValidation(form){
    let error_message = "";

    if(!validate_login(form.loginName.value)){
        error_message += "Incorrect format of user name. ";
    }
    if(!validate_login(form.loginPassword.value)){
        error_message += "Incorrect format of password. ";
    }

    if(error_message.length > 0){
        //form.preventDefault();
        alert(error_message);
        return false;
    } else {
        return true;
    }

}