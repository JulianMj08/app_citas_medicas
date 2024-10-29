console.log('Funcionand');



// --------------------------------- VER USUARIOS -----------------------------------------
// const btnOpen = document.querySelector('.open-user');

// btnOpen.addEventListener('click', function() {
//        showUser();     
// });

document.addEventListener("DOMContentLoaded", function () {
    showUser(); // Llama a la función que carga las noticias automáticamente
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
                <div class="row w-100">
                    <div class="col-6">
                        <p><strong>Nombre:</strong> ${user.nombre}</p>
                        <p><strong>Apellidos:</strong> ${user.apellidos}</p>
                        <p><strong>Email:</strong> ${user.email}</p>
                        <p><strong>Fecha de Nacimiento:</strong> ${user.fechaNacimiento}</p>
                        <p><strong>Dirección:</strong> ${user.direccion}</p>
                        <p><strong>Sexo:</strong> ${user.sexo}</p>
                        <p><strong>Usuario:</strong> ${user.usuario}</p>
                        <p><strong>Contraseña:</strong> ${user.usuario}</p>
                    </div>
                    <div class="col-6">
                        <img class="img-calendario rounded shadow object-fit-cover w-75" src="/assets/img/perfil.png" alt="">
                    </div>
                </div>
                `;

            containerData.appendChild(userDiv);

    } catch (error) {
        console.error('Error al obtener el Usuario:', error);
    } 
}

