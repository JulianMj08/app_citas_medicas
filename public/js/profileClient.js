console.log('Funcionando profile client3333333333333377777777777777');

// Cargar los datos del usuario al cargar la página
document.addEventListener("DOMContentLoaded", function () {
    showUser();
});

async function showUser() {
    const containerData = document.getElementById('container-data');
    containerData.innerHTML = ''; // Limpiamos el contenedor antes de añadir nuevos datos

    try {
        const URL_USERS = 'http://app_citas_medicas.test:3000/api/profileUserClient';

        const response = await fetch(URL_USERS, { headers: { 'Content-Type': 'application/json' } });
        const user = await response.json();

        console.log(response);

        // Creamos el contenedor para el usuario
        const userDiv = document.createElement('div');
        userDiv.classList.add('w-100', 'row'); // Clases para diseño

        // Contenido de la tarjeta del usuario
        userDiv.innerHTML = `
            <div class="col-6">
                <p class="name"><strong>Nombre:</strong> ${user.nombre}</p>
                <p class="apellidos"><strong>Apellidos:</strong> ${user.apellidos}</p>
                <p class="email"><strong>Email:</strong> ${user.email}</p>
                <p class="fecha-nacimiento"><strong>Fecha de Nacimiento:</strong> ${user.fechaNacimiento}</p>
                <p class="direccion"><strong>Dirección:</strong> ${user.direccion}</p>
                <p class="sexo"><strong>Sexo:</strong> ${user.sexo}</p>
                <p class="usuario"><strong>Usuario:</strong> ${user.usuario}</p>
                
                <button class="btn btn-primary btn-edit mt-2">Editar</button>
            </div>
            <div class="col-6">
                <img class="img-calendario rounded shadow object-fit-cover w-75" src="/assets/img/perfil.png" alt="Imagen de perfil">
            </div>
        `;

        containerData.appendChild(userDiv);

        // Añadir evento para el botón de editar
        userDiv.querySelector('.btn-edit').addEventListener('click', function () {
            editRow(userDiv, user.idUser, user);
        });

    } catch (error) {
        console.error('Error al obtener el Usuario:', error);
    }
}

function editRow(row, userId) {
    // Capturar los datos actuales
    const nombre = row.querySelector('.name').textContent.replace("Nombre: ", "").trim();
    const apellidos = row.querySelector('.apellidos').textContent.replace("Apellidos: ", "").trim();
    const email = row.querySelector('.email').textContent.replace("Email: ", "").trim();
    const fechaNacimiento = row.querySelector('.fecha-nacimiento').textContent.replace("Fecha de Nacimiento: ", "").trim();
    const direccion = row.querySelector('.direccion').textContent.replace("Dirección: ", "").trim();
    const sexo = row.querySelector('.sexo').textContent.replace("Sexo: ", "").trim();
    const usuario = row.querySelector('.usuario').textContent.replace("Usuario: ", "").trim();

   // <p><strong>Fecha de nacimiento: </strong><input type="date" class="form-control" value="${fechaNacimiento}" id="edit-fechaNacimiento"></p>

    // Reemplazar el contenido de la tarjeta con campos editables
    row.innerHTML = `
        <div class="col-6">
            <p><strong>Nombre:</strong> ${nombre}</p>
            <p><strong>Apellidos:</strong> ${apellidos}</p>
            <p><strong>Email:</strong><input type="text" class="form-control" value="${email}" id="edit-email"></p>
            <p><strong>Fecha de nacimiento:</strong><input type="date" class="form-control" value="${fechaNacimiento}" id="edit-fechaNacimiento" max="<?= date('Y-m-d');?></p>
            
            <p><strong>Direccion:</strong><input type="text" class="form-control" value="${direccion}" id="edit-direccion"></p>
            <p><strong>Sexo:</strong><input type="text" class="form-control" value="${sexo}" id="edit-sexo"></p>
            <p><strong>Usuario:</strong><input type="text" class="form-control" value="${usuario}" id="edit-usuario"></p>
            <p><strong>Nueva Contraseña:</strong><input type="password" class="form-control" placeholder="Escribe una nueva contraseña si deseas cambiarla" id="edit-nueva-contrasena"></p>
            
            <button class="btn btn-success btn-save mt-2">Guardar</button>
            <button class="btn btn-secondary btn-cancel mt-2">Cancelar</button>
        </div>
        <div class="col-6">
            <img class="img-calendario rounded shadow object-fit-cover w-75" src="/assets/img/perfil.png" alt="Imagen de perfil">
        </div>
    `;

    // Asignar eventos a los botones Guardar y Cancelar
    row.querySelector('.btn-save').addEventListener('click', function () {
        updateUser(userId);
    });

    row.querySelector('.btn-cancel').addEventListener('click', function () {
        showUser(); // Volver a mostrar la vista de usuario sin cambios
    });
}

async function updateUser(idUser) {
    // Obtener los valores de los inputs editables
    const email = document.getElementById('edit-email').value;
    const fechaNacimiento = document.getElementById('edit-fechaNacimiento').value;
    const direccion = document.getElementById('edit-direccion').value;
    const sexo = document.getElementById('edit-sexo').value;
    const usuario = document.getElementById('edit-usuario').value;
    const contrasena = document.getElementById('edit-nueva-contrasena').value;

    const URL_UPDATE_USER = `http://app_citas_medicas.test:3000/api/profileUserClient/${idUser}`;

    try {
        const response = await fetch(URL_UPDATE_USER, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ idUser, email, fechaNacimiento, direccion, sexo, usuario, contrasena })
        });

        const data = await response.json();
        
        if (data.success) {
            console.log('Usuario actualizado correctamente');
            showUser(); // Recargar la información del usuario
        } else {
            console.log('Error al actualizar Usuario');
        }

    } catch (error) {
        console.error('Error al actualizar el Usuario:', error);
        alert('Se produjo un error al actualizar el Usuario');
    }
}
