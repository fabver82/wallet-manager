import { Controller } from '@hotwired/stimulus';
export default class extends Controller {
    connect() {

        fetch('https://127.0.0.1:8000/add',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify()
        });

    }
}