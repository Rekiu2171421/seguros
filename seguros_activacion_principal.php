<?php include 'user_into_sis.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="global_riesgo.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Listado de Activos</title>
</head>
<body>
<style>
  body {

  font-family: "Nunito Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    background-color: #fff;
  /*font-family: Arial, sans-serif;*/
  margin: 0;
  padding: 0;
}

 .thp {
    background-color: #fff;
    cursor: pointer;
    font-weight: bold;
    color: #3874ff;
    text-align: center;
    font-size: 10px; 
    justify-content: space-between;
   border: 1px solid #d2d2d2;
   margin: 0 auto 0 1px; /* Centrar horizontalmente y a帽adir margen derecho */
   padding: 8px;
    width:8%;
    border-top:none;
    border-left:none;
    border-right:none;
   
}
.thp2 {
    background-color: #fff;
    cursor: pointer;
    font-weight: bold;
    color: #000;
    text-align: center;
    font-size: 10px; 
    justify-content: space-between;
    width: 8%; /* Cambiado a 10% */
    margin: 0 auto 0 1px; /* Centrar horizontalmente y a帽adir margen derecho */
    border: 1px solid #d2d2d2;
    border-radius: 8px 8px 0 0;
    padding: 8px;
    border-bottom:none;
}


 
          #divaprobadas {
            display: none;
        }
          #divrechazadas {
            display: none;
        }
</style>

<h1 style="margin-left:50px;">Seguros en Activaci贸n</h1>



<?php
include 'conectar_base.php';


$sqlProspecto = "SELECT * FROM CotizacionesFinales WHERE Cartera = 'Vigente' AND Liberadomc = '' ORDER BY Idcontrato DESC";
$resultCliente = $conn->query($sqlProspecto);

echo "<table id='tablaClientes' style='width:95%; margin: 0 auto;'>";
echo "<tr>";
// Crear encabezados como enlaces
echo "<th style='width: 3%;'>Folio</th>";
echo "<th style='width: 15%;'>Cliente</th>";
echo "<th style='width: 20%;'>Activo</th>";
echo "<th style='width: 10%;'>Aseguradora</th>";
echo "<th style='width: 5%;'>No. Poliza</th>";
echo "<th style='width: 5%;'>Fecha inicio</th>";
echo "<th style='width: 5%;'>Fecha vencimiento</th>";
echo "<th style='width: 5%;'>Prima</th>";



echo "<th style='width: 5%;'>Edici贸n</th>";




while ($row = $resultCliente->fetch_assoc()) {
	$idcontrato = $row["Idcontrato"];

	$idcliente = $row["Idcliente"];
	$idsolicitud = $row["Idsolicitud"];
    $status2 = $row["Status2"];


    // Consulta para LeProCli
    $sqlLeProCli = "SELECT * FROM LeProCli WHERE Id = ?";
    $stmtLeProCli = $conn->prepare($sqlLeProCli);
    $stmtLeProCli->bind_param("i", $idcliente);
    $stmtLeProCli->execute();
    $resultLeProCli = $stmtLeProCli->get_result();
    $rowLep = $resultLeProCli->fetch_assoc();
  
    $sqlExp = " SELECT * FROM `Seguros` WHERE Idcontrato = ?";
    $stmtExp = $conn->prepare($sqlExp);
    $stmtExp->bind_param("i", $idcontrato);
    $stmtExp->execute();
    $resultExp = $stmtExp->get_result();
    $rowSeg = $resultExp->fetch_assoc();

    $idprov = $rowSeg["Idproveedor"];
    $idbroker = $rowSeg["Idbroker"];
    

    $sqlAse = " SELECT * FROM `Aseguradoras` WHERE Id = ?";
    $stmtAse = $conn->prepare($sqlAse);
    $stmtAse->bind_param("i", $idprov);
    $stmtAse->execute();
    $resultAse = $stmtAse->get_result();
    $rowAse = $resultAse->fetch_assoc();
    
       
    echo "<tr>";
  
    echo "<td>" . $row["Idcontrato"] . "</a></td>";
    echo "<td>" . $rowLep["Nombre"] . "</a></td>";
    echo "<td>" . $row["Descripcion"] . "</a></td>";
   
    echo "<td>" . $rowAse["Nombre"] . "</a></td>";
    
    echo "<td>" . $rowSeg["Poliza"] . "</a></td>";
    echo "<td>" . $rowSeg["Inicio"] . "</a></td>";
    echo "<td>" . $rowSeg["Vencimiento"] . "</a></td>";
    
   echo "<td>" . number_format($rowSeg["Prima"], 2, '.', ',') . "</td>";

    
     
   
    echo "<td style='text-align: center;'>";
    echo "<form method='GET' action='seguro_formid.php' style='margin:0; padding:0; border:0; outline:0;'>";
    echo "<input type='hidden' name='idcotfinal' value='" . $row["Id"] . "'>";
    echo "<input type='hidden' name='idcontrato' value='" . $row["Idcontrato"] . "'>";
    echo "<input type='hidden' name='idcliente' value='" . $row["Idcliente"] . "'>";
    echo "<button type='submit' name='action1_button' style='border: none; background: #17a589; cursor: pointer; border-radius: 5px; width: 34px; text-align: center;'><i style='font-size:16px; color:#fff; text-align: center;' class='material-symbols-outlined'>no_crash</i></button>";
    echo "</form></td>"; 

  




    echo "</tr>";

}
echo "</table>";

?>

<br><br><br>

</body>
</html>