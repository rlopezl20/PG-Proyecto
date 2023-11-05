  function cargarMunicipios() {
    var departamentoSelect = document.getElementById("departamento");
    var municipioSelect = document.getElementById("municipio");
    var municipioContainer = document.getElementById("municipio-container");

    // Obtén el valor seleccionado del departamento
    var departamentoSeleccionado = departamentoSelect.value;

    // Limpia el select de municipios
    municipioSelect.innerHTML = '';

    // Ejemplo de solicitud AJAX (puedes usar jQuery o Fetch API):
    // Reemplaza esta sección con la solicitud real a tu servidor
    if (departamentoSeleccionado === 'GUATEMALA') {
        var municipios = [
            "GUATEMALA",
            "MIXCO",
            "VILLA NUEVA",
            "CHINAUTLA",
            "PALENCIA",
            "SAN CRISTOBAL",
            "SAN PEDRO AYAMPUC",
            "SAN PEDRO SACATEPEQUEZ",
            "SAN JUAN SACATEPEQUEZ",
            "SAN RAYMUNDO",
            "CHUARRANCHO",
            "FRAIJANES",
            "AMATITLÁN"
        ];
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }
    if (departamentoSeleccionado === 'EL PROGRESO') {
        var municipios = [
            "SAN CRISTOBAL",
            "GUASTATOYA",
            "EL JÍCARO",
            "SANSARE",
            "SANARATE"
        ];
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }
    if (departamentoSeleccionado === 'HUEHUETENANGO') {
        var municipios = [
            "BARILLAS",
            "HUEHUETENANGO",
            "CHIANTLA",
            "CUILCO",
            "NENTÓN"
        ];
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }
    // Bloque para "BAJA VERAPAZ"
    if (departamentoSeleccionado === 'BAJA VERAPAZ') {
        var municipios = [
            "SALAMÁ",
            "RABINAL",
            "CUBULCO"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }

// Bloque para "ALTA VERAPAZ"
    if (departamentoSeleccionado === 'ALTA VERAPAZ') {
        var municipios = [
            "COBÁN",
            "TACTÍC",
            "TAMAHÚ"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }
// Bloque para "IZABAL"
    if (departamentoSeleccionado === 'IZABAL') {
        var municipios = [
            "PUERTO BARRIOS",
            "EL ESTOR",
            "MORALES"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }

    // Bloque para "CHIQUIMULA"
    if (departamentoSeleccionado === 'CHIQUIMULA') {
        var municipios = [
            "CHIQUIMULA",
            "CAMOTÁN",
            "ESQUIPULAS"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }
    // Bloque para "ZACAPA"
    if (departamentoSeleccionado === 'ZACAPA') {
        var municipios = [
            "ZACAPA",
            "RÍO HONDO",
            "GUALÁN"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }
    // Bloque para "SANTA ROSA"
    if (departamentoSeleccionado === 'SANTA ROSA') {
        var municipios = [
            "CUILAPA",
            "CHIQUIMULILLA"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }
    // Bloque para "JALAPA"
    if (departamentoSeleccionado === 'JALAPA') {
        var municipios = [
            "JALAPA",
            "MONJAS"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }

    // Bloque para "JUTIAPA"
    if (departamentoSeleccionado === 'JUTIAPA') {
        var municipios = [
            "JUTIAPA",
            "AGUA BLANCA",
            "ASUNCIÓN MITA"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }
    // Bloque para "SACATEPÉQUEZ"
    if (departamentoSeleccionado === 'SACATEPÉQUEZ') {
        var municipios = [
            "ANTIGUA GUATEMALA",
            "JOCOTENANGO",
            "SUMPANGO"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }
    // Bloque para "CHIMALTENANGO"
    if (departamentoSeleccionado === 'CHIMALTENANGO') {
        var municipios = [
            "CHIMALTENANGO",
            "PATZÚN",
            "EL TEJAR"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }

    // Bloque para "ESCUINTLA"
    if (departamentoSeleccionado === 'ESCUINTLA') {
        var municipios = [
            "ESCUINTLA",
            "LA DEMOCRACIA",
            "SIQUINALÁ"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }
    // Bloque para "SOLOLÁ"
    if (departamentoSeleccionado === 'SOLOLÁ') {
        var municipios = [
            "SOLOLÁ",
            "NAHUALÁ",
            "PANAJACHEL"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }
    // Bloque para "TOTONICAPÁN"
    if (departamentoSeleccionado === 'TOTONICAPÁN') {
        var municipios = [
            "TOTONICAPÁN",
            "MOMOSTENANGO"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }

    // Bloque para "QUETZALTENANGO"
    if (departamentoSeleccionado === 'QUETZALTENANGO') {
        var municipios = [
            "QUETZALTENANGO",
            "SALCAJÁ",
            "OLINTEPEQUE"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }
    // Bloque para "SUCHITEPÉQUEZ"
    if (departamentoSeleccionado === 'SUCHITEPÉQUEZ') {
        var municipios = [
            "MAZATENANGO",
            "CHICACAO",
            "PATULUL"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }

    // Bloque para "RETALHULEU"
    if (departamentoSeleccionado === 'RETALHULEU') {
        var municipios = [
            "RETALHUELU",
            "CHAMPERICO",
            "EL ASINTAL"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }
    // Bloque para "SAN MARCOS"
    if (departamentoSeleccionado === 'SAN MARCOS') {
        var municipios = [
            "SAN MARCOS",
            "TACANÁ",
            "TAJUMULCO"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }
    // Bloque para "QUICHÉ"
    if (departamentoSeleccionado === 'QUICHÉ') {
        var municipios = [
            "SANTA CRUZ DEL QUICHÉ",
            "CHICHÉ",
            "CHAJUL"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }

    // Bloque para "PETÉN"
    if (departamentoSeleccionado === 'PETÉN') {
        var municipios = [
            "FLORES",
            "SAN JOSÉ",
            "SAN BENITO"
        ];
        
        // Llena el select de municipios con las opciones correspondientes
        municipios.forEach(function (municipio) {
            var option = document.createElement("option");
            option.value = municipio;
            option.text = municipio;
            municipioSelect.appendChild(option);
        });
    }

    // Muestra el contenedor de municipios
    municipioContainer.style.display = 'block';
}
