    const btnOpen = document.querySelector('.open-notices');

    btnOpen.addEventListener('click', function() {
        showNotices();
    });

// -------------------------------------------------------------------------------------------------------------
    async function showNotices() {

        const URL = 'http://app_citas_medicas.test:3000/api/noticesAdmin';
        try {
            const response = await fetch(URL, {headers: {'Content-Type': 'application/json'}});

            const allNotices = await response.json();             

            const noticesList = document.getElementById('list-notices');
            noticesList.innerHTML = ''; // Limpiar la lista antes de agregar nuevas noticias

            allNotices.forEach(notice => {
             const boton = document.createElement('button');
             boton.textContent = notice.titulo;
             boton.onclick = () => seeNoticeId(notice.idNoticia);
             noticesList.appendChild(boton);
            }); 
        
        } catch (error) {
            console.error('Error al obtener las noticias:', error);
        }
    }

// -------------------------------------------------------------------------------------------------------------
    async function seeNoticeId(id) {

        const URL_ID = `http://app_citas_medicas.test:3000/api/noticesAdmin/${id}`;
        try {
            const response = await fetch(URL_ID, {headers: {'Content-Type': 'application/json'}});

            const notice = await response.json();            

            const DetailsNotice = document.createElement('div');

            DetailsNotice.innerHTML = `
            <h3>${notice.titulo}</h3>
            <p>${notice.texto}</p>
            <small>Publicado el: ${notice.fecha}</small>
            <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#noticeUpdateModal" id="editButton">editar</button>
            <button class="btn btn-secondary mt-3">Cerrar</button>
            <button class="btn btn-danger mt-3" id="eliminar">Eliminar</button>
        `;

            const noticesList = document.getElementById('list-notices');
            noticesList.innerHTML = ''; // Limpia la lista de noticias previas
            noticesList.appendChild(DetailsNotice); // Añade el nuevo contenedor con detalles

            // Precargar datos en el modal cuando se presiona el botón "Editar"
            const editButton = DetailsNotice.querySelector('#editButton');
            editButton.addEventListener('click', function () {
            document.getElementById('modalTitle').value = notice.titulo;
            document.getElementById('modalText').value = notice.texto;
            document.getElementById('saveChanges').dataset.noticeId = notice.idNoticia;
        });


            const btnDelete = DetailsNotice.querySelector('#eliminar'); //limitamos en este contenedor la busqueda del id en el DOM
            btnDelete.addEventListener('click', function() {
            deleteNotice(notice.idNoticia); // Llama a la función de eliminar usando el ID de la noticia directamente
    });
        } catch (error) {
            console.error('Error al mostrar los detalles', error);
        }
    }

// -------------------------------------------------------------------------------------------------------------
    
    async function update(id, newTitle, newTexto) {
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

    // -------------------------------------------------------------------------------------------------------------
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
            console.error("no se elimino correctamente", error);  
        }
    }


    document.getElementById('saveChanges').addEventListener('click', function () {
        const id = this.dataset.noticeId; // Obtiene el ID de la noticia almacenado en el dataset del botón
        const newTitle = document.getElementById('modalTitle').value;
        const newText = document.getElementById('modalText').value;
    
        update(id, newTitle, newText);
    });
    
    // -------------------------------------------------------------------------------------------------------------


    async function createNotice(title, image, text, createDate, idUsuario) {
        const URL_CREATE = 'http://app_citas_medicas.test:3000/api/noticesAdmin';
    
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
    
            const response = await fetch(URL_CREATE, {
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

    /*
    sendNotice.addEventListener('click', function() {
        const title = document.getElementById('titleNotice').value;
        const image = document.getElementById('imageNotice');
        const text = document.getElementById('textNotice').value;
        const createDate = document.getElementById('fechaNotice').value;
        const idUsuario = 12;
    
        createNotice(title, image, text, createDate, idUsuario);
    }); */
    
    

    /*async function createNotice(title, image, text, createDate, idUsuario) {
        

        const URL_CREATE = 'http://app_citas_medicas.test:3000/api/noticesAdmin';

        try {
            const response = await fetch(URL_CREATE, {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json' 
                },
                body: JSON.stringify({ title:title, image:image, text:text, createDate:createDate, idUsuario:idUsuario }) // Asegúrate de enviar el nuevo texto aquí
                
            });
            console.log(response);

            // Verificar si la respuesta es exitosa
            if (!response.ok) {
                throw new Error('Error en la CREACION: ' + response.statusText);
            }
    
            // Procesar la respuesta JSON
            const data = await response.json();
            console.log(data);
    
            // Aquí puedes manejar el mensaje de éxito o error como desees
            if (data.success) {
                alert(data.success); // Muestra un mensaje de éxito
            } else {
                alert(data.error); // Muestra un mensaje de error
            }

        } catch (error) {
            console.error('Error al realizar la solicitud:', error);
            alert('Se produjo un error al intentar crear la noticia.');
        }
     } */

    const sendNotice = document.getElementById('saveNotice');

        sendNotice.addEventListener('click', function(){
            const title = document.getElementById('titleNotice').value;
            const image = document.getElementById('imageNotice');
            const text = document.getElementById('textNotice').value;
            const createDate = document.getElementById('fechaNotice').value;
            const idUsuario = 16;

            createNotice(title, image, text, createDate, idUsuario);
        }); 

    
    //createNotice('nuevanotice2344', 'ruta/a/tuu_imagcesjfsn,fn.jpg', 'este seria el nuevo texticooo', '2023-11-10', 10  )

