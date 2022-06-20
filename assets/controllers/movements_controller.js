import { Controller } from '@hotwired/stimulus';
import {fillTable,addMovement} from "../js/movement_list";

export default class extends Controller {
    static targets = [ "filltable" ]
    filltableTargetConnected() {
        const table =document.getElementById('tableMovements');
        fillTable(table,'https://127.0.0.1:8000/movements');
    }
    addMovement(e){
        e.preventDefault();
        addMovement(e.params.type,"https://127.0.0.1:8000/add");
    }
}