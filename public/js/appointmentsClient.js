console.log('ajajjjkkkkk');


// --------------------------------- CREAR CITA -----------------------------------------
document.getElementById('saveAppointment').addEventListener('click', function() {
    const idUser = document.getElementById('id-usuario').value;
    const motivoAppointment = document.getElementById('motivo-cita').value;
    const dateAppointment = document.getElementById('fecha-cita').value;

    if (!idUser || !motivoAppointment || !dateAppointment) {
        alert('Por favor, completa todos los campos.');
        return;
    }
    createAppointment();
});

async function createAppointment() {
    const idUser = document.getElementById('id-usuario').value;
    const motivoAppointment = document.getElementById('motivo-cita').value;
    const dateAppointment = document.getElementById('fecha-cita').value;

    const URL_CREATE_APPOINTMENT = 'http://app_citas_medicas.test:3000/api/appointmentsClient';

    try {
        const response = await fetch(URL_CREATE_APPOINTMENT, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ idUser, motivoAppointment, dateAppointment })
        });

        const datos = await response.json();
        console.log(datos);
        alert('Cita creada correctamente');
        showAppointments(); // Mostrar las citas después de crear una nueva
    } catch (error) {
        console.error('Error al enviar las citas:', error);
        alert('Error al crear la cita');
    }
}

// --------------------------------- VER CITAS -----------------------------------------
const btnOpen = document.querySelector('.open-appointments');
btnOpen.addEventListener('click', function() {   
    showAppointments();
});

async function showAppointments() {
    const appointmentRow = document.getElementById('appointment-row');

    if (!appointmentRow) {
        console.error('El contenedor appointment-row no se encontró en el DOM.');
        return;
    }

    const URL = 'http://app_citas_medicas.test:3000/api/appointmentsClient';

    try {
        const response = await fetch(URL, { headers: { 'Content-Type': 'application/json' }});
        const data = await response.json();
        console.log(data);

        // Limpiar el contenido del contenedor `appointmentRow`
        appointmentRow.innerHTML = '';

        data.forEach(appointment => {
            const containerAppointment = document.createElement('div'); // Crear el contenedor de cada cita
            containerAppointment.classList.add('col-12', 'col-md-6', 'col-lg-3');

            // Crear la tarjeta
            const card = document.createElement('div'); //creamos el div del card
            card.classList.add('card', 'p-4', 'bg-light', 'border', 'h-100', 'shadow'); // Añadir `h-100` para que todas las tarjetas tengan la misma altura

            // Agregar contenido a la tarjeta
            card.innerHTML = `
                <h5 class="card-title">${appointment.fechaCita}</h5>
                <p class="card-text">${appointment.motivoCita}</p>     
                <button class="btn-edit" data-id="${appointment.idCita}" style="border: none; background-color: transparent"><img src="/assets/icons/editar.png" class="logo" alt="Modificar"></button>    
                <button class="btn-delete" data-id="${appointment.idCita}" style="border: none; background-color: transparent"><img src="/assets/icons/borrar.png" class="logo" alt="Eliminar"></button>  
            `;

            containerAppointment.appendChild(card);
            appointmentRow.appendChild(containerAppointment);
        });

    } catch (error) {
        console.error("Error al mostrar los datos:", error);
    }
}

// --------------------------------- DELEGACIÓN DE EVENTOS -----------------------------------------
// Escuchamos eventos en el contenedor de citas en lugar de individualmente en cada botón
document.getElementById('appointment-row').addEventListener('click', function(event) {
    if (event.target.closest('.btn-delete')) {
        const id = event.target.closest('.btn-delete').getAttribute('data-id');
        deleteAppointment(id);
    } else if (event.target.closest('.btn-edit')) {
        const button = event.target.closest('.btn-edit');
        const id = button.getAttribute('data-id');
        const card = button.closest('.card'); // Encuentra la tarjeta que contiene los datos de la cita
        const h5 = card.querySelector('.card-title'); // Selecciona el elemento h5 que muestra la fecha
        const p = card.querySelector('.card-text'); // Selecciona el párrafo que muestra el motivo

        if (button.innerHTML.trim() === '<img src="/assets/icons/guardar.png" class="logo" alt="Modificar">') {
            // Guardar cambios
            const newFechaInput = card.querySelector('.editFecha');
            const newMotivoInput = card.querySelector('.editMotivo');

            if (!newFechaInput || !newMotivoInput) {
                alert('Por favor, completa todos los campos.');
                return;
            }

            const newFecha = newFechaInput.value;
            const newMotivo = newMotivoInput.value;

            if (!newFecha || !newMotivo) {
                alert('Por favor, completa todos los campos.');
                return;
            }

            updateAppointment(id, newFecha, newMotivo);
            button.textContent = ''; // Resetear texto a estado original
        } else {
            // Cambiar a modo edición
            const currentFecha = h5.textContent;
            const currentMotivo = p.textContent;

            h5.innerHTML = `<input type="date" class="form-control editFecha" value="${currentFecha}">`;
            p.innerHTML = `<input type="text" class="form-control editMotivo" value="${currentMotivo}">`;

            
            //button.textContent = 'Guardar';

            button.innerHTML = '<img src="/assets/icons/guardar.png" class="logo" alt="Modificar">'
        }
    }
});

// --------------------------------- ELIMINAR CITA -----------------------------------------
async function deleteAppointment(id) {
    try {
        const URL_DELETE = `http://app_citas_medicas.test:3000/api/appointmentsClient/${id}`;

        const response = await fetch(URL_DELETE, {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/json' }
        });

        if (response.ok) {
            alert('Cita eliminada correctamente');
            showAppointments(); // Recargar la lista de citas
        } else {
            alert('No se pudo eliminar la Cita');
        }
    } catch (error) {
        console.error("No se eliminó correctamente", error);  
    }
}

// --------------------------------- ACTUALIZAR CITA -----------------------------------------
async function updateAppointment(idCita, nuevaFecha, nuevoMotivo) {
    const URL_UPDATE_APPOINTMENT = `http://app_citas_medicas.test:3000/api/appointmentsClient/${idCita}`;

    try {
        const response = await fetch(URL_UPDATE_APPOINTMENT, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ idCita, fechaCita: nuevaFecha, motivoCita: nuevoMotivo })
        });

        const data = await response.json();
        console.log('Respuesta de actualización:', data);
        
        if (data.success) {
            alert('Cita actualizada correctamente');
            showAppointments(); // Recargar la lista de citas
        } else {
            alert('Error al actualizar la cita');
        }

    } catch (error) {
        console.error('Error al actualizar la cita:', error)
    }
}


