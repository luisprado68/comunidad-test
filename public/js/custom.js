console.log('test');
var horaInicio;
var intervalo;
var ventanaAbierta;
var laravelVariable = document.getElementById("url0").href;
var laravelVariableSeg = document.getElementById("url1").href;
var parrafo = document.getElementById('twich_id0');
var twich_id = parrafo.textContent;
var parrafo_Seg = document.getElementById('twich_id1');
var twich_id_seg = parrafo_Seg.textContent;
console.log(twich_id);
console.log(twich_id_seg);
var horaInicioSegunda;
var intervaloSegunda;
var ventanaAbiertaSegunda;

function abrirVentana() {
  // Obtener la hora de inicio al abrir la ventana
  horaInicio = new Date();
  // Iniciar el contador
  intervalo = setInterval(actualizarContador, 1000); // Actualizar cada segundo
  // Abrir la ventana
  ventanaAbierta = window.open(laravelVariable, "_blank");

  setTimeout(function() {
    clearInterval(intervalo);
    console.log('El intervalo se ha detenido después de 50 minutos');
    sendData(2,twich_id);
  }, 3000000);
}

function abrirVentanaSegunda() {
  // Obtener la hora de inicio al abrir la ventana
  horaInicioSegunda = new Date();
  // Iniciar el contador
  intervaloSegunda = setInterval(actualizarContadorSegunda, 1000); // Actualizar cada segundo
  // Abrir la ventana
  ventanaAbiertaSegunda = window.open(laravelVariableSeg, "_blank");

  // Configuración del setTimeout para detener el setInterval después de 2 minutos (120,000 milisegundos)
  setTimeout(function() {
    clearInterval(intervaloSegunda);
    console.log('El intervalo se ha detenido después de 50 minutos');
    sendData(minutosTranscurridosSeg,twich_id_seg);
    // minutos * 60000
  }, 3000000);
}

function actualizarContador() {


  var ahora = new Date();
  var tiempoTranscurrido = ahora - horaInicio; // Tiempo en milisegundos
  
  // Calcular minutos y segundos
  var minutosTranscurridos = Math.floor(tiempoTranscurrido / (1000 * 60)); // Convertir a minutos
  var segundosTranscurridos = Math.floor((tiempoTranscurrido / 1000) % 60); // Resto de la división por 60 para obtener los segundos
  
  // Formatear la salida
  var tiempoFormateado = minutosTranscurridos + ' minutos y ' + segundosTranscurridos + ' segundos';
  
  // Mostrar el tiempo transcurrido en el elemento con el id "contador"
  document.getElementById('contador').innerHTML = 'Tiempo transcurrido: ' + tiempoFormateado;
  
  // Verificar si la ventana está abierta y enfocada
  if (ventanaAbierta && ventanaAbierta.closed) {
    clearInterval(intervalo); // Detener el contador si la ventana se ha cerrado
  } else if (ventanaAbierta && !ventanaAbierta.document.hasFocus()) {
    clearInterval(intervalo); // Detener el contador si la ventana no está enfocada
  }else if(minutosTranscurridos == 2){
    clearInterval(intervalo);
  }
  console.log(minutosTranscurridos);
  sendData(minutosTranscurridos,twich_id);
   
}

function sendData(minutosTranscurridos,twich_id){
  console.log('sendataaaa');
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    var datos = {
        minutos: minutosTranscurridos,
        twich_id:twich_id,
        _token: csrfToken 
    };
    $.ajax({
        type: 'POST',
        url: '/points',
        data: datos,
        success: function(response) {
            console.log(response.mensaje); // Mensaje de éxito recibido del servidor
        },
        error: function(xhr, status, error) {
            console.error(error); // Manejar errores de la solicitud
        }
    });
}
function actualizarContadorSegunda() {

  var ahoraSegunda = new Date();
  var tiempoTranscurridoSegunda = ahoraSegunda - horaInicioSegunda; // Tiempo en milisegundos
  
  // Calcular minutos y segundos
  var minutosTranscurridosSeg = Math.floor(tiempoTranscurridoSegunda / (1000 * 60)); // Convertir a minutos
  var segundosTranscurridosSeg = Math.floor((tiempoTranscurridoSegunda / 1000) % 60); // Resto de la división por 60 para obtener los segundos
  
  // Formatear la salida
  var tiempoFormateadoSeg = minutosTranscurridosSeg + ' minutos y ' + segundosTranscurridosSeg + ' segundos';
  
  // Mostrar el tiempo transcurrido en el elemento con el id "contador"
  document.getElementById('contadorDos').innerHTML = 'Tiempo transcurrido: ' + tiempoFormateadoSeg;
  
  // Verificar si la ventana está abierta y enfocada
  if (ventanaAbiertaSegunda && ventanaAbiertaSegunda.closed) {
    clearInterval(intervaloSegunda); // Detener el contador si la ventana se ha cerrado
  } else if (ventanaAbiertaSegunda && !ventanaAbiertaSegunda.document.hasFocus()) {
    clearInterval(intervaloSegunda); // Detener el contador si la ventana no está enfocada
  }else if(minutosTranscurridosSeg == 2){
    clearInterval(intervaloSegunda);
  }
  console.log(minutosTranscurridosSeg);

  sendData(minutosTranscurridosSeg,twich_id_seg);

}
