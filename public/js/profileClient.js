console.log('Funcionando Profile page page 09');



// --------------------------------- VER USUARIOS -----------------------------------------
const btnOpen = document.querySelector('.open-user');

btnOpen.addEventListener('click', function() {
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
                
            // Creamos un div contenedor para cada usuario
            const userDiv = document.createElement('div');
            
            userDiv.innerHTML = `
                <p><strong>Nombre:</strong> ${user.nombre}</p>
                <p><strong>Apellidos:</strong> ${user.apellidos}</p>
                <p><strong>Email:</strong> ${user.email}</p>
                <p><strong>Fecha de Nacimiento:</strong> ${user.fechaNacimiento}</p>
                <p><strong>Dirección:</strong> ${user.direccion}</p>
                <p><strong>Sexo:</strong> ${user.sexo}</p>
                <p><strong>Usuario:</strong> ${user.usuario}</p>
                <p><strong>Contraseña:</strong> ${user.contrasena}</p>
            `;

            containerData.appendChild(userDiv);

    } catch (error) {
        console.error('Error al obtener el Usuario:', error);
    } 
}

