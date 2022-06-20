import { Controller } from '@hotwired/stimulus';
export default class extends Controller {
    connect() {
        fetch('https://127.0.0.1:8000/movements')
        .then(response => response.json())
        .then(movements => {
            movements.forEach(movement=>{
                const tr = document.createElement('tr');
                tr.classList.add("text-center");
                const badge = (type)=>{
                    if (type == 'income'){
                        return `<span class="badge bg-success rounded-pill">Income</span>`
                    } else {
                        return `<span class="badge bg-danger rounded-pill">Expense</span>`
                    }

                }
                tr.innerHTML = `
                        <td>${badge(movement.type)}</td>
                        <td>${movement.comment}</td>
                        <td>$${movement.amount}</td>`;
                this.element.appendChild(tr);
            })
        });
    }
}