"use strict";
import axios from "axios";
import { response } from "express";

document.addEventListener('DOMContentLoaded', function () {
    const permissionTable = document.getElementById('permission_table');
    const permissonForm = document.getElementById('permission_form');
    const permissionIdInput = document.getElementById('PermissionIdInput');

    function loadTableauPermission() {
        axios.get('/admin/permissions')
            .then((response) => {
                const permissions = response.data;
                const tbody = permissionTable.querySelector('tbody');
                tbody.innerHTML = '';

                permissions.forEach((permission) => {
                    const row = document.createElement('tr');
                    row.innerHTML = "
                        < td > ${ permission.nom }</td >
                            ";
                    tbody.appendChild(row);
                });
            })
            .catch((error) => {
                console.error('Erreur lors de chargement des permission :', error)
            })
    }
})