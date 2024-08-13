let ponderados = [];
let array5 = [];
const pCalif = document.querySelectorAll('.pCalif').forEach(function(input) { //capturar las calificaciones de los
    array5.push(input.textContent === '--'? 0: Number(input.textContent));
});
//console.log(array5);

document.querySelectorAll('.ponderado').forEach(function(inputPon) { //capturar las ponderados
    ponderados.push(Number(inputPon.value));
});
//console.log(ponderados);


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
        let selectClass2 = event.target.id;

        // Obtiene el valor seleccionado y lo convierte a número
        const selectedValue = selectElement.value;


        //console.log(selectedValue);




        array5[selectClass2] = selectedValue;

        //console.log(array5);

        var array = recalcularCalif(selectClass2, array5);

        var calificacionCalc = 0.0;

        array.forEach(element => {
            calificacionCalc += element;
        });
        //console.log('totl: '+calificacionCalc);

        var mostrarCalif = document.querySelectorAll('.mostrar-calif').forEach(function(calif){
            calif.textContent = calificacionCalc.toFixed(2);
        });

        var mostrarEstado = document.querySelectorAll('.mostrar-estado').forEach(function(estado){
            if(calificacionCalc >= 3.500){
                estado.textContent = 'Aprobado';
            }else if(calificacionCalc >= 3 && calificacionCalc < 3.500){
                estado.textContent = 'Aplazado con modificaciones';
            }else{
                estado.textContent = 'Rechazado';
            }

        });


    }


    function recalcularCalif(posicion1, array) {
        var valorTotal = 0.0;
        let valores = array[posicion1];
        var si = ponderados[posicion1];
        var parcial = ponderados[posicion1] / 2;
        var no = 0;

            if (valores == 'si') {
                valorTotal += si;
            } else if (valores == 'parcial') {
                valorTotal += parcial;
            } else if (valores == 'no') {
                valorTotal += no;
            }
        //console.log(posicion1 + ' ' + (array[posicion1].length) - 1);


        array[posicion1] = valorTotal;

        //console.log(valorTotal);
        // Selecciona el elemento <p> que tiene ambas clases
        let pCalif = document.querySelectorAll('.pCalif-' + posicion1).forEach(function(input) {

            // Verifica si el elemento fue encontrado
            if (input) {
                // Asigna un nuevo valor al elemento
                input.textContent = (array[posicion1]).toFixed(2);
            } else {
                console.log('El elemento no fue encontrado.');
            }

        });
        //let pCalif = document.querySelectorAll('.pCalif-' + posicion1);


        //console.log(array);
        return array;
    }

});
