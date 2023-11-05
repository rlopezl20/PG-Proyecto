// Obtener referencias a elementos HTML
const menuToggle = document.querySelector('.menu-toggle');
const menuList = document.querySelector('.menu-list');

// Función para alternar la visibilidad del menú
function toggleMenu() {
    // Alternar la clase "active" en la lista de menú
    menuList.classList.toggle('active');

    // Alternar la clase "active" en el botón de menú
    menuToggle.classList.toggle('active');
}

// Agregar evento de clic al botón de menú
menuToggle.addEventListener('click', toggleMenu);

// Agregar evento táctil al botón de menú
menuToggle.addEventListener('touchstart', toggleMenu);

// Cerrar el menú cuando se hace clic en un enlace
const menuLinks = menuList.querySelectorAll('a');
menuLinks.forEach(link => {
    link.addEventListener('click', () => {
        // Ocultar el menú y restablecer el botón de menú
        menuList.classList.remove('active');
        menuToggle.classList.remove('active');
    });
});

