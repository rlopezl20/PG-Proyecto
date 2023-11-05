import asyncio
import websockets
import json
import serial
import pynmea2
import mysql.connector
import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
from datetime import datetime
import RPi.GPIO as GPIO
import time

# Constantes para la configuración de GPIO
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)
BOTON_PIN = 17
GPIO.setup(BOTON_PIN, GPIO.IN, pull_up_down=GPIO.PUD_DOWN)

# Constantes para la configuración de la base de datos
DB_HOST = "localhost"
DB_USER = "root"
DB_PASSWORD = "12345"
DB_DATABASE = "proyecto_siam"

# Constantes para la configuración del servidor SMTP
SMTP_SERVER = "smtp.gmail.com"
SMTP_PORT = 465
EMAIL_ADDRESS = "rlopezl1994@gmail.com"
EMAIL_PASSWORD = "kaiqykrsfidtiagc"  # Debería ser obtenida de una variable de entorno o archivo de configuración

# Funciones de ayuda para la base de datos
def get_db_connection():
    """Establece la conexión con la base de datos y devuelve el objeto de conexión y cursor."""
    connection = mysql.connector.connect(
        host=DB_HOST,
        user=DB_USER,
        password=DB_PASSWORD,
        database=DB_DATABASE
    )
    cursor = connection.cursor()
    return connection, cursor

def insert_location(cursor, connection, user_id, lat, lng, time):
    """Inserta los datos de ubicación en la base de datos."""
    insert_query = """
        INSERT INTO REGISTRO_RECORRIDO (ID_USUARIO, COORDENADA_X, COORDENADA_Y, TIEMPO)
        VALUES (%s, %s, %s, %s)
    """
    values = (user_id, lat, lng, time)
    cursor.execute(insert_query, values)
    connection.commit()

# Funciones de ayuda para SMTP
def send_email(to_email, subject, message):
    """Envía un correo electrónico al destinatario especificado."""
    msg = MIMEMultipart()
    msg["From"] = EMAIL_ADDRESS
    msg["To"] = to_email
    msg["Subject"] = subject
    msg.attach(MIMEText(message, "plain"))

    with smtplib.SMTP_SSL(SMTP_SERVER, SMTP_PORT) as server:
        server.login(EMAIL_ADDRESS, EMAIL_PASSWORD)
        server.sendmail(EMAIL_ADDRESS, to_email, msg.as_string())


# Configuración y manejo de eventos GPIO
def setup_gpio():
    """Configura el GPIO para escuchar el botón."""
    GPIO.setup(BOTON_PIN, GPIO.IN, pull_up_down=GPIO.PUD_DOWN)
    GPIO.add_event_detect(BOTON_PIN, GPIO.RISING, callback=button_pressed)

def button_pressed(channel):
    """Callback invocado cuando se presiona el botón."""
    print("Botón presionado, enviando ubicación...")
    asyncio.run(send_location())

async def get_gps_data():
    """Obtiene los datos GPS desde el puerto serie."""
    with serial.Serial("/dev/ttyAMA0", baudrate=9600, timeout=0.5) as ser:
        for _ in range(10):  # Intenta hasta 10 veces
            newdata = ser.readline().decode('unicode_escape')
            print(f"Datos GPS crudos recibidos: {newdata}")  # Imprime datos crudos para depuración
            
            if newdata[0:6] == "$GPRMC":
                newmsg = pynmea2.parse(newdata)
                return newmsg

async def send_location():
    """Lee los datos GPS y envía la ubicación por correo electrónico."""
    cursor = None
    db_connection = None

    try:
        newmsg = await get_gps_data()
        lat, lng = newmsg.latitude, newmsg.longitude
        tiempo_actual = datetime.now()
        google_maps_link = f"http://maps.google.com/maps?q={lat},{lng}"

        db_connection, cursor = get_db_connection()
        insert_location(cursor, db_connection, id_usuario_global, lat, lng, tiempo_actual)

        # Obtener correos electrónicos de la base de datos y enviar ubicaciones
        cursor.execute("SELECT CORREO FROM CONTACTOGPS WHERE ID_USUARIO = %s", (id_usuario_global,))
        for to_email in cursor:
            subject = "AUXILIO"
            message = f"Necesito ayuda, por favor ven por mi, mi ubicación en tiempo real es: {google_maps_link}"
            send_email(to_email[0], subject, message)

    except Exception as e:
        print(f"Error: {e}")
    finally:
        if cursor:
            cursor.close()
        if db_connection:
            db_connection.close()


# Variable global para almacenar el ID de usuario
id_usuario_global = None

async def websocket_handler(websocket, path):
    """ Manejador para conexiones WebSocket. """
    global id_usuario_global  # Utiliza la variable global para el ID del usuario
    print('Conexión WebSocket establecida')
    try:
        async for message in websocket:
            data = json.loads(message)
            id_usuario = data.get('idUsuario')
            if id_usuario:
                id_usuario_global = id_usuario  # Actualiza la variable global
                print(f'ID del usuario recibido: {id_usuario}')
                # Aquí podrías agregar lógica adicional si es necesario
            else:
                print('No se proporcionó un ID de usuario válido')
    except websockets.exceptions.ConnectionClosed as e:
        print(f'Conexión WebSocket cerrada: {e}')
    finally:
        # Aquí podrías manejar la limpieza necesaria al cerrar la conexión
        pass

# Inicialización y ejecución del servidor WebSocket
async def start_websocket_server():
    """ Inicia el servidor WebSocket. """
    server = await websockets.serve(websocket_handler, '0.0.0.0', 8765)
    await server.wait_closed()

if __name__ == "__main__":
    # Configurar GPIO
    setup_gpio()
    # Iniciar el bucle de eventos para el servidor WebSocket
    asyncio.run(start_websocket_server())
def main():
    # Configuración inicial
    setup_gpio()
    
    # Crear un bucle de eventos para manejar operaciones asíncronas
    loop = asyncio.get_event_loop()

    # Iniciar el servidor WebSocket y atender eventos de GPIO en el bucle de eventos
    loop.run_until_complete(start_websocket_server())
    # Mantener el programa corriendo para atender eventos GPIO y WebSockets
    loop.run_forever()

if __name__ == "__main__":
    try:
        main()
    except KeyboardInterrupt:
        print("Programa terminado por el usuario")
    finally:
        GPIO.cleanup()  # Asegurarse de limpiar los recursos de GPIO
        print("GPIO limpio y programa terminado correctamente.")