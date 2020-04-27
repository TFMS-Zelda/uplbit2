function cargarMarcas() {
    var array = ["Lenovo", "Dell"];
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
        Lenovo: ['X1 Yoga 20LE', "ThinkPad x290", "ThinkPad x280", "ThinkPad x270", "ThinkPad x260", "ThinkPad x250", 'ThinkPad x240'],
        Dell: ['Latitude E5540', 'Latitude E5480', 'Latitude E6320', 'Latitude E6330',
            'Latitude E6440', 'Latitude E7240', 'Latitude E7250', 'Latitude E7490', 'Vostro 1510', 'Vostro 3500', 'Vostro 3460', 'Vostro 3550 ', 'Vostro 3560'],
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