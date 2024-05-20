<?php
require('../../helpers/reports.php');
require('../../models/modelsjugador.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Tabla de jugadores');

// Se instancia el módelo usuarios para obtener los datos.

$jugador = new jugador;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($datajugador = $jugador->reporteJugador()) {
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

            if ($datajugador = $jugador->reporteUsuarios()) {
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($datajugador as $rowjugador) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->cell(40, 10, utf8_decode($rowjugador['nombres_usuario']), 1, 0,'C');
                    $pdf->cell(40, 10, utf8_decode($rowjugador['apellidos_usuario']), 1, 0,'C');
                    $pdf->cell(70, 10, utf8_decode($rowjugador['Edad']), 1, 0,'C');
                    $pdf->cell(70, 10, utf8_decode($rowjugador['Estado']), 1, 0,'C');
                    $pdf->cell(70, 10, utf8_decode($rowjugador['Equipo']), 1, 0,'C');
                    $pdf->cell(70, 10, utf8_decode($rowjugador['Pais']), 1, 0,'C');
                    $pdf->cell(70, 10, utf8_decode($rowjugador['Posicion de juego']), 1, 0,'C');
                    
                }
            } else {
                $pdf->cell(0, 10, utf8_decode('No hay jugadores'), 1, 1);
            }
        } else {
            $pdf->cell(0, 10, utf8_decode('Jugador incorrecto o inexistente'), 1, 1);
        }
// Se envía el documento al navegador y se llama al método footer()
$pdf->output('I', 'jugador.pdf');
?>