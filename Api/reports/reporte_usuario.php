<?php
require('../../helpers/reports.php');
require('../../models/ModelsUser.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Tabla de usuarios');

// Se instancia el módelo usuarios para obtener los datos.

$usuarios = new Usuarios;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($datausuarios = $usuarios->reporteUsuarios()) {
    // Se establece un color de relleno para los encabezados.
    $pdf->setFillColor(206, 161, 174);
    // Se establece la fuente para los encabezados.
    $pdf->setFont('Times', '', 14);
    // Se imprimen las celdas con los encabezados.
    $pdf->cell(40, 10, utf8_decode('Nombres'), 1, 0, 'C', 1);
    $pdf->cell(40, 10, utf8_decode('Apellidos'), 1, 0, 'C', 1);
    $pdf->cell(70, 10, utf8_decode('dui_usuario'), 1, 0, 'C', 1);
    

    // Se establece un color de relleno para mostrar el nombre de la categoría.
    $pdf->setFillColor(250);
    // Se establece la fuente para los datos de los productos.
    $pdf->setFont('Times', '', 11);

            if ($datausuarios = $usuarios->reporteUsuarios()) {
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($datausuarios as $rowUsuarios) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->cell(40, 10, utf8_decode($rowUsuarios['nombres_usuario']), 1, 0,'C');
                    $pdf->cell(40, 10, utf8_decode($rowUsuarios['apellidos_usuario']), 1, 0,'C');
                    $pdf->cell(70, 10, utf8_decode($rowUsuarios['dui_usuario']), 1, 0,'C');
                    
                }
            } else {
                $pdf->cell(0, 10, utf8_decode('No hay usuarios'), 1, 1);
            }
        } else {
            $pdf->cell(0, 10, utf8_decode('Usuario incorrecto o inexistente'), 1, 1);
        }
// Se envía el documento al navegador y se llama al método footer()
$pdf->output('I', 'usuarios.pdf');
?>