        
        const btnOpen = document.querySelector('.open-notices');

        btnOpen.addEventListener('click', function() {
         showNotices();
    });

    /// --------------------------------- VER NOTICIAS -----------------------------------------
    async function showNotices() {
        const noticesRow = document.getElementById('notices-row');
    
        if (!noticesRow) {
            console.error('El contenedor notices-row no se encontró en el DOM.');
            return;
        }
    
        const URL = 'http://app_citas_medicas.test:3000/api/noticesAdmin';
        try {
            const response = await fetch(URL, {headers: {'Content-Type': 'application/json'}});
            const allNotices = await response.json();
            console.log(allNotices);
    
            // Limpiar el contenido del contenedor `noticesRow`
            noticesRow.innerHTML = '';
    
            // Agregar nuevas noticias al contenedor
            allNotices.forEach(notice => {
                const containerNotice = document.createElement('div'); // Crear el contenedor de cada noticia (columna)
                containerNotice.classList.add('col-12', 'col-md-6', 'col-lg-3');
    
                // Crear la tarjeta
                const card = document.createElement('div'); //creamos el div del card
                card.classList.add('card', 'p-4', 'bg-light', 'border', 'h-100', 'shadow'); // Añadir `h-100` para que todas las tarjetas tengan la misma altura
    
                // Crear la URL de la imagen utilizando la nueva ruta
                console.log(notice.imagen);
                
                const filenameWithoutExtension = notice.imagen.split('.').slice(0, -1).join('.');
                const imageURL = `http://app_citas_medicas.test:3000/uploads/${filenameWithoutExtension}`;
                //const imageURL = `http://app_citas_medicas.test:3000/uploads/${notice.imagen}`;

                 console.log('prueba',imageURL);
                 
                // Agregar contenido a la tarjeta
                card.innerHTML = `
                        <h5 class="card-title">${notice.titulo}</h5>
                        <p class="card-text">${notice.texto}</p>
                        <img src="${imageURL}" alt="Imagen de la noticia" class="object-fit-cover">
                        <button class="btn btn-primary mt-2">Ver Más</button>  
                `;

                console.log(card); // Verifica si card es el elemento correcto
                console.log(notice); 
    
                // Añadir el evento click a la tarjeta
                card.onclick = () => seeNoticeId(notice.idNoticia);
    
                // Añadir la tarjeta al contenedor de la noticia
                containerNotice.appendChild(card);
    
                // Añadir el contenedor de la noticia al `row` ya existente
                noticesRow.appendChild(containerNotice);
            });
            // 
        } catch (error) {
            console.error('Error al obtener las noticias:', error);
        }
    }

    // --------------------------------- VER NOTICIA ID -----------------------------------------
    async function seeNoticeId(id) {
        const URL_ID = `http://app_citas_medicas.test:3000/api/noticesAdmin/${id}`;
        try {
            const response = await fetch(URL_ID, {headers: {'Content-Type': 'application/json'}});
            const notice = await response.json();
    
            const noticesRow = document.getElementById('notices-row');
            if (!noticesRow) {
                console.error('El contenedor notices-row no se encontró en el DOM.');
                return;
            }
    
            // Vaciar el contenido de `noticesRow` antes de mostrar los detalles
            noticesRow.innerHTML = '';
    
            // Crear el contenedor para los detalles de la noticia
            const DetailsNotice = document.createElement('div');
            DetailsNotice.classList.add('border');
    
            DetailsNotice.innerHTML = `
                <h3>${notice.titulo}</h3>
                <p>${notice.texto}</p>
                <small>Publicado el: ${notice.fecha}</small>
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#noticeUpdateModal" id="editButton">Editar</button>
                <button class="btn btn-secondary mt-3" id="closeButton">Cerrar</button>
                <button class="btn btn-danger mt-3" id="eliminar">Eliminar</button>
            `;
            noticesRow.appendChild(DetailsNotice);
    
            // Precargar datos en el modal cuando se presiona el botón "Editar"
            const editButton = DetailsNotice.querySelector('#editButton');
            editButton.addEventListener('click', function () {
                document.getElementById('modalTitle').value = notice.titulo;
                document.getElementById('modalText').value = notice.texto;
                document.getElementById('saveChanges').dataset.noticeId = notice.idNoticia;
            });
    
            // Añadir el evento al botón de eliminar
            const btnDelete = DetailsNotice.querySelector('#eliminar');
            btnDelete.addEventListener('click', function() {
                deleteNotice(notice.idNoticia);
            });
    
            // Añadir evento para cerrar los detalles y volver a la lista de noticias
            const closeButton = DetailsNotice.querySelector('#closeButton');
            closeButton.addEventListener('click', function () {
                showNotices(); // Recargar la lista de noticias
            });
    
        } catch (error) {
            console.error('Error al mostrar los detalles', error);
        }
    }

    // ---------------------------------------   ELIMINAR NOTICIAS   ---------------------------------------
    async function deleteNotice(id) {
        try {
            const URL_DELETE = `http://app_citas_medicas.test:3000/api/noticesAdmin/${id}`;

            const response = await fetch(URL_DELETE, {method: 'DELETE', headers:  {'Content-Type': 'application/json' }});
    
            if (response.ok) {
                alert('Noticia eliminada correctamente');
                showNotices(); // Recargar la lista de noticias
                
            } else {
                alert('No se pudo eliminar la noticia');
            }
        } catch (error) {
            console.error("no se eliminó correctamente", error);  
        }
    }

    // ---------------------------------------   CREAR NOTICIAS   ---------------------------------------
    async function createNotice(title, image, text, createDate, idUsuario) {
        const URL_CREATE_NOTICE = 'http://app_citas_medicas.test:3000/api/noticesAdmin';
    
        try {
            // Crear un FormData para manejar el archivo y otros datos
            const formData = new FormData();
            formData.append('title', title);
            formData.append('text', text);
            formData.append('createDate', createDate);
            formData.append('idUsuario', idUsuario);
            
            console.log(image.files[0]);
            // image es un <input type="file">, por lo que debes acceder al archivo seleccionado
            if (image.files.length > 0) {
                formData.append('image', image.files[0]);
            }

            // Iterar sobre formData para ver todo el contenido
        for (let pair of formData.entries()) {
            console.log(`${pair[0]}: ${pair[1]}`);
        }
            const response = await fetch(URL_CREATE_NOTICE, {
                method: 'POST',
                body: formData // No incluyas headers aquí, ya que `fetch` se encargará de añadir los necesarios.
            });
    
            // Verificar si la respuesta es exitosa
            if (!response.ok) {
                throw new Error('Error en la CREACIÓN: ' + response.statusText);
            }
    
            // Procesar la respuesta JSON
            const data = await response.json();
            console.log(data);
    
            // Mostrar mensaje de éxito o error
            if (data.success) {
                alert(data.success);
                console.log(data);
                
            } else {
                alert(data.error);
            }
        } catch (error) {
            console.error('Error al realizar la solicitud:', error);
            alert('Se produjo un error al intentar crear la noticia.');
        }
    }
    const sendNotice = document.getElementById('saveNotice');

        sendNotice.addEventListener('click', function(){
            const title = document.getElementById('titleNotice').value;
            const image = document.getElementById('imageNotice');
            const text = document.getElementById('textNotice').value;
            const createDate = document.getElementById('fechaNotice').value;
            const idUsuario = 16;

            createNotice(title, image, text, createDate, idUsuario);
            
        }); 

    // ---------------------------------------   ACTUALIZAR NOTICIAS   ---------------------------------------
    async function updateNotice(id, newTitle, newTexto) {
        const URL_UPDATE = `http://app_citas_medicas.test:3000/api/noticesAdmin/${id}`;
    
        try {
            const response = await fetch(URL_UPDATE, {
                method: 'PUT',
                headers: { 
                    'Content-Type': 'application/json' 
                },
                body: JSON.stringify({ texto: newTexto, titulo: newTitle }) // Asegúrate de enviar el nuevo texto aquí
            });
            console.log(response);
    
            // Verificar si la respuesta es exitosa
            if (!response.ok) {
                throw new Error('Error en la actualización: ' + response.statusText);
            }
    
            // Procesar la respuesta JSON
            const data = await response.json();
            console.log(data);
            console.log("dataa titulo", data.titulo);

            // Aquí puedes manejar el mensaje de éxito o error como desees
            if (data.success) {
                alert(data.success); // Muestra un mensaje de éxito
            } else {
                alert(data.error); // Muestra un mensaje de error
            }
    
        } catch (error) {
            console.error('Error al realizar la solicitud:', error);
            alert('Se produjo un error al intentar actualizar la noticia.');
        }
    }

    document.getElementById('saveChanges').addEventListener('click', function () {
        const id = this.dataset.noticeId; // Obtiene el ID de la noticia almacenado en el dataset del botón
        const newTitle = document.getElementById('modalTitle').value;
        console.log(newTitle);
        
        const newText = document.getElementById('modalText').value;
    
        updateNotice(id, newTitle, newText);
    });

