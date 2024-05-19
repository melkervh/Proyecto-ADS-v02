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
   
    const config = {
        
        user: 'your_username',
        password: 'your_password',
        server: 'localhost',
        database: 'your_database'
    };
    const mssql = require("mssql");

mssql.connect(config, function (err) {
    if (err) console.log(err);
    let request = new mssql.Request();
    request.query('SELECT COUNT(IdVote) as "Cantidad", P.NameP  as "Jugador" FROM tbVotes as V inner join tbPlayer as P on (V.IdPla=P.IdPla) group by P.NameP', function (err, records) {
        if (err) console.log(err);
        const data_chart= records; // Display retrieved records
    });
    
});



    const ctx = document.getElementById('myChart2');
    const data = {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: 'Más Votados',
            data: data_chart,
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

