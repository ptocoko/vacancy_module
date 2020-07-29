conn.onopen = function (e) {
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
                let tt = new Date(x.date);
                tt = tt.toLocaleTimeString().replace(tt.getHours() + ':', '');
                if (x.participantId === msg.id) {
                    chat.append(` <div class="msg right-msg">
                                    <div class="msg-bubble">
                                        <div class="msg-info">
                                            <div class="msg-info-name">${x.name}</div>
                                            <div class="msg-info-time">${tt}</div>
                                        </div>
                                        <div class="msg-text">
                                           ${x.text}
                                        </div>
                                    </div>
                                </div>`)
                } else {
                    chat.append(`<div class="msg left-msg">
                                <div class="msg-bubble">
                                    <div class="msg-info">
                                        <div class="msg-info-name">${x.name}</div>
                                        <div class="msg-info-time">${tt}</div>
                                    </div>
                                    <div class="msg-text">
                                        ${x.text}
                                    </div>
                                </div>
                            </div>`)
                }
            });
            chat.scrollTop(chat[0].scrollHeight);
            break;
        case 'message':
            let time = new Date(getMsg.message.date);
            time = time.toLocaleTimeString().replace(time.getHours() + ':', '');
            if (getMsg.message.participantId === msg.id) {
                chat.append(` <div class="msg right-msg">
                                    <div class="msg-bubble">
                                        <div class="msg-info">
                                            <div class="msg-info-name">${getMsg.message.name}</div>
                                            <div class="msg-info-time">${time}</div>
                                        </div>
                                        <div class="msg-text">
                                           ${getMsg.message.text}
                                        </div>
                                    </div>
                                </div>`);
            } else {
                chat.append(`<div class="msg left-msg">
                                <div class="msg-bubble">
                                    <div class="msg-info">
                                        <div class="msg-info-name">${getMsg.message.name}</div>
                                        <div class="msg-info-time">${time}</div>
                                    </div>
                                    <div class="msg-text">
                                        ${getMsg.message.text}
                                    </div>
                                </div>
                            </div>`)
            }
            chat.animate({scrollTop: chat.prop("scrollHeight")}, 500);
            break;

    }

};
conn.onclose = event => {

    console.log(event);
};
