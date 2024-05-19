const API_JUGADORES= SERVER+'../Actions/datosjugadores.php?action=';
ENDPOINT_POSICION = SERVER+'../Actions/datosjugadores.php?action=readAll';
ENDPOINT_CIUDAD = SERVER+'../Actions/datosjugadores.php?action=readAll';
ENDPOINT_TEEM = SERVER+'../Actions/datosjugadores.php?action=readAll';

document.addEventListener('DOMContentLoaded', function(){
    readRows(API_JUGADORES);
    let options={
        dismissible: false,
        onOpenStar:function(){
            document.getElementById('save-form').reset()
        }
    }
});
function fillTable(dataset){
    let content='';
    dataset.map(function(row){
        var estado;
            if(row.estado_jugador=='1'){
                
                estado= "Visible";
            }
            if (row.estado_jugador=="0"){
                estado ="No visible";
            }
         content+=`
            <tr>
            <td>${row.IdPlayer}</td>
            <td><img src="${SERVER}../imagenes/Jugadores/${row.ImgP}" class"materiaboxed" height="100"></td>
            <td>${row.NameP}</td>
            <td>${row.LastP}</td>
            <td>${row.Agep}</td>
            <td>${row.AsistP}</td>
            <td>${row.GoalP}</td>
            <td>${row.MinsPlayed}</td>
            <td>${row.StatusP}</td>
            <td>${row.IdTeam}</td>
            <td>${row.IdCtry}</td>
            <td>${row.IdPos}</td>
            <td>
            <a onclick="openUpdate(${row.IdPlayer}) "data-bs-toggle="modal" data-bs-target="#staticBackdrop"
            id="save-modal" onclick="openCreate()"">
            <i class="fa-solid fa-pen"></i>
            </a>
            <a onclick="openDelete(${row.IdPlayer})">
               <i class="fa-solid fa-trash-can"></i>
            </a>
               </td>
            </tr>
           `;
    })
    document.getElementById('tbody-rows').innerHTML=content;
}

document.getElementById('search-form').addEventListener('submit',function(event){
    event.preventDefault();
    searchRows(API_JUGADORES, 'seach-form');
});

function openCreate(){
    document.getElementById('save-form').reset();

    //TENGO DUDAA CON LO DE CATEGORIA
    fillSelect(ENDPOINT_CATEGORIAS,'categoria',null);
}

//preoarar el formulario al momento de modificar un registro
function openUpdate(idjugador){
    //asignar el titulo para la caja de dialogo
    document.getElementById('modal-title').textContent='Actualizar producto';
    //se establecre el campo como opcional, NO SÉ SI HACE REFERENCIA AL DE IMAGEN 
    document.getElementById('archivo').required= false;
    //se define como un objeto los datos del registro
    const data= new FormData();
    data.append('IdPlayer', idjugador);
    //para obtener los datos del registro solicitado
    fetch(API_JUGADORES + 'readOne',{
        method:'post',
        body:data
    }).then(function(request){
       
        if(request.ok){ 
            request.json().then(function(response){
                if (response.status){
                    document.getElementsById('IdPlayer').value= response.dataset.idjugador;
                    document.getElementsById('NameP').value= response.dataset.nombrejugador;
                    document.getElementsById('LastP').value= response.dataset.apellidojugador;
                    document.getElementsById('AgeP').value= response.dataset.edadjugador;
                    document.getElementsById('AsistP').value= response.dataset.asistencias;
                    document.getElementsById('GoalsP').value= response.dataset.golesmarcados;
                    document.getElementsById('MinsPlayed').value= response.dataset.minutosjugados;
                    document.getElementById('StatusP').value=response.data.estatus;
                    //TENGO DUDA CON RESPECTO A SI ASÍ PONGO ESTOS
                    document.getElementsById('IdTeam').value= response.dataset.equipo;
                    document.getElementsById('IdCtry').value= response.dataset.pais;
                    document.getElementsById('IdPos').value= response.dataset.posicion;
                } else{
                    aweetAlert(2,response.exception,null);
                }
            });
        }else{
            console.log(request.status+''+request.statusText);
        }
    });
}               
        
document.getElementById('save-form').addEventListener('submit', function(event){
    event.preventDefault();
    let action='';
    (document.getElementById('Idplayer').value)? action='update':action='create';
    saveRow(API_JUGADORES, action, 'save-form','save-modal');
});

function openDelete(Idplayer){
 const data =new FormData();
 data.append('IdPlayer',idjugador);
 confirmDelete(API_JUGADORES, data);
}
            
function SaveConfirmationAlert() {
    Swal.fire({
        title: "¿Desea guardar el registro de este jugador?",
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
                title: "¡Datos guardados!",
                text: "El registro se guardo con éxito.",
                icon: "success"
            });
        }
        
    });

    
};
