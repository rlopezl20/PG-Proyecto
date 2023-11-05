// Espera a que el documento HTML se cargue completamente
document.addEventListener('DOMContentLoaded', function () {

    // Selecciona el formulario por su etiqueta "form"
    const loginForm = document.querySelector('form');

    // Agrega un evento de envío al formulario
    loginForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío del formulario por defecto

        // Obtiene los valores ingresados en los campos de usuario y contraseña
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Crea un objeto FormData para enviar los datos al servidor
        const formData = new FormData();
        formData.append('correo', username);
        formData.append('contrasena', password);

        // Realiza una solicitud AJAX para enviar los datos al archivo PHP
        fetch('../PHP/login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Suponiendo que PHP devuelve JSON
        .then(data => {
            if (data.success) {
                alert('Inicio de sesión exitoso');
                // Redirige al usuario a la página deseada después del inicio de sesión exitoso
                window.location.href = '../Paginas/Menu.php';
            } else {
                alert('Credenciales incorrectas. Por favor, inténtalo de nuevo.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
