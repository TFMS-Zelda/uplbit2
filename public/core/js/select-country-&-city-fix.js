function cargarPaises() {
    var array = ["Colombia", "Ecuador"];
    array.sort();
    addOptions("paisSelectClass", array);
}

function addOptions(domElement, array) {
    var selector = document.getElementsByClassName(domElement)[0];
    for (paisSelectClass in array) {
        var opcion = document.createElement("option");
        opcion.text = array[paisSelectClass];
        opcion.value = array[paisSelectClass];
        selector.add(opcion);
    }
}

function cargarCiudades() {
    var listaCiudades = {
        Colombia: ['Antioquia', 'Bogota', 'Boyaca', 'Casanare', 'Caldas', 'Cundinamarca', 'Cundinamarca - Madrid',
            'Norte de Santander', 'Huila', 'Meta', 'Nariño', 'Risaralda', 'Santander', 'Tolima', 'Quindio', 'Valle del Cauca'
        ],
        Ecuador: ['Quayaquil', 'Quito'],
    }

    var paises = document.getElementById('paisSelectId')
    var ciudades = document.getElementById('ciudadSelectId')
    var paisSeleccionado = paises.value

    ciudades.innerHTML = `<option value="">Seleccione una Ciudad</option>`

    if (paisSeleccionado !== '') {
        paisSeleccionado = listaCiudades[paisSeleccionado]
        paisSeleccionado.sort()

        paisSeleccionado.forEach(function (ciudad) {
            let opcion = document.createElement('option')
            opcion.value = ciudad
            opcion.text = ciudad
            ciudades.add(opcion)
        });
    }
}
cargarPaises();