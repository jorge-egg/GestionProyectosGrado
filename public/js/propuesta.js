
document.addEventListener('DOMContentLoaded', function() {
    const buttonCalificar = document.getElementById('calificar');
    const buttonToCreatePropuesta = document.getElementById('buttonToCreatePropuesta');
    const buttonEnviarCalificacion = document.getElementById('buttonEnviarCalificacion');

    // Obtener el estado de la propuesta
    const estadoPropuesta = "{{ $propuestaAnterior->estado }}";
    var rangoFecha = "{{ $rangoFecha[2] }}";

    // Verificar el estado y deshabilitar campos y botón si es necesario
    if (estadoPropuesta === 'Aprobado' || !rangoFecha || estadoPropuesta === 'Rechazado') {
        deshabilitarCamposYBoton();
    } else if (estadoPropuesta === 'pendiente' || estadoPropuesta === 'activo') {
        ocultarBotonCalificar();
    }

    buttonCalificar.addEventListener('click', function() {
        mostrarCamposCalificacion();
    });

    function deshabilitarCamposYBoton() {
        const camposDeshabilitar = document.querySelectorAll('.campo-deshabilitar');
        camposDeshabilitar.forEach(campo => {
            campo.disabled = true;
        });
        buttonToCreatePropuesta.disabled = true;
    }

    function ocultarBotonCalificar() {
        buttonCalificar.style.display = 'none';
    }
    buttonCalificar.addEventListener('click', function() {
        buttonEnviarCalificacion.style.display = 'inline-block';
    });
    //verificar fecha



    const deshabilitarCampos = () => {
        const camposDeshabilitar = document.querySelectorAll('.campo-deshabilitar');
        camposDeshabilitar.forEach(campo => {
            campo.disabled = true;
        });
    }

    const mostrarCamposCalificacion = () => {
        deshabilitarCampos();
        const camposCalificacion = document.querySelectorAll('.campos-calificacion');

        camposCalificacion.forEach(campos => {
            campos.style.display = 'flex';
            // Agregar el atributo required a los campos dentro de la sección
            campos.querySelectorAll('input, textarea').forEach(campo => {
                campo.required = true;
                campo.disabled = false; // Habilitar campos al mostrar
            });
        });

        // Mostrar el botón de enviar calificación
        buttonEnviarCalificacion.style.display = 'inline-block';
        buttonToCreatePropuesta.style.display = 'none';
    }

    const ocultarCamposCalificacion = () => {
        const camposCalificacion = document.querySelectorAll('.campos-calificacion');

        camposCalificacion.forEach(campos => {
            campos.style.display = 'none';
            // Quitar el atributo required de los campos dentro de la sección
            campos.querySelectorAll('input, textarea').forEach(campo => {
                campo.required = false;
                campo.disabled = true; // Deshabilitar campos al ocultar
            });
        });

        // Ocultar el botón de enviar calificación
        buttonEnviarCalificacion.style.display = 'none';
    }
});
