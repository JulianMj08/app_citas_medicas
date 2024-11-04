// --------------------------------- VER USUARIOS -----------------------------------------
// const btnOpen = document.querySelector('.open-users');

// btnOpen.addEventListener('click', function() {
//     showAllUsers();
// });

console.log('pagina funcionandooooooooooo99999');


document.addEventListener("DOMContentLoaded", function () {
    showAllUsers(); // Llama a la función que carga las noticias automáticamente
});

async function showAllUsers() {
    const tableBody = document.querySelector('#container-table table tbody.table-group-divider');
    tableBody.innerHTML = ''; // Limpia el contenido previo para evitar duplicados

    const containerTable = document.getElementById('container-table');
    containerTable.style.display = 'block';

    try {
        const URL_ALL_USERS = 'http://app_citas_medicas.test:3000/api/usersAdmin';

        const response = await fetch(URL_ALL_USERS, { headers: { 'Content-Type': 'application/json' } });
        const allUsers = await response.json();

        console.log(response);
        console.log(allUsers);

        allUsers.forEach((user, index) => {
            // Crear una fila usando un template literal
            const rowHTML = `
                <tr data-id="${user.idUser}">
                    <th scope="row">${index + 1}</th>
                    <td class="nombre">${user.nombre}</td>
                    <td class="apellidos">${user.apellidos}</td>
                    <td class="nombre-usuario">${user.usuario}</td>
                    <td class="sexo">${user.sexo}</td>
                    <td class="rol">${user.rol}</td>
                    <td class="text-center">
                        <button style="border: none; background-color: transparent" class="btn-delete" data-id="${user.idUser}">
                            <img src="/assets/icons/borrar.png" class="logo" alt="Eliminar">
                        </button>
                        <button style="border: none; background-color: transparent" class="btn-edit" data-id="${user.idUser}">
                            <img src="/assets/icons/editar.png" class="logo" alt="Modificar">
                        </button>
                    </td>
                </tr>
            `;

            // Añadir la fila al contenido del <tbody>
            tableBody.innerHTML += rowHTML;
        });

        // Asignar eventos a los botones de editar
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', function () {
                const row = this.closest('tr');
                editRow(row);
                console.log("Editar funciona");
            });
        });

        // Asignar eventos a los botones de eliminar
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');
                deleteUser(userId);
            });
        });

    } catch (error) {
        console.error('Error al obtener los Usuarios:', error);
    }
}

// --------------------------------- ELIMINAR USUARIO -----------------------------------------
async function deleteUser(id) {
    try {
        const URL_DELETE_USER = `http://app_citas_medicas.test:3000/api/usersAdmin/${id}`;

        const response = await fetch(URL_DELETE_USER, {method: 'DELETE', headers:  {'Content-Type': 'application/json' }});

        if (response.ok) {
            alert('Usuario eliminado correctamente');
            showAllUsers();
        } else {
            alert('No se pudo eliminar el Usuario');
        }
    } catch (error) {
        console.error("no se eliminó correctamente", error);  
    }
}

// --------------------------------- CREAR USUARIO -----------------------------------------
document.getElementById('saveUser').addEventListener('click', function() {
    createUser();
});

async function createUser() {
    const name = document.getElementById('nombre').value;
    const lastNamesUser = document.getElementById('apellidos').value;
    const nameUser = document.getElementById('nombre-usuario').value;
    const emailUser = document.getElementById('sexo').value;
    const passwordUser = document.getElementById('rol').value;
    const addressUser = document.getElementById('direccion').value;
    const phoneUser = document.getElementById('telefono').value;
    const birthdateUser = document.getElementById('fecha-nacimiento').value;
    const sexUser = document.getElementById('hombre').value;
    const rolUser = document.getElementById('rol').value;

    const URL_CREATE_APPOINTMENT = 'http://app_citas_medicas.test:3000/api/userAdmin';

    try {
        const response = await fetch(URL_CREATE_APPOINTMENT, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ name, lastNamesUser, nameUser, emailUser, passwordUser, addressUser, phoneUser, birthdateUser, sexUser, rolUser})
        });

        const datos = await response.json();
        console.log(datos);
        
    } catch (error) {
        console.error('Error al enviar los datos del Usuario:', error);
    }
    //showAppointments();
}

// --------------------------------- ACTUALIZAR USUARIO -----------------------------------------   
function editRow(row) {

    const index = row.querySelector('th').textContent;

    const name = row.querySelector('.nombre').textContent;
    const lastNamesUser = row.querySelector('.apellidos').textContent;
    const nameUser = row.querySelector('.nombre-usuario').textContent;
    const sexUser = row.querySelector('.sexo').textContent;
    const rolUser = row.querySelector('.rol').textContent;

    row.innerHTML = `
        <th scope="row">${index}</th>
        <td><input type="text" class="form-control" value="${name}" id="edit-name"></td>
        <td><input type="text" class="form-control" value="${lastNamesUser}" id="edit-lastname-user"></td>
        <td><input type="text" class="form-control" value="${nameUser}" id="edit-name-user"></td>
        <td><input type="text" class="form-control" value="${sexUser}" id="edit-sex-user"></td>
        <td><input type="text" class="form-control" value="${rolUser}" id="edit-rol-user"></td>
        <td class="text-center">
            <button class="btn-save" style="border: none; background-color: transparent">
                <img src="/assets/icons/guardar.png" class="logo" alt="Guardar">
            </button>
            <button class="btn-cancel" style="border: none; background-color: transparent">
                <img src="/assets/icons/rechazar.png" class="logo" alt="Cancelar">
            </button>
        </td>
    `;

    // Añadir eventos para guardar y cancelar
    row.querySelector('.btn-save').addEventListener('click', function() {
        const idCita = row.getAttribute('data-id');
        updateUser(idCita);
    });

    row.querySelector('.btn-cancel').addEventListener('click', function() {
        // Vuelve a cargar las citas o restaurar la fila original si se cancela
        showAllUsers();
    });
}

async function updateUser(idUser) {
    const name = document.getElementById('edit-name').value;
    const lastNamesUser = document.getElementById('edit-lastname-user').value;
    const nameUser = document.getElementById('edit-name-user').value;
    const sexUser = document.getElementById('edit-sex-user').value;
    const rolUser = document.getElementById('edit-rol-user').value;

    const URL_UPDATE_USER = `http://app_citas_medicas.test:3000/api/userAdmin/${idUser}`;

    try {
        const response = await fetch(URL_UPDATE_USER, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ idUser, name, lastNamesUser, nameUser, sexUser, rolUser })
        });

        const data = await response.json();
        //console.log('Contenido recibido:', responseText);
        //console.log(response);
        //const responseText = await response.text();
        //console.log(responseText); // Te permitirá ver el HTML o cualquier otro contenido devuelto
        //const data = JSON.parse(responseText);
        
        console.log('mostrando data:', data);
        
        if (data.success) {
            alert('Usuario actualizado correctamente');
            showAllUsers(); // Recargar la lista de usuarios
        } else {
            alert('Error al actualizar Usuario');
        }

    } catch (error) {
        console.error('Error al actualizar la Usuario:', error);
        alert('Se produjo un error al actualizar el Usuario');
    }
}