<?php
require('../../helpers/reports.php');
require('../../models/ModelsVotos.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Tabla de resultados');

// Se instancia el módelo usuarios para obtener los datos.

$Votos = new Votos;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataVotos = $Votos->reporteResultados()) {
    // Se establece un color de relleno para los encabezados.
    $pdf->setFillColor(206, 161, 174);
    // Se establece la fuente para los encabezados.
    $pdf->setFont('Times', '', 14);
    // Se imprimen las celdas con los encabezados.
    $pdf->cell(40, 10, utf8_decode('Nombres'), 1, 0, 'C', 1);
    $pdf->cell(40, 10, utf8_decode('Apellidos'), 1, 0, 'C', 1);
    $pdf->cell(70, 10, utf8_decode('Edad'), 1, 0, 'C', 1);
    $pdf->cell(70, 10, utf8_decode('Estado'), 1, 0, 'C', 1);
    $pdf->cell(70, 10, utf8_decode('Equipo'), 1, 0, 'C', 1);
    $pdf->cell(70, 10, utf8_decode('Pais'), 1, 0, 'C', 1);
    $pdf->cell(70, 10, utf8_decode('Posicion de juego'), 1, 0, 'C', 1);
    
   
    

    // Se establece un color de relleno para mostrar el nombre de la categoría.
    $pdf->setFillColor(250);
    // Se establece la fuente para los datos de los productos.
    $pdf->setFont('Times', '', 11);

            if ($dataVotos = $Votos->reporteResultados()) {
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataVotos as $rowVotos) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->cell(40, 10, utf8_decode($rowVotos['nombres_usuario']), 1, 0,'C');
                    $pdf->cell(40, 10, utf8_decode($rowVotos['apellidos_usuario']), 1, 0,'C');
                    $pdf->cell(70, 10, utf8_decode($rowVotos['Edad']), 1, 0,'C');
                    $pdf->cell(70, 10, utf8_decode($rowVotos['Estado']), 1, 0,'C');
                    $pdf->cell(70, 10, utf8_decode($rowVotos['Equipo']), 1, 0,'C');
                    $pdf->cell(70, 10, utf8_decode($rowVotos['Pais']), 1, 0,'C');
                    $pdf->cell(70, 10, utf8_decode($rowVotos['Posicion de juego']), 1, 0,'C');
                    
                    
                }
            } else {
                $pdf->cell(0, 10, utf8_decode('No hay Jugadores'), 1, 1);
            }
        } else {
            $pdf->cell(0, 10, utf8_decode('Jugadores incorrecto o inexistente'), 1, 1);
        }
// Se envía el documento al navegador y se llama al método footer()
$pdf->output('I', 'Resultados.pdf');
?>