//add a row into movement table
export const addCell = (table,movement)=>{
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
    table.appendChild(tr);
}
// AJAX add movement to DB
export const addMovement = (type)=>{
    const movement = {
        comment:'',
        type: type,
        amount: 0,
    }
    if (type=='income'){
        movement.comment = document.getElementById('inputIncomeText').value;
        movement.amount = document.getElementById('inputIncome').value;
    }else{
        movement.comment = document.getElementById('inputExpenseText').value;
        movement.amount = document.getElementById('inputExpense').value;
    }


    // POST datas
    fetch("https://127.0.0.1:8000/add", {
        method: 'POST',
        redirect: 'follow',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(movement)
    })
        .then(response => response.text())
        .then(result => {
            console.log(result);
            const table = document.getElementById('tableMovements');
            addCell(table,movement);
        })
        .catch(error => console.log('error', error));
}