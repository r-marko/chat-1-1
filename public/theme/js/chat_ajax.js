document.getElementById('chat-submit').addEventListener('click', enterChatAjax);
//document.querySelectorAll('button.button-send-id').addEventListener('submit', sendUserId);

let refresh = setInterval(function () {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'chat_controller.php', true);

    xhr.onload = function () {
        if (this.status == 200) {
            document.getElementById('chat-ajax').innerHTML = this.responseText;
        }
    }
    xhr.send();
}, 1000);


function enterChatAjax(event){
    event.preventDefault();
        let getValue = document.getElementById('textAreaExample').value;
        let postValue = "";
        if(getValue.length > 0){
            postValue = "chat-post="+getValue;
        }
        document.getElementById('textAreaExample').value = "";
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'chat_controller.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            if(this.status == 200){
                document.getElementById('chat-ajax').innerHTML = this.responseText;
            }
        }
        xhr.send(postValue);
    
}

// send user ID post variable to chat.php  
function sendUserId(e){
    e.preventDefault();

    let postValue = document.user-id.value;
    postValue = "user-id="+postValue;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'chat.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(postValue);
}

