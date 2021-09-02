const conn = new WebSocket('ws://localhost:8081');
const list = document.getElementById('message-list')
const input = document.getElementById('input');

// Add message to list
function addMessage(message, self = false) {
    let newMessage = document.createElement('li')
    newMessage.appendChild(document.createTextNode(message))

    if (self) {
        newMessage.classList.add('self')
    }

    list.appendChild(newMessage);
}

// WebSocket open connection
conn.onopen = function(e) {
    console.log("Connection established!");
};

// WebSocket message incoming
conn.onmessage = function(e) {
    addMessage(e.data);
};

// Enter event Input
input.addEventListener('keypress', function (e) {
    if(e.key === 'Enter') {
        conn.send(input.value);
        addMessage(input.value, true);
        input.value = ''
    }
})

