import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    authenticate(e){
        e.preventDefault();
        let username= document.getElementById('inputUsername').value;
        let password= document.getElementById('inputPIN').value;
        console.log(username,password)
        fetch('https://127.0.0.1:8000/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({username: username, password: password})
        })
            .then(response => response.json())
            .then(result => console.log(result))
            .catch(error => {
                if (error.response.data) {
                    this.error = error.response.data.error;
                }else{
                    this.error = "unknow error";
                }
            });
    }
}