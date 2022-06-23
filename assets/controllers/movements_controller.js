import { Controller } from '@hotwired/stimulus';
import {fillTable, addMovement, fillBalanceBlock} from "../js/movement_utils";

export default class extends Controller {
    static targets = [ "filltable","getBalance" ]
    filltableTargetConnected() {
        const table =document.getElementById('tableMovements');
        fillTable(table,'https://127.0.0.1:8000/api/movements');
    }
    addMovement(e){
        e.preventDefault();
        addMovement(e.params.type,"https://127.0.0.1:8000/api/movements/add");
        fillBalanceBlock();
    }
    getBalanceTargetConnected(){
        fillBalanceBlock();
    }
}