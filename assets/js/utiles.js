
const generarGrafica = (tipo, array, contenedor, grafica, id) => {

    const labels = generarEtiquetas(array)
    const totales = generarValores(array)

             
    const data = {
       labels: labels,
       datasets: [{
          label: "Total ",
          data: totales,
          backgroundColor: generarColores(labels.length),
          fill: false,
          tension: 0.1,
          borderWidth: 3
       }]
    }

    var ctx = document.getElementById(id).getContext('2d');

    var options = {
       responsive: true,
       maintainAspectRatio: true,
       scales: {
          y: {
             beginAtZero: true
          }
       }
    };
             
    new Chart(ctx, {
       responsive: true,
       type: tipo,
       data: data,
       options: options
    });
 }

const generarColores = (tamanio) => {
    const colores = []
    for(let i = 0; i<tamanio; i++){
       colores.push("#" + Math.floor(Math.random()*16777215).toString(16))
    }

    return colores
 }

const generarEtiquetas = (array) => {
    const labels = array.map(elemento => {
     return elemento[Object.keys(elemento)[0]]
  })
    return labels
 }

const generarValores = (array) => {
    const totales = array.map(elemento => {
     return elemento.total
  })
    return totales
 }