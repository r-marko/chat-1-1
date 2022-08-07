window.onload = loadLogin();
//window.addEventListener('load', loadLogin); moze i ovo
document.getElementById('login-button').addEventListener('click', loadLogin);
document.getElementById('register-button').addEventListener('click', loadRegistration);


    function loadLogin(){
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'view/v-login.php', true);

        xhr.onload = function(){
            if(this.status == 200){
            document.getElementById('login-form').innerHTML = this.responseText;
            }
        }

        xhr.send();
        }

    function loadRegistration(){
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'view/v-register.php', true);
    
        xhr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
            document.getElementById('login-form').innerHTML = this.responseText;
            }
        }
    
        xhr.send();
        }
