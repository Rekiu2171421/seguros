<?php include 'user_into_sis.php'; ?>
 <style>
     body {
            font-family: "Nunito Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
   
            background-color: #fff;
            margin: 0;
            padding: 0;
            font-size: 10px;
        }
table {
    border-collapse: collapse;
}
  input[type="date"] {
    font-family: "Nunito Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    font-size: 13px;
    width: 98%;
    text-align: left;
}

         #cerrar {
            float: right; /* Coloca el enlace a la derecha */
            margin-top: 10px; /* Ajusta la posicin verticalmente */
            margin-right: 10px; /* Ajusta la posicin horizontalmente */
            text-decoration: none; /* Quita el subrayado del enlace */
            color: #393939; /* Color del enlace */
            font-size: 14px; /* Tamao del texto del enlace */
              font-weight: bold;
        }
        
       
        .mensaje {
            color: green;
            font-weight: bold;
            text-align: right;
        }
          .fondorojo {
    background-color: #FFE6E6; /* Puedes ajustar el color de fondo segn tus preferencias */
  }
   .fondoverde {
    background-color: #E6FFF5; /* Puedes ajustar el color de fondo segn tus preferencias */
  }
     .fondoamarillo {
    background-color: #FCF7D6; /* Puedes ajustar el color de fondo segn tus preferencias */
  }
   .fondoazul {
    background-color: #CEE3F6; /* Puedes ajustar el color de fondo segn tus preferencias */
  }

  input[type='file'] {
  background-color: #fff;
  border-color: #f2f2f2;
  width: 90%;
  padding: 1px; /* Ajusta el espaciado segn tus preferencias */
  border-radius: 5px;
  cursor: pointer; /* Cambia el cursor al pasar sobre el botn */
  outline: none; /* Elimina el contorno predeterminado en algunos navegadores */
}


  #Credito, #Cargo {
            display: none; /* Ocultar por defecto */
        }
   #Credito2, #Cargo2 {
            display: none; /* Ocultar por defecto */
        }

    </style>
 <!DOCTYPE html>
<html>
<head>
    <title>Seguro en Activacion</title>
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>


   
<?php
include 'conectar_base.php';

if (isset($_GET['idcliente'])) {
  $idcotfinal = $_GET['idcotfinal'];
   $idcontrato = $_GET['idcontrato'];
  $idc = $_GET['idcliente'];

    // Consulta para LeProCli
    $sqlLeProCli = "SELECT * FROM LeProCli WHERE Idcliente = ?";
    $stmtLeProCli = $conn->prepare($sqlLeProCli);
    $stmtLeProCli->bind_param("i", $idc);
    $stmtLeProCli->execute();
    $resultLeProCli = $stmtLeProCli->get_result();
    $rowLep = $resultLeProCli->fetch_assoc();
    
    
   $sqlExp = " SELECT * FROM `Seguros` WHERE Idcontrato = ?";
    $stmtExp = $conn->prepare($sqlExp);
    $stmtExp->bind_param("i", $idcontrato);
    $stmtExp->execute();
    $resultExp = $stmtExp->get_result();
    $rowSeg = $resultExp->fetch_assoc();

if ($rowSeg) { 
    $vigencia = $rowSeg['Vigenciacot']; 
    $prima = isset($rowSeg['Prima']) ? $rowSeg['Prima'] : 0;
  
$idcot = $rowSeg['Idcot'];

$idseguro = $rowSeg['Id'];
$completo = $rowSeg['Completo'];
$facilidad = $rowSeg['Facilidad'];
$cov1 = $rowSeg['Cov1'];
$cov2 = $rowSeg['Cov2'];
$cov3 = $rowSeg['Cov3'];
$cov4 = $rowSeg['Cov4'];

$udi = $rowSeg['Udi'];

$checked = ($completo === "Si") ? "checked" : "";
$checked2 = ($facilidad === "Si") ? "checked" : "";

$covc1 = ($cov1 === "1") ? "checked" : "";
$covc2 = ($cov2 === "1") ? "checked" : "";
$covc3 = ($cov3 === "1") ? "checked" : "";
$covc4 = ($cov4 === "1") ? "checked" : "";

$tasaf = isset($rowSeg['Tasaf']) ? $rowSeg['Tasaf'] : 0;
$prima = isset($rowSeg['Prima']) ? $rowSeg['Prima'] : 0;
$gtosexp = isset($rowSeg['Gtosexp']) ? $rowSeg['Gtosexp'] : 0;

$monto = isset($rowSeg['Monto']) ? $rowSeg['Monto'] : 0;
$iva = $monto * 0.16;
$montot =  $monto + $iva;

$deddm = isset($rowSeg['Deddm']) ? $rowSeg['Deddm'] : 0;
$deddm = isset($rowSeg['Dedrt']) ? $rowSeg['Dedrt'] : 0;

$deddma = isset($rowSeg['Deddma']) ? $rowSeg['Deddma'] : 0;
$deddma = isset($rowSeg['Dedrta']) ? $rowSeg['Dedrta'] : 0;

$adaptacion = isset($rowSeg['Adaptacion']) ? $rowSeg['Adaptacion'] : 'No';
$adapmonto = isset($rowSeg['Adapmonto']) ? $rowSeg['Adapmonto'] : 0;

$vigencia = $rowSeg['Vigenciacot'];
$comentario = $rowSeg['Comentario'];

$fecha = $rowSeg['Fecha'];
$inicio = $rowSeg['Inicio'];

$facprima = (isset($rowSeg['Facprima']) && !empty($rowSeg['Facprima'])) ? 
    (strpos($rowSeg['Facprima'], '.') !== false ? 
        $rowSeg['Facprima'] : 
        number_format((float)$rowSeg['Facprima']/1000, 3, '.', '')) : 
    0.012;
$cobertura = isset($rowSeg['Cobertura']) ? $rowSeg['Cobertura'] : '';

$tiposeguro = $rowSeg['Tiposeguro'];

$aseguradora = $rowSeg['Idproveedor'];
$broker = $rowSeg['Idbroker'];

$poliza = $rowSeg['Poliza'];
$fechapoliza = $rowSeg['Polizafechapago'];

$duracion = $rowSeg['Duracion'];
$fechainicio = $rowSeg['Inicio'];
$fechavencimiento = $rowSeg['Vencimiento'];

$date = new DateTime($fechavencimiento);
$mesNumero = $date->format('n'); 
$anov = $date->format('Y'); 

$fechaudi = $rowSeg['Fechaudi'];
$fechapcliente = $rowSeg['Fechapcliente'];

$meses = [
    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
    7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
];
$mesv = $meses[$mesNumero];
    
}


         
$consulta2 = "SELECT * FROM `CotizacionesFinales` WHERE `Id` = '$idcotfinal'";
$resultado2 = $conn->query($consulta2); 
    if ($resultado2->num_rows > 0) {
         $datos2 = $resultado2->fetch_assoc();



        $contrato = $datos2['Foliocontrato'];
        $tipo = $datos2['Tipo'];
        $cliente = $datos2['Cliente'];
        
        $fechafirma = $datos2['Fcon'];
        $fechafin = $datos2['Furenta'];
         
         
     $descot = $datos2['Descripcion']; 
      $cantidad = $datos2['Cant'];
                $valorsiva = $datos2['Valorsiva']; 
                $tcambio = $datos2['Tipocambio']; 
                $moneda = $datos2['Moneda']; 
                $valorcotizado = $cantidad * $valorsiva * $tcambio;
                $tipo =  $datos2['Tipo']; 
                
                $factor = $datos2['Segurofactor']; 

//operaciones de seguro


$tiposeg = ''; // Inicializa la variable
$montoseguro =  $datos2['Monto'];
 
 
$plazo =  $datos2['Plazo'];

 
switch ($tiposeguro) {
    case 'Seguro Financiado Anual':
        $tiposeg = 'Seguro Financiado Anual';
        $financiado = "Si";
        $seguromc = $montoseguro * 1.2 / 12;
        
        break;
    case 'Seguro de Contado Anual':
        $tiposeg = 'Seguro de Contado Anual';
        $financiado = "No";
          $seguromc = 0;
          
        break;
    case 'Seguro Financiado Multianual':
        $tiposeg = 'Seguro Financiado Multianual';
        $financiado = "Si";
        $seguromc = $montoseguro * $factor / $plazo;
        break;
        
    case 'Seguro a cuenta del Cliente':
        $tiposeg = 'Seguro a cuenta del Cliente';
        $financiado = "No";
          $seguromc = 0;
        break;
        
    case 'Seguro de Contado Multianual':
        $tiposeg = 'Seguro de Contado Multianual';
        $financiado = "No";
          $seguromc = 0;
        break;
    default:
        $tiposeg = 'Desconocido';
        $financiado = 'No definido';
        
        break;
}




 
}

$consulta3 = "SELECT * FROM Ordencompra WHERE Idcot = '$idcot'";
    $resultado3 = $conn->query($consulta3); 
    if ($resultado3->num_rows > 0) {
        $datos3 = $resultado3->fetch_assoc();
        $sumaalta = $datos3['Facttotales']; 
        $moneda2 = $datos3['Moneda'];
        
      
        
        
}

$marca = !empty($rowSeg['Marca']) ? $rowSeg['Marca'] : $datos3['Marca'];
$submarca = !empty($rowSeg['Submarca']) ? $rowSeg['Submarca'] : $datos3['Submarca'];
$transmision = !empty($rowSeg['Trasmision']) ? $rowSeg['Trasmision'] : $datos3['Transmision'];
$ano = !empty($rowSeg['Ano']) ? $rowSeg['Ano'] : $datos3['Modelo'];
$version = !empty($rowSeg['Version']) ? $rowSeg['Version'] : $datos3['Version'];


    
}


?>

<br>
<table style="margin-left:50px; width: 95%; border: none;">
<tr><td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;'>
 <h2>Seguro en Activación del Contrato: <?php echo $idcontrato; ?></h2>
</td>
<td style='border: none; text-align:center; border-bottom: 1px solid #d2d2d2;color: green;'>
<?php
// Verifica si se ha pasado un mensaje a través de la URL
if(isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
    echo "<p>$mensaje</p>";
}

?>
</td>

<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;'>Información Completa
<input type="checkbox" name="completo" id="completo" <?php echo $checked; ?> value="Si"> 
</td>

<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;'>


<button style=" background: #dc3545; margin-top: -50px; border: none; padding: 8px; border-radius: 5px; margin: 4px; color: #fff; cursor: pointer;" onclick="location.href='seguros_activacion_principal.php';">Regresar</button>


</td>

</tr>

</table>
<script>
// Agregar un evento de cambio al checkbox
document.getElementById('completo').addEventListener('change', function() {
    var idseguro = <?php echo $idseguro; ?>;  
    var completo = this.checked ? 'Si' : '';  
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'actualizar_seguro_completo.php', true);  
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText); 
            
        }
    };
     xhr.send('idseguro=' + idseguro + '&completo=' + completo);
});
</script>



<?php  if ($tipo == "Transporte") { ?>
	
<br>
  
    <form action="seguro_formidX.php" method="POST">
        <input type="hidden" name="idcontrato" value="<?php echo isset($idcontrato) ? $idcontrato : ''; ?>" >
        <input type="hidden" name="idcotfinal" value="<?php echo isset($idcotfinal) ? $idcotfinal : ''; ?>" >
        
       <input type="hidden" name="idseguro" id="idseguro" value="<?php echo isset($idseguro) ? $idseguro : ''; ?>" >
        <input type="hidden" name="idcliente" id="idcliente" value="<?php echo isset($idc) ? $idc : ''; ?>" >
        
      <?php include "charge_user_solo.php"; ?>
  
  <input type="hidden" name="facprima" id="facprima" value="">
  <input type="hidden" name="cobertura" id="cobertura" value="">
 
  </table>
  
 
<table style="margin-left:50px; width: 95%; border: none;">
<tr><td colspan="2" style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2; font-size:10px;'>Cliente : <input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $rowLep['Nombre']; ?>" readonly></td>
</td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Contrato : <input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $contrato; ?>" readonly></td>
</td>
<td colspan="2" style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Tipo de Activo : <input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $datos2['Catalogo']; ?>" readonly></td>
</td>
</tr>
<tr><td  colspan="5" style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2; font-size:10px;'>Descripción : <input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $datos2['Descripcion']; ?>" readonly></td>
</td></tr>



<tr>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Suma a Asegurar s/IVA<input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="$<?php echo number_format($valorcotizado, 2, '.', ','); ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Suma a Asegurar c/IVA<input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="$<?php echo number_format(($valorcotizado * 1.16), 2, '.', ','); ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Moneda<input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $moneda; ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Fecha de Firma de Contrato<input style="width:98%; border:none; text-align:left;" type="date" name="cliente" value="<?php echo $fechafirma; ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Fecha de Finalización de Contrato<input style="width:98%; border:none; text-align:left;" type="date" name="cliente"  value="<?php echo $fechafin; ?>" readonly></td>
</tr>


</table> 

<br>

<table style="margin-left:50px; width: 95%; border: none;">
      
<tr>
<td style='border: none; text-align:left;  font-size:10px;'>Vigencia de Cotización: <input style="width:98%;  text-align:left;" type="date" name="vigencia" id="vigencia" value="<?php echo isset($vigencia) ? $vigencia : ''; ?>">

      
      
      
<tr>

<td style='border: none; text-align:left;  font-size:10px;'>Prima : <input style="width:98%;  text-align:left;" type="text" name="prima" id="prima" value="<?php echo isset($prima) ? number_format($prima, 2, '.', ',') : '0'; ?>" class="format-number">

</td>
<td style='border: none; text-align:left;  font-size:10px;'>Tasa de Financiamiento : <input style="width:98%;  text-align:left;" type="text" name="tasaf" id="tasaf" value="<?php echo isset($tasaf) ? number_format($tasaf, 2, '.', ',') : ''; ?>" class="format-number">

</td>
<td style='border: none; text-align:left;  font-size:10px;'>Gastos de expedición : <input style="width:98%;  text-align:left;" type="text" name="gtosexp" id="gtosexp" value="<?php echo isset($gtosexp) ? number_format($gtosexp, 2, '.', ',') : ''; ?>" class="format-number"></td>

<td style='border: none; text-align:left;  font-size:10px;'>IVA : <input style="width:98%;  text-align:left;" type="text" name="iva" id="iva" value="<?php echo isset($iva) ? $iva : ''; ?>"></td>


<td style='border: none; text-align:left;  font-size:10px;'>Prima Total : <input type="hidden" name="monto" id="monto" value="<?php echo isset($monto) ? $monto : ''; ?>">
                                                                          <input style="width:98%;  text-align:left;" type="text" name="montot" id="montot" value="<?php echo isset($montot) ? number_format($montot, 2, '.', ',') : ''; ?>"></td>


   </tr>
   
      
<tr>

<td style='border: none; text-align:left;  font-size:10px;'>Plazo de arrendamiento meses: <input style="width:98%;  text-align:left;" type="number" step="0.01" name="plazo" id="plazo" value="<?php echo isset($plazo) ? $plazo : ''; ?>" readonly>
</td>

<td style='border: none; text-align:left;  font-size:10px;'>% UDI : <input style="width:98%;  text-align:left;" type="number" step="0.01" name="udi" id="udi" value="<?php echo isset($udi) ? $udi : '0'; ?>">
</td>

<td style='border: none; text-align:left;  font-size:10px;'>Monto UDI : <input style="width:98%;  text-align:left;" type="text" name="udimonto" id="udimonto" value="0" readonly>

</td>

<td style='border: none; text-align:left;  font-size:10px;'>Deducible por DM %: <input style="width:98%;  text-align:left;" type="number" step="0.01" name="deddm" id="deddm" value="<?php echo isset($deddm) ? $deddm : ''; ?>"></td>

<td style='border: none; text-align:left;  font-size:10px;'>Deducible por RT %: <input style="width:98%;  text-align:left;" type="number" step="0.01" name="dedrt" id="dedrt" value="<?php echo isset($dedrt) ? $dedrt : ''; ?>"></td>



   </tr>   

<tr>

<td style='border: none; text-align:left;  font-size:10px;'>Adaptacion: <select style="width:98%;" name="adaptacion" id="adaptacion">
  <option value="No" <?php echo (isset($adaptacion) && $adaptacion == 'No') ? 'selected' : ''; ?>>No</option>
  <option value="Si" <?php echo (isset($adaptacion) && $adaptacion == 'Si') ? 'selected' : ''; ?>>Sí</option>
</select>
</td>
</td>
<td style='border: none; text-align:left;  font-size:10px;'>Suma asegurada adaptación : <input style="width:98%;  text-align:left;" type="number" step="0.01" name="adapmonto" id="adapmonto" value="<?php echo isset($adapmonto) ? $adapmonto : '0'; ?>">

</td>
<td style='border: none; text-align:left;  font-size:10px;'>Deducible por DM adaptación %: <input style="width:98%;  text-align:left;" type="number" step="0.01" name="deddma" id="deddma" value="<?php echo isset($deddma) ? $deddma : ''; ?>"></td>

<td style='border: none; text-align:left;  font-size:10px;'>Deducible por RT adaptación %: <input style="width:98%;  text-align:left;" type="number" step="0.01" name="dedrta" id="dedrta" value="<?php echo isset($dedrta) ? $dedrta : ''; ?>"></td>



   </tr>      
 
<tr>



<td style='border: none; text-align:left;  font-size:10px;'>Seguro financiado: <select style="width:98%;" name="segfinanciado" id="segfinanciado" class="no-mayusculas">
  <option value="No" <?php echo (isset($financiado) && $financiado == 'No') ? 'selected' : ''; ?>>No</option>
  <option value="Si" <?php echo (isset($financiado) && $financiado == 'Si') ? 'selected' : ''; ?>>Sí</option>
</select>
</td>
</td>

<td style='border: none; text-align:left;  font-size:10px;'>Tipo de financiamiento : 
<select name="tiposeg" id="tiposeg" style="width:98%;" required>
    <option value="Seguro Financiado Anual" <?= $tiposeguro == 'Seguro Financiado Anual' ? 'selected' : '' ?>>Seguro Financiado Anual</option>
    <option value="Seguro de Contado Anual" <?= $tiposeguro == 'Seguro de Contado Anual' ? 'selected' : '' ?>>Seguro de Contado Anual</option>
    <option value="Seguro de Contado Multianual" <?= $tiposeguro == 'Seguro de Contado Multianual' ? 'selected' : '' ?>>Seguro de Contado Multianual</option>
    <option value="Seguro Financiado Multianual" <?= $tiposeguro == 'Seguro Financiado Multianual' ? 'selected' : '' ?>>Seguro Financiado Multianual</option>
    <option value="Seguro a cuenta del Cliente" <?= $tiposeguro == 'Seguro a cuenta del Cliente' ? 'selected' : '' ?>>Seguro a cuenta del Cliente</option>
</select> 
                                                                                     <input type="hidden" name="tiposeguro" id="tiposeguro" value="<?php echo isset($tiposeguro) ? $tiposeguro : '0'; ?>" readonly>    
</td>
<td style='border: none; text-align:left;  font-size:10px;'>Factor de Financiamiento: <input style="width:98%;  text-align:left;" type="number" step="0.01" name="factor" id="factor"  value="<?php echo isset($factor) ? $factor : 1.2; ?>"></td>

<td style='border: none; text-align:left;  font-size:10px;'>Monto Mensual a Pagar : <input style="width:98%;  text-align:left;" type="text" name="segurom" id="segurom" value="<?php echo isset($segurom) ? $segurom : 0; ?>" readonly></td>

<td style='border: none; text-align:left;  font-size:10px;'>Monto Mensual a Pagar c/IVA : <input style="width:98%;  text-align:left;" type="text" name="seguromiva" id="seguromiva" readonly></td>



   </tr>       
   

   
   
   
   
   <tr>
   <td colspan="5" style='border: none; text-align:left; font-size:10px;'>
  Comentario: 
  <textarea name="comentario" id="comentario" rows="3" style="width: 98%; text-align: left;"><?php echo isset($comentario) ? $comentario : ''; ?></textarea>
</td>
</tr>

<tr>
<td style='border: none; text-align:left;  font-size:10px;'>Asegurado : 
<select name="asegurado" style="width:98%;" required>
    <option value="" disabled <?= isset($asegurado) && $asegurado == '' ? 'selected' : '' ?>>SELECCIONAR</option>
    <option value="CLIENTE" <?= isset($asegurado) && $asegurado == 'CLIENTE' ? 'selected' : '' ?>>CLIENTE</option>
    <option value="ACTIVELEASING" <?= isset($asegurado) && ($asegurado == 'ACTIVELEASING' || $asegurado == 'ACTIVE') ? 'selected' : '' ?>>ACTIVE</option>
</select>

</td>

<td style='border: none; text-align:left;  font-size:10px;'>Aseguradora : 
<?php
$query = "SELECT `Id`, `Nombre` FROM `Aseguradoras` WHERE Estado = 'Activa'";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<select name='aseguradora' style='width:98%; text-align:left;' required>";
    
    // Agregar opción por defecto "No disponible"
    $selected = (!isset($aseguradora) || $aseguradora == 0) ? 'selected' : '';
    echo "<option value='0' $selected>No disponible</option>";

    // Agregar las opciones de la base de datos
    while ($row = mysqli_fetch_assoc($result)) {
        $selected = (isset($aseguradora) && $row['Id'] == $aseguradora) ? 'selected' : '';
        echo "<option value='" . $row['Id'] . "' $selected>" . htmlspecialchars($row['Nombre']) . "</option>";
    }
    
    echo "</select>";
} else {
    echo "Error en la consulta: " . mysqli_error($conn);
}
?>


</td>
<td style='border: none; text-align:left;  font-size:10px;'>Broker : 
<?php
$query = "SELECT `Id`, `Nombre` FROM `Referidos` WHERE `Tipo` = 'Broker' AND `Verificado` = 'si'";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<select name='broker' style='width:98%; text-align:left;' required>";

    // Agregar opción por defecto "Pendiente"
    $selected = (!isset($broker) || $broker == 0) ? 'selected' : '';
    echo "<option value='0' $selected>Pendiente</option>";

    // Agregar las opciones de la base de datos
    while ($row = mysqli_fetch_assoc($result)) {
        $selected = (isset($broker) && $row['Id'] == $broker) ? 'selected' : '';
        echo "<option value='" . $row['Id'] . "' $selected>" . htmlspecialchars($row['Nombre']) . "</option>";
    }

    echo "</select>";
} else {
    echo "Error en la consulta: " . mysqli_error($conn);
}
?>




</td>
<td style='border: none; text-align:left;  font-size:10px;'>Numero de Poliza : <input style="width:98%;  text-align:left;" type="text" name="poliza" value="<?php echo isset($poliza) ? $poliza : ''; ?>"></td>


    <td style="border: none; text-align:left; font-size:10px;">
                Fecha de pago de póliza
                <input style="width:98%; text-align:left;" type="date" name="fechapoliza" value="<?php echo isset($fechapoliza) ? $fechapoliza : ''; ?>">
            </td>
</tr>

<tr>
 <td style="border: none; text-align:left; font-size:10px;">
                Fecha de inicio
                <input style="width:98%; text-align:left;" type="date" name="fechai" id="fechai" value="<?php echo isset($fechainicio) ? $fechainicio : ''; ?>">
            </td>
   <td style="border: none; text-align:left; font-size:10px;">
                Fecha de Vencimiento 
                <input style="width:98%; text-align:left;" type="date" name="fechav" id="fechav" value="<?php echo isset($fechavencimiento) ? $fechavencimiento : ''; ?>">
            </td>
            <td style="border: none; text-align:left; font-size:10px;">
                Duración del Seguro en meses
                <input style="width:98%; text-align:left;" type="number" name="duracion" id="duracion" value="<?php echo isset($duracion) ? $duracion : ''; ?>">
            </td>
            <td style="border: none; text-align:left; font-size:10px;">
                Mes de Vencimiento 
                <input style="width:98%; text-align:left;" type="text" name="mesv" value="<?php echo isset($mesv) ? $mesv : ''; ?>" readonly>
            </td>
            <td style="border: none; text-align:left; font-size:10px;">
                Año de Vencimiento
                <input style="width:98%; text-align:left;" type="text" name="anov" value="<?php echo isset($anov) ? $anov : ''; ?>" readonly>
            </td>
   </tr>



<?php if($tipo='Transporte'){ ?>
<tr>
<td style='border: none; text-align:left;  font-size:10px;'>Marca : <input style="width:98%; text-align:left;" type="text" name="marca" value="<?php echo $marca; ?>"></td>    
<td style='border: none; text-align:left;  font-size:10px;'>Submarca : <input style="width:98%; text-align:left;" type="text" name="submarca" value="<?php echo $submarca; ?>" ></td>     
<td style='border: none; text-align:left;  font-size:10px;'>Version : <input style="width:98%;text-align:left;" type="text" name="version" value="<?php echo $version; ?>" ></td> 
<td style='border: none; text-align:left;  font-size:10px;'>Transmisión : <input style="width:98%;  text-align:left;" type="text" name="transmision" value="<?php echo $transmision; ?>"></td> 
<td style='border: none; text-align:left;  font-size:10px;'>Año : <input style="width:98%;  text-align:left;" type="text" name="ano" value="<?php echo $ano; ?>"></td> 
</tr>


  <tr>

 <td style="border: none; text-align:left; font-size:10px;">
                Fecha de pago de UDI
                <input style="width:98%; text-align:left;" type="date" name="fechaudi" id="fechaudi" value="<?php echo isset($fechaudi) ? $fechaudi : ''; ?>">
            </td>
   <td style="border: none; text-align:left; font-size:10px;">
                Fecha de Cobro al Cliente
                <input style="width:98%; text-align:left;" type="date" name="fechapcliente" id="fechapcliente" value="<?php echo isset($fechapcliente) ? $fechapcliente : ''; ?>">
            </td>
           
   </tr>

<?php } ?>

        <tr>
 
  <td colspan="5" style="text-align:right;">
        <button type="submit" class="envio" name="guardarButton" value="guardar" style=" width:20%; cursor:pointer ;background: #008000; border: none; padding: 4px; border-radius: 5px; margin: 4px; color: #fff;">Guardar</button></td></tr>
       
        </tr>
        </form>
</table>
<?php  } else { ?>
<br>
  
         <form action="seguro_formidX.php" method="POST">
         <input type="hidden" name="idcontrato" value="<?php echo isset($idcontrato) ? $idcontrato : ''; ?>" >
        <input type="hidden" name="idcotfinal" value="<?php echo isset($idcotfinal) ? $idcotfinal : ''; ?>" >
        
       <input type="hidden" name="idseguro" id="idseguro" value="<?php echo isset($idseguro) ? $idseguro : ''; ?>" >
        <input type="hidden" name="idcliente" id="idcliente" value="<?php echo isset($idc) ? $idc : ''; ?>" >
        <input type="hidden" name="tipo" id="tipo" value="<?php echo isset($tipo) ? $tipo : ''; ?>" >
      <?php include "charge_user_solo.php"; ?>
  
<input type="hidden" name="deddm" id="deddm">
<input type="hidden" name="dedrt" id="dedrt">
<input type="hidden" name="adaptacion" id="adaptacion">
<input type="hidden" name="deddma" id="deddma">
<input type="hidden" name="dedrta" id="dedrta">
<input type="hidden" name="adapmonto" id="adapmonto"> 
  </table>
  
 
<table style="margin-left:50px; width: 95%; border: none;">
<tr><td colspan="2" style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2; font-size:10px;'>Cliente : <input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $rowLep['Nombre']; ?>" readonly></td>
</td>
<td colspan="2" style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Tipo de Activo : <input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $datos2['Catalogo']; ?>" readonly></td>
</td>
</tr>
<tr><td  colspan="4" style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2; font-size:10px;'>Descripción : <input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $datos2['Descripcion']; ?>" readonly></td>
</td></tr>



<tr>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Suma a Asegurar Cotizada del Activo s/IVA<input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="$<?php echo number_format($valorcotizado, 2, '.', ','); ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Suma a Asegurar Cotizada del Activo c/IVA<input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="$<?php echo number_format(($valorcotizado * 1.16), 2, '.', ','); ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Moneda de Cotización<input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $moneda; ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Tipo de Cambio Arrendamniento<input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $tcambio; ?>" readonly></td>

</tr>

<tr>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Suma a Asegurar Alta del Activo s/IVA (Valor Factura)<input style="width:98%; border:none; text-align:left;" type="text" name="aseguradasiva" id="aseguradasiva" value="$<?php echo number_format($sumaalta, 2, '.', ','); ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Suma a Asegurar Alta del Activo c/IVA (Valor Factura)<input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="$<?php echo number_format(($sumaalta * 1.16), 2, '.', ','); ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Moneda de Alta<input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $moneda2; ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'></td>
</tr>

<tr>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Diferencia Suma Cotizada y Alta del Activo s/IVA<input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="$<?php echo number_format(($valorcotizado-$sumaalta), 2, '.', ','); ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Diferencia Suma Cotizada y Alta del Activo C/IVA<input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="$<?php echo number_format((($valorcotizado-$sumaalta) * 1.16), 2, '.', ','); ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'></td>
</tr>
</table>         

<br>

<table style="margin-left:50px; width: 95%; border: none;">
 

 
      
<tr>

<td style='border: none; text-align:left;  font-size:10px;'>Facilidad
<input type="checkbox" name="facilidad" id="facilidad" <?php echo $checked2; ?> value="Si"> 
</td>

<script>
document.getElementById('facilidad').addEventListener('change', function() {
    var idseguro = <?php echo json_encode($idseguro); ?>;
    var facilidad = this.checked ? 'Si' : '';  // Ahora usa string vacío cuando está desmarcado
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'actualizar_facilidad_seguro.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                console.log('Respuesta:', xhr.responseText);
            } else {
                console.error('Error en la solicitud');
            }
        }
    };
    
    var params = 'idseguro=' + encodeURIComponent(idseguro) + 
                '&facilidad=' + encodeURIComponent(facilidad);
    xhr.send(params);
});
</script>
    

<td style='border: none; text-align:left;  font-size:10px;'>Vigencia de Cotización: <input style="width:98%;  text-align:left;" type="date" name="vigencia" id="vigencia" value="<?php echo isset($vigencia) ? $vigencia : ''; ?>">

      
      
      
<tr>

<td style='border: none; text-align:left;  font-size:10px;'>Prima : <input style="width:98%;  text-align:left;" type="text" name="prima" id="prima" value="<?php echo isset($prima) ? number_format($prima, 2, '.', ',') : ''; ?>" class="format-number">
<input style="width:98%;  text-align:left;" type="hidden" step="0.01" name="tasaf" id="tasaf" value="<?php echo isset($tasaf) ? $tasaf : 0; ?>">
</td>

<td id="campo-gtosexp" style='border: none; text-align:left; font-size:10px;'>
    Gastos de expedición : 
    <input style="width:98%; text-align:left;" type="text" name="gtosexp" id="gtosexp" 
           value="<?php echo isset($gtosexp) ? number_format($gtosexp, 2, '.', ',') : ''; ?>" class="format-number">
</td>

<td style='border: none; text-align:left;  font-size:10px;'>IVA : <input style="width:98%;  text-align:left;" type="text" step="0.01" name="iva" id="iva" value="<?php echo isset($iva) ? $iva : ''; ?>" class="format-number"></td>


<td style='border: none; text-align:left;  font-size:10px;'>Prima Total : <input type="hidden" name="monto" id="monto" value="<?php echo isset($monto) ? $monto : ''; ?>">
                                                                          <input style="width:98%;  text-align:left;" type="text" name="montot" id="montot" value="<?php echo isset($montot) ? $montot : ''; ?>" class="format-number"></td>


   </tr>
   
      
<tr>
<?php
if ($permiso == "R1eSgoS" || $permiso == "SegUros" ||  $permiso == "DiRgEn" || $permiso == "D3saRrOllo"){
?>

<td id="campo-facprima" style='border: none; text-align:left; font-size:10px; display: none;'>
    Factor Prima: 
    <input style="width:98%; text-align:left;" type="text" 
           name="facprima" id="facprima" 
           value="<?php echo isset($facprima) ? number_format((float)$facprima, 3, '.', '') : '0.012'; ?>">
</td>

<?php } else { ?>

<td id="campo-facprima" style='border: none; text-align:left; font-size:10px; display: none;'>
    Factor Prima: 
    <input style="width:98%; text-align:left; background:#d2d2d2;" 
           type="text" name="facprima" id="facprima" 
           value="<?php echo isset($facprima) ? $facprima : ''; ?>" readonly>
</td>

<?php } ?>

<td style='border: none; text-align:left;  font-size:10px;'>Plazo de arrendamiento meses: <input style="width:98%;  text-align:left;" type="number" step="0.01" name="plazo" id="plazo" value="<?php echo isset($plazo) ? $plazo : ''; ?>"  readonly>

</td>
<td id="campo-udi" style='border: none; text-align:left; font-size:10px;'>UDI :<input style="width:98%; text-align:left;" type="number" step="0.01" name="udi" id="udi" value="<?php echo isset($udi) ? $udi : '0'; ?>">
</td>

<td id="campo-udi2" style='border: none; text-align:left;  font-size:10px;'>Monto UDI : <input style="width:98%;  text-align:left;" type="text" name="udimonto" id="udimonto" value="0" readonly>

</td>

<td style='border: none; text-align:left;  font-size:10px;display:none'>Tipo de Cobertura : <input style="width:98%;  text-align:left;" type="text" name="cobertura" id="cobertura" value="<?php echo isset($cobertura) ? $cobertura : ''; ?>">

</td>




   </tr>   


<tr>

<td style='border: none; text-align:left;  font-size:10px;'>Seguro financiado: <select style="width:98%;" name="segfinanciado" id="segfinanciado">
  <option value="No" <?php echo (isset($segfinanciado) && $segfinanciado == 'No') ? 'selected' : ''; ?>>No</option>
  <option value="Si" <?php echo (isset($segfinanciado) && $segfinanciado == 'Si') ? 'selected' : ''; ?>>Sí</option>
</select>
</td>
</td>

<td style='border: none; text-align:left;  font-size:10px;'>Tipo de financiamiento :
<select name="tiposeg" id="tiposeg" style="width:98%;" required>
    <option value="Seguro Financiado Anual" <?= $tiposeguro == 'Seguro Financiado Anual' ? 'selected' : '' ?>>Seguro Financiado Anual</option>
    <option value="Seguro de Contado Anual" <?= $tiposeguro == 'Seguro de Contado Anual' ? 'selected' : '' ?>>Seguro de Contado Anual</option>
    <option value="Seguro de Contado Multianual" <?= $tiposeguro == 'Seguro de Contado Multianual' ? 'selected' : '' ?>>Seguro de Contado Multianual</option>
    <option value="Seguro Financiado Multianual" <?= $tiposeguro == 'Seguro Financiado Multianual' ? 'selected' : '' ?>>Seguro Financiado Multianual</option>
    <option value="Seguro a cuenta del Cliente" <?= $tiposeguro == 'Seguro a cuenta del Cliente' ? 'selected' : '' ?>>Seguro a cuenta del Cliente</option>
</select> 
<input type="hidden" name="tiposeguro" id="tiposeguro" value="<?php echo isset($tiposeguro) ? $tiposeguro : '0'; ?>" readonly>    
</td>
<td style='border: none; text-align:left;  font-size:10px;'>Factor de Financiamiento: <input style="width:98%;  text-align:left;" type="number" step="0.01" name="factor" id="factor"  value="<?php echo isset($factor) ? $factor : 1.2; ?>"></td>

<td style='border: none; text-align:left;  font-size:10px;'>Monto Mensual a Pagar : <input style="width:98%;  text-align:left;" type="text" name="segurom" id="segurom" value="<?php echo isset($segurom) ? $segurom : 0; ?>" readonly></td>

<td style='border: none; text-align:left;  font-size:10px;'><input style="width:98%;  text-align:left;" type="hidden" step="0.01" name="seguromiva" id="seguromiva"></td>



   </tr>       
   <tr>
       
       <tr>

<td id="campo-cov1" style='border: none; text-align:left;  font-size:10px;display:none;'>
<input type="checkbox" name="cov1" id="cov1" <?php echo $covc1; ?> value="1">Rotura de maquinaria
</td>
<td id="campo-cov2" style='border: none; text-align:left;  font-size:10px;display:none;'>
<input type="checkbox" name="cov2" id="cov2" <?php echo $covc2; ?> value="1">Equipo Electrónico
</td>
<td  id="campo-cov3" style='border: none; text-align:left;  font-size:10px;display:none;'>
<input type="checkbox" name="cov3" id="cov3" <?php echo $covc3; ?> value="1">Contenidos
</td>
<td id="campo-cov4" style='border: none; text-align:left;  font-size:10px;display:none;'>
<input type="checkbox" name="cov4" id="cov4" <?php echo $covc4; ?> value="1">Equipo de Contratistas
</td>

<script>
document.getElementById('cov1').addEventListener('change', function() {
    var idseguro = <?php echo json_encode($idseguro); ?>;
    var cov1 = this.checked ? '1' : '';  // Ahora usa string vacío cuando está desmarcado
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'actualizar_cov1_seguro.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                console.log('Respuesta:', xhr.responseText);
            } else {
                console.error('Error en la solicitud');
            }
        }
    };
    
    var params = 'idseguro=' + encodeURIComponent(idseguro) + 
                '&cov1=' + encodeURIComponent(cov1);
    xhr.send(params);
});

document.getElementById('cov2').addEventListener('change', function() {
    var idseguro = <?php echo json_encode($idseguro); ?>;
    var cov2 = this.checked ? '1' : '';  // Ahora usa string vacío cuando está desmarcado
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'actualizar_cov2_seguro.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                console.log('Respuesta:', xhr.responseText);
            } else {
                console.error('Error en la solicitud');
            }
        }
    };
    
    var params = 'idseguro=' + encodeURIComponent(idseguro) + 
                '&cov2=' + encodeURIComponent(cov2);
    xhr.send(params);
});

document.getElementById('cov3').addEventListener('change', function() {
    var idseguro = <?php echo json_encode($idseguro); ?>;
    var cov3 = this.checked ? '1' : '';  // Ahora usa string vacío cuando está desmarcado
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'actualizar_cov3_seguro.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                console.log('Respuesta:', xhr.responseText);
            } else {
                console.error('Error en la solicitud');
            }
        }
    };
    
    var params = 'idseguro=' + encodeURIComponent(idseguro) + 
                '&cov3=' + encodeURIComponent(cov3);
    xhr.send(params);
});
document.getElementById('cov4').addEventListener('change', function() {
    var idseguro = <?php echo json_encode($idseguro); ?>;
    var cov4 = this.checked ? '1' : '';  // Ahora usa string vacío cuando está desmarcado
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'actualizar_cov4_seguro.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                console.log('Respuesta:', xhr.responseText);
            } else {
                console.error('Error en la solicitud');
            }
        }
    };
    
    var params = 'idseguro=' + encodeURIComponent(idseguro) + 
                '&cov4=' + encodeURIComponent(cov4);
    xhr.send(params);
});
</script>
       
   </tr>
   
   
   
   <tr>
   <td colspan="5" style='border: none; text-align:left; font-size:10px;'>
  Observaciones: 
  <textarea name="comentario" id="comentario" rows="3" style="width: 98%; text-align: left;"><?php echo isset($comentario) ? $comentario : ''; ?></textarea>
</td>
</tr>

<tr>
<td style='border: none; text-align:left;  font-size:10px;'>Asegurado : 
<select name="asegurado" style="width:98%;" required>
    <option value="" disabled <?= isset($asegurado) && $asegurado == '' ? 'selected' : '' ?>>SELECCIONAR</option>
    <option value="CLIENTE" <?= isset($asegurado) && $asegurado == 'CLIENTE' ? 'selected' : '' ?>>CLIENTE</option>
    <option value="ACTIVELEASING" <?= isset($asegurado) && ($asegurado == 'ACTIVELEASING' || $asegurado == 'ACTIVE') ? 'selected' : '' ?>>ACTIVE</option>
</select>

</td>

<td style='border: none; text-align:left;  font-size:10px;'>Aseguradora : 
<?php
$query = "SELECT `Id`, `Nombre` FROM `Aseguradoras` WHERE Estado = 'Activa'";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<select name='aseguradora' style='width:98%; text-align:left;' required>";
    
    // Agregar opción por defecto "No disponible"
    $selected = (!isset($aseguradora) || $aseguradora == 0) ? 'selected' : '';
    echo "<option value='0' $selected>No disponible</option>";

    // Agregar las opciones de la base de datos
    while ($row = mysqli_fetch_assoc($result)) {
        $selected = (isset($aseguradora) && $row['Id'] == $aseguradora) ? 'selected' : '';
        echo "<option value='" . $row['Id'] . "' $selected>" . htmlspecialchars($row['Nombre']) . "</option>";
    }
    
    echo "</select>";
} else {
    echo "Error en la consulta: " . mysqli_error($conn);
}
?>


</td>
<td style='border: none; text-align:left;  font-size:10px;'>Broker : 
<?php
$query = "SELECT `Id`, `Nombre` FROM `Referidos` WHERE `Tipo` = 'Broker' AND `Verificado` = 'si'";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<select name='broker' style='width:98%; text-align:left;' required>";

    // Agregar opción por defecto "Pendiente"
    $selected = (!isset($broker) || $broker == 0) ? 'selected' : '';
    echo "<option value='0' $selected>Pendiente</option>";

    // Agregar las opciones de la base de datos
    while ($row = mysqli_fetch_assoc($result)) {
        $selected = (isset($broker) && $row['Id'] == $broker) ? 'selected' : '';
        echo "<option value='" . $row['Id'] . "' $selected>" . htmlspecialchars($row['Nombre']) . "</option>";
    }

    echo "</select>";
} else {
    echo "Error en la consulta: " . mysqli_error($conn);
}
?>




</td>
<td style='border: none; text-align:left;  font-size:10px;'>Numero de Poliza : <input style="width:98%;  text-align:left;" type="text" name="poliza" value="<?php echo isset($poliza) ? $poliza : ''; ?>"></td>


    <td style="border: none; text-align:left; font-size:10px;">
                Fecha de pago de póliza
                <input style="width:98%; text-align:left;" type="date" name="fechapoliza" value="<?php echo isset($fechapoliza) ? $fechapoliza : ''; ?>">
            </td>
</tr>

<tr>
 <td style="border: none; text-align:left; font-size:10px;">
                Fecha de inicio
                <input style="width:98%; text-align:left;" type="date" name="fechai" id="fechai" value="<?php echo isset($fechainicio) ? $fechainicio : ''; ?>">
            </td>
   <td style="border: none; text-align:left; font-size:10px;">
                Fecha de Vencimiento 
                <input style="width:98%; text-align:left;" type="date" name="fechav" id="fechav" value="<?php echo isset($fechavencimiento) ? $fechavencimiento : ''; ?>">
            </td>
            <td style="border: none; text-align:left; font-size:10px;">
                Duración del Seguro en meses
                <input style="width:98%; text-align:left;" type="number" name="duracion" id="duracion" value="<?php echo isset($duracion) ? $duracion : ''; ?>">
            </td>
            <td style="border: none; text-align:left; font-size:10px;">
                Mes de Vencimiento 
                <input style="width:98%; text-align:left;" type="text" name="mesv" value="<?php echo isset($mesv) ? $mesv : ''; ?>" readonly>
            </td>
            <td style="border: none; text-align:left; font-size:10px;">
                Año de Vencimiento
                <input style="width:98%; text-align:left;" type="text" name="anov" value="<?php echo isset($anov) ? $anov : ''; ?>" readonly>
            </td>
   </tr>



<tr>
<td style='border: none; text-align:left;  font-size:10px;'><input type="hidden" name="marca" value="<?php echo $marca; ?>"></td>    
<td style='border: none; text-align:left;  font-size:10px;'><input type="hidden" name="submarca" value="<?php echo $submarca; ?>" ></td>     
<td style='border: none; text-align:left;  font-size:10px;'><input type="hidden" name="version" value="<?php echo $version; ?>" ></td> 
<td style='border: none; text-align:left;  font-size:10px;'><input type="hidden" name="transmision" value="<?php echo $transmision; ?>"></td> 
<td style='border: none; text-align:left;  font-size:10px;'><input type="hidden" name="ano" value="<?php echo $ano; ?>"></td> 
</tr>


        <tr>

 <td style="border: none; text-align:left; font-size:10px;">
                Fecha de pago de UDI
                <input style="width:98%; text-align:left;" type="date" name="fechaudi" id="fechaudi" value="<?php echo isset($fechaudi) ? $fechaudi : ''; ?>">
            </td>
   <td style="border: none; text-align:left; font-size:10px;">
                Fecha de Cobro al Cliente
                <input style="width:98%; text-align:left;" type="date" name="fechapcliente" id="fechapcliente" value="<?php echo isset($fechapcliente) ? $fechapcliente : ''; ?>">
            </td>
           
   </tr>



</tr>

        <tr>
 
  <td colspan="5" style="text-align:right;">
        <button type="submit" class="envio" name="guardarButton" value="guardar" style=" width:20%; cursor:pointer ;background: #008000; border: none; padding: 4px; border-radius: 5px; margin: 4px; color: #fff;">Guardar</button></td></tr>
       </form>
        </tr>
</table>

<script>
function calcularPrima() {
    // Obtener el valor de aseguradasiva y limpiarlo
    var aseguradaSivaStr = document.getElementById('aseguradasiva').value;
    var aseguradaSiva = parseFloat(aseguradaSivaStr.replace(/[$,]/g, ''));
    
    // Obtener y limpiar el valor del factor prima
    var facprimaStr = document.getElementById('facprima').value;
    var facprima = parseFloat(facprimaStr.replace(/,/g, '.')) || 0.012; // Usar 0.012 como valor por defecto (1.2%)

    var plazo = parseFloat(document.getElementById('plazo').value) || 0;
    var primaInput = document.getElementById('prima');
    
    var gtosexpInput = document.getElementById('gtosexp');
    gtosexpInput.value = 0;
    
    // Calcular la prima - multiplicar directamente por el factor decimal
    var primaCalculada = aseguradaSiva * facprima * (plazo/12);
    
    // Establecer el valor calculado con 2 decimales
    primaInput.value = primaCalculada.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
     
    // Llamar a calcularSeguro() después de actualizar la prima
    if (typeof calcularSeguro === 'function') {
        calcularSeguro();
    } else {
        console.error('La función calcularSeguro no está definida');
    }
}

function toggleCampos() {
    var checkbox = document.getElementById('facilidad');
    var campoGtosexp = document.getElementById('campo-gtosexp');
    
    var campoUdi = document.getElementById('campo-udi');
    var campoUdi2 = document.getElementById('campo-udi2');
    var campoFacprima = document.getElementById('campo-facprima');
    var primaInput = document.getElementById('prima');
    var facprimaInput = document.getElementById('facprima');
    
    var campoCov1 = document.getElementById('campo-cov1');
    var campoCov2 = document.getElementById('campo-cov2');
    var campoCov3 = document.getElementById('campo-cov3');
    var campoCov4 = document.getElementById('campo-cov4');

    if (checkbox.checked) {
        // Si está checked
        campoGtosexp.style.display = 'none';
        
       
        campoUdi.style.display = 'none';
        campoUdi2.style.display = 'none';
        campoFacprima.style.display = '';
        campoCov1.style.display = '';
        campoCov2.style.display = '';
        campoCov3.style.display = '';
        campoCov4.style.display = '';
        primaInput.readOnly = true;
        // Calcular prima inicial y actualizar totales
        calcularPrima();
        // Agregar evento para recalcular cuando cambie facprima
        facprimaInput.addEventListener('input', calcularPrima);
       
        
        
    } else {
        // Si NO está checked
        campoGtosexp.style.display = '';
        campoUdi.style.display = '';
        campoUdi2.style.display = '';
        campoFacprima.style.display = 'none';
        campoCov1.style.display = 'none';
        campoCov2.style.display = 'none';
        campoCov3.style.display = 'none';
        campoCov4.style.display = 'none';
        primaInput.readOnly = false;
        // Remover evento de cálculo automático
        facprimaInput.removeEventListener('input', calcularPrima);
    }
}

// El resto del código permanece igual...

// Evento del checkbox
document.getElementById('facilidad').addEventListener('change', function() {
    var idseguro = <?php echo json_encode($idseguro); ?>;
    var facilidad = this.checked ? 'Si' : '';
    
    // Actualizar campos y calcular prima si es necesario
    toggleCampos();
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'actualizar_facilidad_seguro.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                console.log('Respuesta:', xhr.responseText);
            } else {
                console.error('Error en la solicitud');
            }
        }
    };
    
    var params = 'idseguro=' + encodeURIComponent(idseguro) + 
                '&facilidad=' + encodeURIComponent(facilidad);
    xhr.send(params);
});

// Ejecutar al cargar la página
window.addEventListener('load', toggleCampos);
</script>


<?php  }  ?>

</body>

<script>
 
        document.addEventListener('DOMContentLoaded', function() {
            calcularSeguro();
        
        });
    </script>


<?php



echo "<table style='width: 95%; border-collapse: collapse; margin-left:50px; font-size:12px'>";
echo "<tr><th colspan='4' style='border: none; padding: 10px; background: #ececec; text-align:left;'>Documentos Requeridos</th></tr>";
echo "<tr>";
echo "<th style='width: 40%; border: none; border-radius:0; text-align:left;'>Nombre</th>";

echo "<th style='width: 40%; border: none; border-radius:0; text-align:left;'>Documento</th>";
echo "<th style='width: 7%; border: none; border-radius:0; text-align:left;'>Acción</th>";

echo "</tr>";


    echo "<tr class='" . ($rowSeg['Polizapdf'] == "" ? 'fondorojo' : 'fondoverde') . "'>";
    echo "<td>Póliza de Seguro</td>";
   
if ($rowSeg['Polizapdf'] == "") {
    echo "<form method='POST' action='alta_seguroEXP1.php' enctype='multipart/form-data'>";
    echo "<input type='hidden' name='idseguro' value='" . $rowSeg['Id'] . "'>";
    echo "<input type='hidden' name='idc' value='" . $idc . "'>";
    echo "<input type='hidden' name='idcotfinal' value='" . $idcotfinal . "'>";
    echo "<input type='hidden' name='idcontrato' value='" . $idcontrato . "'>";
    echo "<td><input type='file' name='Estudio' required></td>";
    echo "<td><button style='width: 90%;background: #0d6efd; border: none; padding: 2px; border-radius: 5px; margin: 4px; color: #fff; cursor:pointer;' type='submit'>Cargar</button></td>";
    echo "</form>";
} else {
    echo "<td>";
    echo "<a href='seguros/" . $rowSeg['Polizapdf'] . "' target='_blank'>" . $rowSeg['Polizapdffecha'] . "</a>";
    echo "</td>";
    echo "<form method='POST' action='alta_seguroDEL1.php'>";
   echo "<input type='hidden' name='idseguro' value='" . $rowSeg['Id'] . "'>";
    echo "<input type='hidden' name='idc' value='" . $idc . "'>";
    echo "<input type='hidden' name='idcotfinal' value='" . $idcotfinal . "'>";
    echo "<input type='hidden' name='idcontrato' value='" . $idcontrato . "'>";
    echo "<td><button style='width: 90%;background: #dc3545; border: none; padding: 2px; border-radius: 5px; margin: 4px; color: #fff; cursor:pointer;' type='submit' onclick='return confirmarEliminacion()'>Eliminar</button></td>";
    echo "</form>";
}
echo "</tr>";

 echo "<tr class='" . ($rowSeg['Endosopdf'] == "" ? 'fondorojo' : 'fondoverde') . "'>";
    echo "<td>Endoso de la póliza de Seguro</td>";
   
if ($rowSeg['Endosopdf'] == "") {
    echo "<form method='POST' action='alta_seguroEXP2.php' enctype='multipart/form-data'>";
    echo "<input type='hidden' name='idseguro' value='" . $rowSeg['Id'] . "'>";
    echo "<input type='hidden' name='idc' value='" . $idc . "'>";
    echo "<input type='hidden' name='idcotfinal' value='" . $idcotfinal . "'>";
    echo "<input type='hidden' name='idcontrato' value='" . $idcontrato . "'>";
    echo "<td><input type='file' name='Estudio' required></td>";
    echo "<td><button style='width: 90%;background: #0d6efd; border: none; padding: 2px; border-radius: 5px; margin: 4px; color: #fff; cursor:pointer;' type='submit'>Cargar</button></td>";
    echo "</form>";
} else {
    echo "<td>";
    echo "<a href='seguros/" . $rowSeg['Endosopdf'] . "' target='_blank'>" . $rowSeg['Endosopdffecha'] . "</a>";
    echo "</td>";
    echo "<form method='POST' action='alta_seguroDEL2.php'>";
   echo "<input type='hidden' name='idseguro' value='" . $rowSeg['Id'] . "'>";
    echo "<input type='hidden' name='idc' value='" . $idc . "'>";
    echo "<input type='hidden' name='idcotfinal' value='" . $idcotfinal . "'>";
    echo "<input type='hidden' name='idcontrato' value='" . $idcontrato . "'>";
    echo "<td><button style='width: 90%;background: #dc3545; border: none; padding: 2px; border-radius: 5px; margin: 4px; color: #fff; cursor:pointer;' type='submit' onclick='return confirmarEliminacion()'>Eliminar</button></td>";
    echo "</form>";
}
echo "</tr>";
echo "<tr class='" . ($rowSeg['Recibopdf'] == "" ? 'fondorojo' : 'fondoverde') . "'>";
    echo "<td>Factura de la póliza de Seguro</td>";
   
if ($rowSeg['Recibopdf'] == "") {
    echo "<form method='POST' action='alta_seguroEXP3.php' enctype='multipart/form-data'>";
    echo "<input type='hidden' name='idseguro' value='" . $rowSeg['Id'] . "'>";
    echo "<input type='hidden' name='idc' value='" . $idc . "'>";
    echo "<input type='hidden' name='idcotfinal' value='" . $idcotfinal . "'>";
    echo "<input type='hidden' name='idcontrato' value='" . $idcontrato . "'>";
    echo "<td><input type='file' name='Estudio' required></td>";
    echo "<td><button style='width: 90%;background: #0d6efd; border: none; padding: 2px; border-radius: 5px; margin: 4px; color: #fff; cursor:pointer;' type='submit'>Cargar</button></td>";
    echo "</form>";
} else {
    echo "<td>";
    echo "<a href='seguros/" . $rowSeg['Recibopdf'] . "' target='_blank'>" . $rowSeg['Recibopdffecha'] . "</a>";
    echo "</td>";
    echo "<form method='POST' action='alta_seguroDEL3.php'>";
   echo "<input type='hidden' name='idseguro' value='" . $rowSeg['Id'] . "'>";
    echo "<input type='hidden' name='idc' value='" . $idc . "'>";
    echo "<input type='hidden' name='idcotfinal' value='" . $idcotfinal . "'>";
    echo "<input type='hidden' name='idcontrato' value='" . $idcontrato . "'>";
    echo "<td><button style='width: 90%;background: #dc3545; border: none; padding: 2px; border-radius: 5px; margin: 4px; color: #fff; cursor:pointer;' type='submit' onclick='return confirmarEliminacion()'>Eliminar</button></td>";
    echo "</form>";
}


/*
       
 echo "<tr class='" . ($rowSeg['Doccotseguro'] == "" ? 'fondorojo' : 'fondoverde') . "'>";
 echo "<td>Cotización de Seguro</td>";
if ($rowSeg['Doccotseguro'] == "") {

echo "<form method='POST' action='alta_seguroEXP2f.php' enctype='multipart/form-data'>";
echo "<input type='hidden' name='idcot' value='$idcot'>";
echo "<input type='hidden' name='idc' value='$idc'>";
echo "<td><input type='file' name='Estudio' required></td>";
echo "<td><button style='width: 90%;background: #0d6efd; border: none; padding: 2px; border-radius: 5px; margin: 4px; color: #fff; cursor:pointer;' type='submit'>Cargar</button></td>";
echo "</form>";

} else {
    echo "<td>";
    echo "<a href='Seguros/{$rowSeg['Doccotseguro']}' target='_blank'>Ver Documento</a>";
    echo "</td>";
   
    echo "<form  method='POST' action='alta_seguroEXP2fdel.php'>"; 
    
    echo "<input type='hidden' name='idcot' value='$idcot'>";
    echo "<input type='hidden' name='idc' value='$idc'>";
    echo "<td><button name='eliminar' style='width: 90%;background: #dc3545; border: none; padding: 2px; border-radius: 5px; margin: 4px; color: #fff; cursor:pointer;' type='submit' onclick='return confirmarEliminacion()'>Eliminar</button>";
    echo "</td></form>";
}    
echo "</tr>";

}
*/



$query2 = "SELECT * FROM Documentosextra WHERE Idcontrato = ? AND Tipo = 'Seguros'";
$stmt2 = mysqli_prepare($conn, $query2);
mysqli_stmt_bind_param($stmt2, "s", $idcontrato);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);

if (!$result2) {
    die("Error al ejecutar la consulta: " . mysqli_error($conn));
}


while ($rowSegex = mysqli_fetch_assoc($result2)) {
       
 echo "<tr class='fondoverde'>";
 echo "<td>" . $rowSegex['Descripcion'] . "</td>";
    echo "<td>";
    echo "<a href='Extras/{$rowSegex['Archivo']}' target='_blank'>Ver Documento</a>";
    echo "</td>";
   
    echo "<form  method='POST' action='documento_extra_segurodel_final.php'>"; 
    
   echo "<input type='hidden' name='idseguro' value='" . $rowSeg['Id'] . "'>";
    echo "<input type='hidden' name='idc' value='" . $idc . "'>";
    echo "<input type='hidden' name='idcotfinal' value='" . $idcotfinal . "'>";
    echo "<input type='hidden' name='idcontrato' value='" . $idcontrato . "'>";
    echo "<input type='hidden' name='id' value='" . htmlspecialchars($rowSegex['Id']) . "'>";
    echo "<td><button style='width: 90%;background: #dc3545; border: none; padding: 2px; border-radius: 5px; margin: 4px; color: #fff; cursor:pointer;' type='submit' onclick='return confirmarEliminacion()'>Eliminar</button>";
    echo "</td></form>";
    
echo "</tr>";

}





 echo "<tr style='background-color:#fad7a0'>";
echo "<form method='POST' action='documento_extra_seguro_final.php' enctype='multipart/form-data'>";
echo "<td>AGREGAR DOCUMENTO EXTRA<input type='text' name='descr' style='width: 95%;' required></td>";
 echo "<input type='hidden' name='idseguro' value='" . $rowSeg['Id'] . "'>";
    echo "<input type='hidden' name='idcliente' value='" . $idc . "'>";
    echo "<input type='hidden' name='idcotfinal' value='" . $idcotfinal . "'>";
    echo "<input type='hidden' name='idcontrato' value='" . $idcontrato . "'>";
echo "<td><input type='file' name='Estudio2' required></td>";
echo "<td><button style='width: 90%;background: #0d6efd; border: none; padding: 2px; border-radius: 5px; margin: 4px; color: #fff; cursor:pointer;' type='submit'>Cargar</button></td>";
echo "</form>";
echo "</tr>";


echo "</table>";

?>

<script>
  // Función para actualizar los valores de prima, tasaf y gtosexp
  function actualizarValores() {
    let prima = parseFloat(document.getElementById('prima').value.replace(/,/g, '')) || 0;
    let tasaf = parseFloat(document.getElementById('tasaf').value.replace(/,/g, '')) || 0;
    let gtosexp = parseFloat(document.getElementById('gtosexp').value.replace(/,/g, '')) || 0;

    
    // Calcular "monto" (prima - tasaf - gtosexp)
    let monto = prima - tasaf + gtosexp;
    document.getElementById('monto').value = monto.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    
    // Calcular el IVA (monto * 0.16, por ejemplo)
    let iva = monto * 0.16;  // Asumiendo una tasa de IVA del 16%
    document.getElementById('iva').value = iva.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    
    // Calcular "montot" (monto + iva)
    let montot = monto + iva;
    document.getElementById('montot').value = montot.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  }

  // Función para realizar los cálculos de seguro
  function calcularSeguro() {
    // Obtener valores desde el DOM
    let tiposeguro = document.getElementById('tiposeg').value; // Sin parseInt, ya que es texto
    let monto = parseFloat(document.getElementById('monto').value.replace(/,/g, '')) || 0;
    let factor = parseFloat(document.getElementById('factor').value) || 1.2;
    let plazo = parseFloat(document.getElementById('plazo').value) || 12;

    // Referencias a los campos de resultado
    let segurom = document.getElementById('segurom');
    let seguromiva = document.getElementById('seguromiva');

    // Calcular según el tipo de seguro
    if (tiposeguro === 'Seguro Financiado Anual') {
        let resultado = (monto * factor) / 12;
        segurom.value = resultado.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        seguromiva.value = (resultado * 1.16).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    } else if (['Seguro de Contado Anual', 'Seguro de Contado Multianual'].includes(tiposeguro)) {
        segurom.value = '0';
        seguromiva.value = '0';
    } else if (tiposeguro === 'Seguro Financiado Multianual') {
        let resultado = (monto * factor) / plazo;
        segurom.value = resultado.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        seguromiva.value = (resultado * 1.16).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    } else if (tiposeguro === 'Seguro a cuenta del Cliente') {
        segurom.value = '0';
        seguromiva.value = '0';
    } else {
        segurom.value = '0';
        seguromiva.value = '0';
    }
}


  // Función que llama a ambas funciones cuando cambian los valores
  function actualizarYCalcular() {
    actualizarValores();
    calcularSeguro();
  }

  // Llamar a las funciones de actualización de valores y cálculos de seguro al cargar la página
  window.onload = function() {
    // Agregar eventos para los campos de prima, tasaf y gtosexp
    document.getElementById('prima').addEventListener('input', actualizarYCalcular);
    document.getElementById('tasaf').addEventListener('input', actualizarYCalcular);
    document.getElementById('gtosexp').addEventListener('input', actualizarYCalcular);

    // Agregar eventos para los campos de factor y tiposeguro
    document.getElementById('tiposeg').addEventListener('change', actualizarYCalcular);
    document.getElementById('factor').addEventListener('input', actualizarYCalcular);
     document.getElementById('facprima').addEventListener('input', actualizarYCalcular);

    // Ejecutar ambas funciones para asegurarse de que los campos se calculen al cargar la página
    actualizarYCalcular();
  }
</script>

<script>
function confirmarEliminacion() {
    return confirm("¿Estás seguro de que deseas eliminar este documento?");
}
</script>
<script>
function calcularUDI() {
    let udi = parseFloat(document.getElementById('udi').value) || 0;
    let prima2 = parseFloat(document.getElementById('prima').value.replace(/,/g, '')) || 0;
    let tasaf2 = parseFloat(document.getElementById('tasaf').value.replace(/,/g, '')) || 0;
    let gtosexp2 = parseFloat(document.getElementById('gtosexp').value.replace(/,/g, '')) || 0;

    
    let monto2 = prima2 - tasaf2 + gtosexp2;
    
    // Calcular el resultado base
    let resultadoBase = monto2 * udi / 100;
    
    // Añadir IVA al resultado (16%)
    let resultadoConIVA = resultadoBase * 1.16;

    // Formatear el resultado con comas como separador de miles
    document.getElementById('udimonto').value = resultadoConIVA.toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}

// Ejecutar al cargar la página
document.addEventListener('DOMContentLoaded', calcularUDI);

// Ejecutar al cambiar el valor de #udi
document.getElementById('udi').addEventListener('input', calcularUDI);
</script>
<br>
<?php include "expediente_activacion.php"; ?>


</html>