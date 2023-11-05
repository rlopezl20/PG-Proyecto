const socket = new WebSocket('ws://192.168.0.9:8765');

socket.onopen = function() {
    console.log('Conexión WebSocket abierta');
    
    // Hacer una solicitud AJAX al servidor PHP para obtener el ID del usuario
    fetch('../PHP/obtener_id_usuario.php')
      .then(response => {
        if (!response.ok) {
          throw new Error('Respuesta no exitosa del servidor PHP');
        }
        return response.json();
      })
      .then(data => {
        if (data.idUsuario) {
          const tuIdDeUsuario = data.idUsuario;
          const datosAEnviar = { idUsuario: tuIdDeUsuario, mensaje: 'Hola desde la página web' };
          enviarDatosAlServidor(datosAEnviar);
        } else {
          console.error('No se pudo obtener el ID del usuario del servidor PHP.');
        }
      })
      .catch(error => {
        console.error('Error al obtener el ID del usuario del servidor PHP:', error);
      });
};

socket.onmessage = function(event) {
    console.log(`Mensaje recibido del servidor: ${event.data}`);
    // Puedes realizar acciones adicionales con los datos aquí
};

socket.onclose = function(event) {
    if (event.wasClean) {
        console.log(`Conexión cerrada limpiamente, código: ${event.code}, razón: ${event.reason}`);
    } else {
        console.error('Conexión cerrada inesperadamente');
    }
};

socket.onerror = function(error) {
    console.error(`Error de WebSocket: ${error.message}`);
};

// Función para enviar datos al servidor WebSocket
function enviarDatosAlServidor(datos) {
    if (socket.readyState === WebSocket.OPEN) {
        socket.send(JSON.stringify(datos));
    } else {
        console.error('No se pudo enviar datos: La conexión WebSocket no está abierta');
    }
}
