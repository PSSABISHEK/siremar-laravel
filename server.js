const express = require("express");
const socket = require("socket.io");

const NEW_CHAT_MESSAGE_EVENT = "chat message"
const TYPING_CHAT_MESSAGE_EVENT = "typing"
const USERS_EVENT = "users"
// App setup
const PORT = 9000;
const app = express();
const server = app.listen(PORT, function () {
    console.log(`Listening on port ${PORT}`);
    console.log(`http://localhost:${PORT}`);
});

// Socket setup
const io = socket(server, {cors: {origin: '*'}});

const activeUsers = new Set();

io.on("connection", function (socket) {
    const {roomId, name} = socket.handshake.query;
    const room = JSON.stringify({roomId: roomId, name: name})
    activeUsers.add(room);
    socket.join(roomId);
    console.log("Made socket connection ", roomId, name);
    console.log(Array.from(activeUsers));
    io.emit(USERS_EVENT, Array.from(activeUsers));

    socket.on(NEW_CHAT_MESSAGE_EVENT, (data) => {
        io.in(roomId).emit(NEW_CHAT_MESSAGE_EVENT, data);
    });

    // Leave the room if the user closes the socket
    socket.on("disconnect", () => {
        const room = JSON.stringify({roomId, name})
        console.log("Disconnecting user: ", room);
        socket.leave(roomId);
        activeUsers.delete(room);
        io.emit(USERS_EVENT, Array.from(activeUsers));
    });

    socket.on(TYPING_CHAT_MESSAGE_EVENT, function (data) {
        console.log("Typing... ", data);
        socket.broadcast.emit("typing", data);
    });
});
