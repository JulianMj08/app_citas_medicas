//alert("Funcionando js en home");

const btnLogin = document.getElementById('button-login');

const goLogin = ()=> window.location.href = '/login';

btnLogin.addEventListener('click', goLogin);
