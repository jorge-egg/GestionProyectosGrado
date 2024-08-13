
    let array5 = [];
    let array3 = [];
    var ponderadoSub = document.querySelectorAll('.ponderadoSub').forEach(function(p) {
        array3.push(Number(p.textContent));
    });

    //console.log(array3);
    const pCalif = document.querySelectorAll('.pCalif').forEach(function(input) {

        array5.push(Number(input.textContent));

    });
    //console.log(array5);

    // califSelect es un diccionario que almacenara cada uno de los valores de los select de calificaciones con la idea de con cada cambio del select, este se guarde en el array y recalcule
    var califSelect = [];
    var cantItems = array3.length;
    var cantSubItems = document.querySelectorAll('.cantSubItems');
    const selectsInit = document.querySelectorAll('.form-select');

    cantSubItems.forEach(cantSubItem => {
        // Mueve la declaración de incrementador aquí para evitar que se reinicie en cada iteración del bucle forEach
        let incrementador = 1;

        // Agrega una nueva entrada al array califSelect
        califSelect.push([]);
        //console.log(cantSubItem.textContent);

        // Bucle para agregar "no" al array recién agregado según el contenido de cantSubItem
        for (let i = 0; i < parseInt(cantSubItem.textContent); i++) {

            califSelect[califSelect.length - 1].push("no");
        }

            // Obtiene el valor seleccionado y lo convierte a número


        califSelect[califSelect.length - 1].push(0.0);
        // Incrementa el incrementador aquí para que se incremente una vez por cada iteración del bucle forEach
        incrementador++;
    });

    selectsInit.forEach(select => {
        let classSelect = select.classList[1]; // Asegúrate de que el elemento siempre tenga al menos dos clases
        let idSelect = select.id - 1; // Accede directamente al id del elemento
        const selectedValue = select.value; // Accede al valor seleccionado del select
        //console.log(classSelect + ' ' + idSelect + ' ' + selectedValue);
        califSelect[classSelect][idSelect] = selectedValue;
        document.querySelectorAll('.pCalif-' + classSelect).forEach(function(input) {
            // Verifica si el elemento fue encontrado
            if (input) {
                // Asigna un nuevo valor al elemento
                if(califSelect[classSelect][idSelect + 1] == 0.0){
                    califSelect[classSelect][idSelect + 1] = Number(input.textContent.replace(/(\r\n|\n|\r|\s+)/gm, ""));
                }

            } else {
                console.log('El elemento no fue encontrado.');
            }

        });
    });



    console.log(califSelect);


    document.addEventListener("DOMContentLoaded", function() {


        const selects = document.querySelectorAll('.form-select');

        // Asocia el evento change a cada select
        selects.forEach(select => {
            select.addEventListener('change', handleSelectChange);
        });


        function handleSelectChange(event) {

            // Obtiene el select que lanzó el evento
            const selectElement = event.target;

            // Obtiene el data-id del select
            let selectClass1 = selectElement.classList[1];
            let selectClass2 = event.target.id;

            // Obtiene el valor seleccionado y lo convierte a número
            const selectedValue = selectElement.value;

            console.log(selectClass2);




            califSelect[selectClass1][selectClass2 - 1] = selectedValue;

            var array = recalcularCalif(selectClass1, (selectClass2 - 1), califSelect);

            var calificacionCalc = 0.0;

            array.forEach(element => {
                calificacionCalc += element[element.length - 1];
            });


            var mostrarCalif = document.querySelectorAll('.mostrar-calif').forEach(function(calif){
                calif.textContent = calificacionCalc.toFixed(2);
            });

            var mostrarEstado = document.querySelectorAll('.mostrar-estado').forEach(function(estado){
                if(calificacionCalc >= 3.50){
                    estado.textContent = 'Aprobado';
                }else if(calificacionCalc >= 3 && calificacionCalc < 3.50){
                    estado.textContent = 'Aplazado con modificaciones';
                }else{
                    estado.textContent = 'Rechazado';
                }

            });


        }


        function recalcularCalif(posicion1, posicion2, array) {
            var valorTotal = 0.0;
            let valores = array[posicion1];
            var si = array3[posicion1];
            var parcial = array3[posicion1] / 2;
            var no = 0;

            valores.forEach(element => {
                if (element == 'si') {
                    valorTotal += si;
                } else if (element == 'parcial') {
                    valorTotal += parcial;
                } else if (element == 'no') {
                    valorTotal += no;
                }
            });
            //console.log(posicion1 + ' ' + (array[posicion1].length) - 1);


            array[posicion1][array[posicion1].length - 1] = valorTotal;


            // Selecciona el elemento <p> que tiene ambas clases
            let pCalif = document.querySelectorAll('.pCalif-' + posicion1).forEach(function(input) {

                // Verifica si el elemento fue encontrado
                if (input) {
                    // Asigna un nuevo valor al elemento
                    input.textContent = (array[posicion1][array[posicion1].length - 1]).toFixed(1);
                } else {
                    console.log('El elemento no fue encontrado.');
                }

            });
            //let pCalif = document.querySelectorAll('.pCalif-' + posicion1);


            console.log(array);
            return array;
        }

    });

