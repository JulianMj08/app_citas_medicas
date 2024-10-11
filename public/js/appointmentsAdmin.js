alert('bkkkkkkkkkkk');

const btnOpen = document.querySelector('.open-appointments');

        btnOpen.addEventListener('click', function() {   
         showAppointments();
    });

async function showAppointments() {
    const tableBody = document.querySelector('#container-table table tbody.table-group-divider');
    tableBody.innerHTML = ''; // Limpia el contenido previo para evitar duplicados

    const containerTable = document.getElementById('container-table');
    containerTable.style.display = 'block';

    const URL = 'http://app_citas_medicas.test:3000/api/appointmentsAdmin';
    try {
        const response = await fetch(URL, { headers: { 'Content-Type': 'application/json' } });
        const allAppointments = await response.json();
        console.log(allAppointments);

        // Iterar sobre las citas y agregar filas a la tabla
        allAppointments.forEach((appointment, index) => {
            // Crear una fila usando un template literal
            const rowHTML = `
                <tr data-id="${appointment.idCita}">
                    <th scope="row">${index + 1}</th>
                    <td class="nombre">${appointment.nombre}</td>
                    <td class="apellidos">${appointment.apellidos}</td>
                    <td class="telefono">${appointment.telefono}</td>
                    <td class="motivoCita">${appointment.motivoCita}</td>
                    <td class="fechaCita">${appointment.fechaCita}</td>
                    <td class="text-center">
                    <button style="border: none; background-color: transparent"><img src="/assets/icons/editar.png" class="logo btn-edit" alt="Modificar"></button>
                    <button style="border: none; background-color: transparent"><img src="/assets/icons/borrar.png" id="delete-appointment" class="logo" alt="Eliminar"></button>
                    </td>
                </tr>
            `;
            // Añadir la fila al contenido del <tbody>
            tableBody.innerHTML += rowHTML;


            // Añadir eventos para editar y eliminar después de agregar las filas
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', function() {
                    const row = this.closest('tr');
                    editRow(row);
                    console.log("funciona");
                    
             });
        });




            // Añadir el evento al botón de eliminar
            const btnDelete = document.querySelector('#delete-appointment');
            btnDelete.addEventListener('click', function() {
                deleteAppointment(appointment.idCita);
            });
        });

    } catch (error) {
        console.error('Error al obtener las citas:', error);
    }
}

async function deleteAppointment(id) {
    try {
        const URL_DELETE = `http://app_citas_medicas.test:3000/api/appointmentsAdmin/${id}`;

        const response = await fetch(URL_DELETE, {method: 'DELETE', headers:  {'Content-Type': 'application/json' }});

        if (response.ok) {
            alert('Cita eliminada correctamente');
            //showNotices(); // Recargar la lista de citas
            
        } else {
            alert('No se pudo eliminar la Cita');
        }
    } catch (error) {
        console.error("no se eliminó correctamente", error);  
    }
}


//alert('funcionando citassssssssssssss');

// const btnOpenUsers = document.querySelector('.open-appointments');

//         btnOpen.addEventListener('click', function() {
//          showAppointments();
//     });


// -----------------------------------------------------------------------------------------------------------------

async function showUsers() {
    const containerUsers = document.getElementById('containerSelectUsers');
    //containerUsers.innerHTML = ''; // Limpia el contenedor antes de agregar nuevas citas

    const URL_USERS = 'http://app_citas_medicas.test:3000/api/appointmentsAdminUsers';
    try {
        const response = await fetch(URL_USERS, { headers: { 'Content-Type': 'application/json' } });
        const allUsers = await response.json();
        //console.log(allUsers);

        // Crear el select
        const selectElement = document.createElement('select');
        selectElement.id = 'appointmentSelectUser'; //asigno id por si es necesario
        selectElement.name = 'appointmentSelectUser';        // asigno name para envio de formulario

        selectElement.classList.add('form-select', 'w-100');

        // Añadir un <option> por defecto
        const defaultOption = document.createElement('option'); //La opción predeterminada proporciona una instrucción clara al usuario sobre lo que debe hacer
        defaultOption.value = '';
        defaultOption.textContent = 'Selecciona un usuario';
        defaultOption.disabled = true;
        defaultOption.selected = true;
        selectElement.appendChild(defaultOption);

        // Crear un <option> para cada cita
        allUsers.forEach(user => {
            const option = document.createElement('option');
            option.value = user.nombre;
            //option.textContent = `Cita de ${appointment.idUsuario} - ${appointment.nombre}`;
            option.textContent = `${user.nombre}`;
            selectElement.appendChild(option);
        });

        // Añadir el select al contenedor
        containerUsers.appendChild(selectElement);

    } catch (error) {
        console.error('Error al obtener las citas:', error);
    }
} 
showUsers();



// -----------------------------------------------------------------------------------------------------------------

document.getElementById('saveAppointment').addEventListener('click', function() {
    const nameUser = document.getElementById('appointmentSelectUser').value;
    const motivoAppointment = document.getElementById('motivo-cita').value;
    const dateAppointment = document.getElementById('fecha-cita').value;

    if (!nameUser || !motivoAppointment || !dateAppointment) {
        alert('Por favor, completa todos los campos.');
        return;
    }
    createAppointment();
});

async function createAppointment() {
    const nameUser = document.getElementById('appointmentSelectUser').value;
    const motivoAppointment = document.getElementById('motivo-cita').value;
    const dateAppointment = document.getElementById('fecha-cita').value;

    const URL_CREATE_APPOINTMENT = 'http://app_citas_medicas.test:3000/api/appointmentsAdmin';

    try {
        const response = await fetch(URL_CREATE_APPOINTMENT, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({nameUser, motivoAppointment, dateAppointment })
        });

        const datos = await response.json();
        console.log(datos);
        
    } catch (error) {
        console.error('Error al enviar las citas:', error);
    }
    showAppointments();
}


    
function editRow(row) {

    const index = row.querySelector('th').textContent;

    const nombre = row.querySelector('.nombre').textContent;
    const apellidos = row.querySelector('.apellidos').textContent;
    const telefono = row.querySelector('.telefono').textContent;
    const motivoCita = row.querySelector('.motivoCita').textContent;
    const fechaCita = row.querySelector('.fechaCita').textContent;

    row.innerHTML = `
        <th scope="row">${index}</th>
        <td><input type="text" class="form-control" value="${nombre}" id="editNombre"></td>
        <td><input type="text" class="form-control" value="${apellidos}" id="editApellidos"></td>
        <td><input type="text" class="form-control" value="${telefono}" id="editTelefono"></td>
        <td><input type="text" class="form-control" value="${motivoCita}" id="editMotivo"></td>
        <td><input type="date" class="form-control" value="${fechaCita}" id="editFecha"></td>
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
        updateAppointment(idCita);
    });

    row.querySelector('.btn-cancel').addEventListener('click', function() {
        // Vuelve a cargar las citas o restaurar la fila original si se cancela
        showAppointments();
    });
}

async function updateAppointment(idCita) {
    const nombre = document.getElementById('editNombre').value;
    const apellidos = document.getElementById('editApellidos').value;
    const telefono = document.getElementById('editTelefono').value;
    const motivoCita = document.getElementById('editMotivo').value;
    const fechaCita = document.getElementById('editFecha').value;

    const URL_UPDATE_APPOINTMENT = `http://app_citas_medicas.test:3000/api/appointmentsAdmin/${idCita}`;

    try {
        const response = await fetch(URL_UPDATE_APPOINTMENT, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ idCita, nombre, apellidos, telefono, motivoCita, fechaCita })
        });


        const responseText = await response.text();
        console.log('Contenido recibido:', responseText);
        //console.log(response);
        //const responseText = await response.text();
        //console.log(responseText); // Te permitirá ver el HTML o cualquier otro contenido devuelto
        const data = JSON.parse(responseText);
        
        console.log('mostrando data:', data);
        
        if (data.success) {
            alert('Cita actualizada correctamente');
            showAppointments(); // Recargar la lista de citas
        } else {
            alert('Error al actualizar la cita');
        }

    } catch (error) {
        console.error('Error al actualizar la cita:', error);
        alert('Se produjo un error al actualizar la cita');
    }
}

