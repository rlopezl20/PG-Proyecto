// Obtén una referencia al elemento del enlace
const crearCuentaLink = document.getElementById('crear-cuenta');
// Agrega un evento de clic al enlace
crearCuentaLink.addEventListener('click', function() {
    // Redirige al usuario al formulario de registro
    window.location.href = 'Registro.html'; // Reemplazar con la URL de tu formulario de registro
});

// Espera a que el documento HTML se cargue completamente
document.addEventListener('DOMContentLoaded', function () {

    // Selecciona el botón por su ID
    const loginButton = document.getElementById('login-btn');

    // Agrega un evento de clic al botón
    loginButton.addEventListener('click', function() {
        // Obtiene los valores ingresados en los campos de usuario y contraseña
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Envía estos valores al servidor para verificar la autenticación
        // Esto puede realizarse mediante una solicitud AJAX o una redirección POST al archivo PHP que maneja la autenticación.

        // Aquí se simula una verificación de autenticación exitosa
        if (username === 'usuario' && password === 'contrasena') {
            alert('Inicio de sesión exitoso');
            // Redirige al usuario a la página deseada después del inicio de sesión exitoso
            window.location.href = 'Menu.php';
        } else {
            alert('Credenciales incorrectas. Por favor, inténtalo de nuevo.');
        }
    });
});
