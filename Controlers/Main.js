

const API_GRAF =  'http://localhost/Proyecto-ADS-V02/Api/Actions/ActionsGraficos.php?action=';

document.addEventListener('DOMContentLoaded', function () {
    graficoTopsjugadores();
    openShowGraf() ;
});
function openShowGraf() {
    fetch(API_GRAF + 'readAll', {
        method: 'get'
    }).then(function (request) {
        if (request.ok) {
            request.json().then(function (response) {
                if (response.status) {
                    let data = response.dataset;
                    let content = '';
                    data.forEach(function (row, index) {
                        const modalId = `Info${row.IdPla}`;
                        content += `
                     <div class="col-md-4 mb-4">
                        <div class="card h-100">
                        <div class="card ">
                        <button class="botnvotar btimg"> <img src="${SERVER}/Imagenes/${row.ImgP}"
                        width="50" height="350px"   class="card-img-top imgjugador" alt="..."></button>
                        <div class="card-body">
                            <h5 class="card-title titulocar">${row.Jugador_Nombre} ${row.Jugador_Apellido}</h5>
                            <p class="card-text"> ${row.Jugador_Nombre} ${row.Jugador_Apellido} es un talentoso futbolista de ${row.AgeP} años. Actualmente,
                            juega para el equipo ${row.TeamName}, donde ha demostrado ser una pieza clave 
                            en el campo. Originario de ${row.CtryName}, ${row.Jugador_Nombre} ha acumulado ${row.AsistP} asistencias y ha marcado
                            ${row.GoalsP} goles a lo largo de la temporada..</p>
                            <div class="cardP2">
                                <button type="button" class="btadd"> <a href="votos.html">Página de
                                        votación</a></button>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
                    `;
                    });

                    document.getElementById('BTargeta').innerHTML = `<div class="row">${content}</div>`;

                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
}
function graficoTopsjugadores() {
    fetch(API_GRAF + 'graficoTopsjugadores', {
      method: 'get'
    }).then(function (request) {
      if (request.ok) {
        request.json().then(function (response) {
          if (response.status) {
            let Jugador = [];
            let Cantidad = [];
            response.dataset.map(function (row) {
              Jugador.push(row.Jugador);
              Cantidad.push(row.Cantidad);
            });
            barGraph('myChart3', Jugador, Cantidad, 'Jugadores Más Votados');
          } else {
            document.getElementById('myChart3').remove();
            console.log(response.exception);
          }
        });
      } else {
        console.log(request.status + ' ' + request.statusText);
      }
    });
  }
  
  function barGraph(canvasId, labels, data, title) {
    var ctx = document.getElementById(canvasId).getContext('2d');
    var myBarChart = new Chart(ctx, {
      type: 'bar', // Set the chart type to 'bar'
      data: {
        labels: labels,
        datasets: [{
          label: 'Cantidad de Votos', // Add a label for the dataset
          data: data,
          backgroundColor: [
            '#FF6384',
            '#36A2EB',
            '#FFCE56',
            '#4BC0C0',
            '#9966FF',
            '#FF9F40',
            '#FFCD56',
            '#36A2EB',
            '#4BC0C0',
            '#FF6384'
          ],
          borderColor: [
            '#FF6384',
            '#36A2EB',
            '#FFCE56',
            '#4BC0C0',
            '#9966FF',
            '#FF9F40',
            '#FFCD56',
            '#36A2EB',
            '#4BC0C0',
            '#FF6384'
          ],
          borderWidth: 1
        }]
      },
      options: {
        width: 600, // Adjust the width as needed
        height: 600, // Adjust the height as needed
        title: {
          display: true,
          text: title
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true // Start the y-axis from 0
            }
          }]
        }
      }
    });
  }
  
  


function DeleteDataAlert() {
    Swal.fire({
        title: "¿Desea eliminar el registro?",
        text: "No podrás revertir esta acción",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí, eliminalo!"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "¡Eliminado!",
                text: "Registro eliminado con exito.",
                icon: "success"
            });
        }
    });
};

function EditDataAlert() {
    Swal.fire({
        title: "¿Desea actualizar el registro?",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Actualizar"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "¡Actualizado!",
                text: "Registro actualizado con exito.",
                icon: "success"
            });
        }
    });
};

function VoteConfirmationAlert() {
    Swal.fire({
        title: "¿Desea votar por este jugador?",
        text: "No podrás revertir esta acción.",
        icon: "question",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí!"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "¡Votación completada!",
                text: "Su voto se registro con exito.",
                icon: "success"
            });
        }
    });
};

function ShowValue (RId,Rval){
    const range = RId;
    const rangeValue = Rval;
  
    // Actualiza el valor mostrado cuando cambia el input tipo range
    range.addEventListener('input', () => {
      rangeValue.textContent = range.value;
    });
};


function RadarGraf() {
    const ctx = document.getElementById('myChart');
    const data = {
        labels: [
            'Asistencias',
            'Goles',
            'Minutos jugados',
        ],
        datasets: [{
            label: 'Estadisticas',
            data: [65, 59, 90,],
            fill: true,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgb(255, 99, 132)',
            pointBackgroundColor: 'rgb(255, 99, 132)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(255, 99, 132)'
        }]
    };
    new Chart(ctx, {

        type: 'radar',
        data: data,
        options: {
            elements: {
                line: {
                    borderWidth: 3
                }
            }
        },

    });
}

function BarGraf() {
    const ctx = document.getElementById('myChart2');
    const data = {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: 'Más Votados',
            data: [65, 59, 80, 81, 56, 55, 40],
            backgroundColor: [
                'rgba(255, 99, 132)',
                'rgba(255, 159, 64)',
                'rgba(255, 205, 86)',
                'rgba(75, 192, 192)',
                'rgba(54, 162, 235)',
                'rgba(153, 102, 255)',
                'rgba(201, 203, 207)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };
    new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    });
}