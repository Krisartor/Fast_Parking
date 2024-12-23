<?php


// Include the main TCPDF library (search for installation path).
require_once('../app/templeates/TCPDF-main/tcpdf.php');
include('../app/config.php'); 

//cargar el encabezado
$query_informacions = $pdo->prepare("SELECT * FROM tb_informaciones WHERE estado = '1' ");
                $query_informacions->execute();
                $informacions = $query_informacions->fetchAll(PDO::FETCH_ASSOC);
                foreach($informacions as $informacion){
                    $id_informacion = $informacion['id_informacion'];
                    $nombre_parqueo = $informacion['nombre_parqueo'];
                    $actividad_empresa = $informacion['actividad_empresa'];
                    $sucursal = $informacion['sucursal'];
                    $direccion = $informacion['direccion'];
                    $zona = $informacion['zona'];
                    $telefono = $informacion['telefono'];
                    $departamento_ciudad = $informacion['departamento_ciudad'];
                    $pais = $informacion['pais'];
             }

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(79,100), true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 002');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(5,5,5);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, 5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('helvetica', '', 5);

// add a page
$pdf->AddPage();

// create some HTML content
$html = '
<div> 
    <p style="text-align: center"> 
    <b>'.$nombre_parqueo.'</b> <br>
        '.$actividad_empresa.' <br>
        SUCURSAL No. '.$sucursal.'<br>
        '.$direccion.' <br>
        ZONA: '.$zona.'<br>
        CONTACTO: '.$telefono.'<br>
        '.$departamento_ciudad.'-'.$pais.'
        ---------------------------------------------------------------------------------

        <div style="text-align: left">
            <b>DATOS DE CLIENTE</b><br>
            <b>SEÑOR(A):</b><br>
            <b>NIT/CC:</b><br>
        --------------------------------------------------------------------------------<br>
         <b>Cuviculo de Parqueo: </b><br>
         <b>Fecha de Ingreso: </b><br>
         <b>Hora de Ingreso: </b><br>
         --------------------------------------------------------------------------------<br>
         <b>USUARIO:</b><br>
         </div>
         

    </p>
</div>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


 






//Close and output PDF document
$pdf->Output('example_002.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+