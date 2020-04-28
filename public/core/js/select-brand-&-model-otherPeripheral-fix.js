function cargarMarcas() {
    var array = ["Entrada", "Salida", "Mixto", "Almacenamiento", "Comunicacion"];
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
        Entrada: ['Teclado Estandar USB', 'Mouse Optico USB', 'Teclado Estandar Inalambrico', 'Mouse Optico Inalambrico', 'Escaner', 'Camara Web', 'Microfono'],
        Salida: ['Video Beam', 'Proyector de Video', 'Diadema & Auricular', 'Impresora Zebra', 'DVR'],
        Mixto: ['Smartphones', 'Unidad de CD & DVD USB'],
        Almacenamiento: ['Disco Duro USB Externo', 'Memoria USB'],
        Comunicacion: ['Tarjeta de red', 'Modem', 'Swicth', 'Router', 'Acces Point', 'Firewall'],
    }

    var marcas = document.getElementById('brandSelectId')
    var modelos = document.getElementById('modelSelectId')
    var marcaSeleccionada = marcas.value

    modelos.innerHTML = `<option value="">Seleccione un Perisferico</option>`

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
