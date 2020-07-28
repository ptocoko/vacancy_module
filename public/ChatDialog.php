<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Диалог</title>
	<script crossorigin="anonymous"
	        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	        src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<label for="text">Сообщение</label><input id="text" name="some" type="text">
<button id="sender">Отправить</button>
<ul id="chat">

</ul>
<script>
    const conn = new WebSocket('ws://localhost:8090?id=<?php echo $_SESSION['id'] ?>');
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('roomId');
    const button = $('#sender');
    const text = $('#text');
    const chat = $('#chat');
    const msg = {roomId: myParam, type: ''};
    conn.onopen = function (e) {
        console.log(myParam);
        msg.type = 'init';
        conn.send(JSON.stringify(msg));
    };
    button.on('click', (e) => {
        msg.text = text.val();
        const sendMessage = {
            type: 'message',
            text: text.val()
        };
        conn.send(JSON.stringify(sendMessage));
    });
    conn.onmessage = function (e) {
        let getMsg = JSON.parse(e.data);
        switch (getMsg.type) {
            case 'init':
                msg.id = getMsg.id;
                getMsg.data.map(x => {
                    if (x.participantId === msg.id) {
                        chat.append(`<li style="color:green;"><b>${new Date(x.date).toLocaleTimeString()}</b> <i>${x.name}</i> ${x.text}</li>`)
                    } else {
                        chat.append(`<li style="color:red;"><b>${new Date(x.date).toLocaleTimeString()}</b> <i>${x.name}</i> ${x.text}</li>`)
                    }
                });
                break;
            case 'message':
                if (getMsg.message.participantId === msg.id) {
                    chat.append(`<li style="color:green;"><b>${new Date(getMsg.message.date).toLocaleTimeString()}</b> <i>${getMsg.message.name}</i> ${getMsg.message.text}</li>`)
                } else {
                    chat.append(`<li style="color:red;"><b>${new Date(getMsg.message.date).toLocaleTimeString()}</b> <i>${getMsg.message.name}</i> ${getMsg.message.text}</li>`)
                }
                break;
        }

    };
    conn.onclose = event => {

        console.log(event);
    };
</script>
<script src="js/index.js"></script>
</body>
</html>