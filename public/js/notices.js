alert('Funciona notices 888888client3333hhheeeeeellll00000000kkkkpppppppppppppppp');

const btnOpen = document.querySelector('.open-notices');

        btnOpen.addEventListener('click', function() {
         showNotices();  
         //console.log('Funcionando la funcion');
         
    });

    async function showNotices(){
        const noticesRow = document.getElementById('notices-row');

        const URL = 'http://app_citas_medicas.test:3000/api/notices';

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
                const modalId = `noticeModal-${notice.idNoticia}`;

                console.log('prueba',imageURL);
                
                // Agregar contenido a la tarjeta
                card.innerHTML = `
                        <h5 class="card-title">${notice.titulo}</h5>
                        <p class="card-text">${notice.texto}</p>
                        <img src="${imageURL}" alt="Imagen de la noticia" class="object-fit-cover">
                        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#${modalId}">Ver Mas</button>

                        <div class="modal fade" id="${modalId}" class="container border" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header d-flex flex-column">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <h2 class="mt-2">${notice.titulo}</h2>
                                    <img src="${imageURL}" width="200" height="200" alt="Imagen de la noticia" class=" mt-2 rounded object-fit-cover">                                                                                         
                                </div>

                                <div class="modal-body">
                                    <textarea class="form-control" readonly id="modalText" rows="10" placeholder="${notice.texto}"></textarea>
                                </div>

                                <div class="modal-footer"> 
                                </div>
                            </div>
                        </div>
                    </div>         
                `;
                console.log(card); // Verifica si card es el elemento correcto
                console.log(notice); 

                // Añadir el evento click a la tarjeta
                //card.onclick = () => seeNoticeId(notice.idNoticia);

                // Añadir la tarjeta al contenedor de la noticia
                containerNotice.appendChild(card);

                // Añadir el contenedor de la noticia al `row` ya existente
                noticesRow.appendChild(containerNotice);
            });        
             
            } catch (error) {
                console.error('Error al obtener las noticias:', error);
            }
}
