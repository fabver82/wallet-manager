//add a row into movement table
export const addCell = (table,movement)=>{
    // const tr = document.createElement('tr');
    const tr = table.insertRow(0);
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
        <td class="text-start">${movement.comment}</td>
        <td class="text-start">${formatUSD(movement.amount)}</td>`;
    // table.appendChild(tr);
}
const formatUSD = (amount) => {
    let formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        maximumFractionDigits: 2,
    });
    return formatter.format(amount);
}

export const fillBalanceBlock = ()=>{

    fetch('https://127.0.0.1:8000/api/balance')
        .then(response => response.json())
        .then(summary =>{
            const incomes = document.getElementById('totalIncomes');
            const expenses = document.getElementById('totalExpenses');
            const totalBalance = document.getElementById('totalBalance');
            incomes.textContent =formatUSD(summary['incomes']);
            expenses.textContent =formatUSD(summary['expenses']);
            totalBalance.textContent =formatUSD(summary['balance']);
        })
}
export const fillTable = (table,url)=>{
    fetch(url)
        .then(response => response.json())
        .then(movements => {
            movements.forEach(movement=>{
                addCell(table,movement);
            })
        });
}
const clearInput = (type) => {
    if (type=='income'){
        document.getElementById('inputIncomeText').value='';
        document.getElementById('inputIncome').value='';
    }else{
        document.getElementById('inputExpenseText').value='';
        document.getElementById('inputExpense').value='';
    }
}
// AJAX add movement to DB
export const addMovement = (type,url)=>{
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
    fetch(url, {
        method: 'POST',
        redirect: 'follow',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(movement)
    })
        .then(response => response.json())
        .then(result => {
            if (result.status==201){
                const table = document.getElementById('tableMovements');
                addCell(table,movement);
            }
            clearInput(type);
        })
        .catch(error => console.log('error', error));
}