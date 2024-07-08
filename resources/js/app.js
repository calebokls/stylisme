import axios from 'axios';
import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const message = document.getElementById("message");
const submitButton = document.getElementById("submitButton");

submitButton.addEventListener("click", ()=>{
    console.log("nnnns")
    axios.post('/chat',{
        nickname: "calebo",
        message:message
    })
})
