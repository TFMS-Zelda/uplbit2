function cargarMarcas() {
    var array = ["Kyocera", "Epson",];
    array.sort();
    addOptions("BrandSelectClass", array);
}

function addOptions(domElement, array) {
    var selector = document.getElementsByClassName(domElement)[0];
    for (BrandSelectClass in array) {
        var opcion = document.createElement("option");
        opcion.text = array[BrandSelectClass];
        opcion.value = array[BrandSelectClass];
        selector.add(opcion);
    }
}

function cargarModelos() {
    var listaModelos = {
        Kyocera: ['Kyocera ecosys m3550idn', 'kyocera ecosys m3655idn'],
        Epson: ['EcoTank L355', 'EcoTank L375'],
    }

    var marcas = document.getElementById('brandSelectId')
    var modelos = document.getElementById('modelSelectId')
    var marcaSeleccionada = marcas.value

    modelos.innerHTML = `<option value="">Seleccione un Módelo</option>`

    if (marcaSeleccionada !== '') {
        marcaSeleccionada = listaModelos[marcaSeleccionada]
        marcaSeleccionada.sort()

        marcaSeleccionada.forEach(function (modelo) {
            let opcion = document.createElement('option')
            opcion.value = modelo
            opcion.text = modelo
            modelos.add(opcion)
        });
    }
}

cargarMarcas();