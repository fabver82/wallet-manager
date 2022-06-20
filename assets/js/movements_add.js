import {addMovement} from "../assets/js/movement_list";
//test
console.log('i m in!');
// get forms from DOM
const formAddIncome = document.getElementById('add-income');
const formAddExpense = document.getElementById('add-expense');
//events listener
formAddIncome.addEventListener('submit',(e)=>{
    e.preventDefault();
    addMovement('income');
})
formAddExpense.addEventListener('submit',(e)=>{
    e.preventDefault();
    addMovement('expense');
})