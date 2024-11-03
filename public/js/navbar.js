document.addEventListener('DOMContentLoaded', function() {
    console.log('funcionando navbar');

    // Función para agregar event listener solo si el elemento existe
    const addToggleListener = (togglerId, collapseId) => {
        const navbarToggler = document.getElementById(togglerId);
        const navbarCollapse = document.getElementById(collapseId);
        if (navbarToggler && navbarCollapse) {
            navbarToggler.addEventListener('click', function() {
                navbarCollapse.classList.toggle('show');
            });
        }
    };

    // Agregar listeners según el rol
    addToggleListener('navbar-toggler-admin', 'navbarNavAltMarkup-admin');
    addToggleListener('navbar-toggler-user', 'navbarNavAltMarkup-user');
    addToggleListener('navbar-toggler-visitor', 'navbarNavAltMarkup-visitor');

    // Manejar botones de login y registro
    const btnLogin = document.getElementById('button-login');
    const btnRegister = document.getElementById('button-register');

    const goLogin = () => window.location.href = '/login';
    const goRegister = () => window.location.href = '/register';

    if (btnLogin) btnLogin.addEventListener('click', goLogin);
    if (btnRegister) btnRegister.addEventListener('click', goRegister);
});
