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
   
   /* Estilos para el sistema de gestión de documentos */
   .doc-section {
       margin-top: 20px;
       border: 1px solid #ddd;
       border-radius: 5px;
       overflow: hidden;
   }
   
   .doc-section-header {
       background-color: #dc3545;
       color: white;
       padding: 8px 15px;
       font-size: 14px;
       font-weight: bold;
   }
   
   .doc-table {
       width: 100%;
       border-collapse: collapse;
   }
   
   .doc-table th {
       background-color: #f2f2f2;
       padding: 8px;
       text-align: left;
       font-size: 12px;
       border-bottom: 1px solid #ddd;
   }
   
   .doc-table td {
       padding: 8px;
       font-size: 12px;
       border-bottom: 1px solid #eee;
   }
   
   .doc-btn {
       display: inline-block;
       padding: 4px 8px;
       border-radius: 4px;
       font-size: 11px;
       text-decoration: none;
       cursor: pointer;
       border: none;
       margin-right: 3px;
   }
   
   .doc-btn-view {
       background-color: #007bff;
       color: white;
   }
   
   .doc-btn-duplicate {
       background-color: #6c757d;
       color: white;
   }
   
   .doc-btn-delete {
       background-color: #dc3545;
       color: white;
   }
   
   .doc-btn-history {
       background-color: #17a2b8;
       color: white;
   }
   
   .doc-btn-add {
       background-color: #28a745;
       color: white;
       padding: 6px 10px;
       margin: 10px;
   }
   
   .doc-status {
       display: inline-block;
       padding: 2px 6px;
       border-radius: 3px;
       font-weight: bold;
   }
   
   .doc-status-yes {
       background-color: #d4edda;
       color: #155724;
   }
   
   .doc-status-no {
       background-color: #f8d7da;
       color: #721c24;
   }
   
   .doc-modal {
       display: none;
       position: fixed;
       z-index: 1000;
       left: 0;
       top: 0;
       width: 100%;
       height: 100%;
       background-color: rgba(0,0,0,0.5);
   }
   
   .doc-modal-content {
       background-color: white;
       margin: 10% auto;
       padding: 20px;
       border-radius: 5px;
       width: 50%;
       max-width: 600px;
       box-shadow: 0 4px 8px rgba(0,0,0,0.1);
   }
   
   .doc-modal-close {
       float: right;
       font-size: 22px;
       font-weight: bold;
       cursor: pointer;
   }
   
   .doc-form-group {
       margin-bottom: 15px;
   }
   
   .doc-form-group label {
       display: block;
       margin-bottom: 5px;
       font-weight: bold;
       font-size: 12px;
   }
   
   .doc-form-control {
       width: 100%;
       padding: 8px;
       font-size: 12px;
       border: 1px solid #ced4da;
       border-radius: 4px;
   }
   
   .doc-readonly {
       opacity: 0.7;
   }
   
   .doc-history-table {
       width: 100%;
       border-collapse: collapse;
       font-size: 12px;
   }
   
   .doc-history-table th,
   .doc-history-table td {
       padding: 6px;
       text-align: left;
       border-bottom: 1px solid #ddd;
   }
   
   .doc-history-table th {
       background-color: #f2f2f2;
   }
   
   /* Estilos para el historial de pólizas */
   .history-toggle {
       background-color: #f8f9fa;
       border: 1px solid #ddd;
       border-radius: 5px;
       padding: 10px 15px;
       margin: 20px 0;
       cursor: pointer;
       font-weight: bold;
       font-size: 14px;
       text-align: center;
       display: flex;
       justify-content: space-between;
       align-items: center;
   }
   
   .history-toggle:hover {
       background-color: #e9ecef;
   }
   
   .history-content {
       display: none;
       border: 1px solid #ddd;
       border-radius: 0 0 5px 5px;
       padding: 15px;
       margin-top: -5px;
   }
   
   .history-item {
       padding: 10px;
       border: 1px solid #eee;
       border-radius: 5px;
       margin-bottom: 10px;
       cursor: pointer;
       transition: background-color 0.2s;
   }
   
   .history-item:hover {
       background-color: #f1f8ff;
   }
   
   .history-item.active {
       background-color: #e6f7ff;
       border-color: #91d5ff;
   }
   
   .history-detail {
       margin-top: 20px;
       border-top: 2px solid #ddd;
       padding-top: 20px;
   }
   
   .history-detail h3 {
       color: #1890ff;
       margin-bottom: 15px;
   }
   
   /* Botón duplicar póliza */

.btn-duplicate-policy {
    background-color: #FFBA00; /* Color del logo */
    color: white;
    padding: 8px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 13px;
    margin-left: 10px;
}

.btn-duplicate-policy:hover {
    background-color: #E6A800; /* Versión ligeramente más oscura para hover */
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

  // Primero obtener datos del Seguros para tener acceso a todos los campos necesarios
  $sqlExp = "SELECT * FROM `Seguros` WHERE Idcontrato = ?";
  $stmtExp = $conn->prepare($sqlExp);
  $stmtExp->bind_param("s", $idcontrato);
  $stmtExp->execute();
  $resultExp = $stmtExp->get_result();
  $rowSeg = $resultExp->fetch_assoc();

  if ($rowSeg) {
    $idcot = $rowSeg['Idcot'];
    $idseguro = $rowSeg['Id'];
    
    // Obtener el valor de facilidad directamente de la base de datos
    $facilidad = $rowSeg['Facilidad'];
    // Depuración para verificar el valor real
    // echo "<!-- DEBUG: Facilidad = '$facilidad' -->";
  } else {
    echo "Error: No se encontró el seguro con Idcontrato $idcontrato";
    exit;
  }

  // Ahora obtenemos los datos de CotizacionesFinales usando match por Idcontrato
  $consulta2 = "SELECT * FROM `CotizacionesFinales` WHERE `Idcontrato` = ?";
  $stmt2 = $conn->prepare($consulta2);
  $stmt2->bind_param("s", $idcontrato);
  $stmt2->execute();
  $resultado2 = $stmt2->get_result();
  
  if ($resultado2->num_rows > 0) {
    $datos2 = $resultado2->fetch_assoc();
    // Obtener la descripción correctamente desde CotizacionesFinales
    $descot = $datos2['Descripcion']; 
    $descripcion_seguro = $descot;
      
    $contrato = $datos2['Foliocontrato'];
    $tipo = $datos2['Tipo'];
    $cliente = $datos2['Cliente'];
    $fechafirma = $datos2['Fcon'];
    $fechafin = $datos2['Furenta'];
    $cantidad = $datos2['Cant'];
    $valorsiva = $datos2['Valorsiva']; 
    $tcambio = $datos2['Tipocambio']; 
    $moneda = $datos2['Moneda']; 
    $valorcotizado = $cantidad * $valorsiva * $tcambio;
    $plazo = $datos2['Plazo'];
    $montoseguro = $datos2['Monto'];
  } else {
    // Si no se encuentra por Idcontrato, intentamos con Id
    $consulta2 = "SELECT * FROM `CotizacionesFinales` WHERE `Id` = ?";
    $stmt2 = $conn->prepare($consulta2);
    $stmt2->bind_param("i", $idcotfinal);
    $stmt2->execute();
    $resultado2 = $stmt2->get_result();
    
    if ($resultado2->num_rows > 0) {
      $datos2 = $resultado2->fetch_assoc();
      $descot = $datos2['Descripcion']; 
      $descripcion_seguro = $descot;
      
      $contrato = $datos2['Foliocontrato'];
      $tipo = $datos2['Tipo'];
      $cliente = $datos2['Cliente'];
      $fechafirma = $datos2['Fcon'];
      $fechafin = $datos2['Furenta'];
      $cantidad = $datos2['Cant'];
      $valorsiva = $datos2['Valorsiva']; 
      $tcambio = $datos2['Tipocambio']; 
      $moneda = $datos2['Moneda']; 
      $valorcotizado = $cantidad * $valorsiva * $tcambio;
      $plazo = $datos2['Plazo'];
      $montoseguro = $datos2['Monto'];
    } else {
      // Manejar el caso en que no se encuentra la cotización
      echo "Error: No se encontró la cotización con ID $idcotfinal o Idcontrato $idcontrato";
      exit;
    }
  }

  // Consulta para LeProCli
  $sqlLeProCli = "SELECT * FROM LeProCli WHERE Idcliente = ?";
  $stmtLeProCli = $conn->prepare($sqlLeProCli);
  $stmtLeProCli->bind_param("i", $idc);
  $stmtLeProCli->execute();
  $resultLeProCli = $stmtLeProCli->get_result();
  $rowLep = $resultLeProCli->fetch_assoc();
  
  // Continuar con los datos de Seguros que ya obtuvimos
  if ($rowSeg) { 
    $vigencia = $rowSeg['Vigenciacot']; 
    $prima = isset($rowSeg['Prima']) ? $rowSeg['Prima'] : 0;

    $completo = $rowSeg['Completo'];
    // Ya hemos obtenido $facilidad arriba
    $cov1 = $rowSeg['Cov1'];
    $cov2 = $rowSeg['Cov2'];
    $cov3 = $rowSeg['Cov3'];
    $cov4 = $rowSeg['Cov4'];

    $udi = $rowSeg['Udi'];

    $checked = ($completo === "Si") ? "checked" : "";
    $checked2 = ($facilidad === "Si") ? "checked" : ""; // Esta es la clave para marcar el checkbox

    $tasaf = isset($rowSeg['Tasaf']) ? $rowSeg['Tasaf'] : 0;
    $prima = isset($rowSeg['Prima']) ? $rowSeg['Prima'] : 0;
    $gtosexp = isset($rowSeg['Gtosexp']) ? $rowSeg['Gtosexp'] : 0;

    $monto = isset($rowSeg['Monto']) ? $rowSeg['Monto'] : 0;
    $iva = $monto * 0.16;
    $montot =  $monto + $iva;

    $deddm = isset($rowSeg['Deddm']) ? $rowSeg['Deddm'] : 0;
    $dedrt = isset($rowSeg['Dedrt']) ? $rowSeg['Dedrt'] : 0;

    $deddma = isset($rowSeg['Deddma']) ? $rowSeg['Deddma'] : 0;
    $dedrta = isset($rowSeg['Dedrta']) ? $rowSeg['Dedrta'] : 0;

    $adaptacion = isset($rowSeg['Adaptacion']) ? $rowSeg['Adaptacion'] : 'No';
    $adapmonto = isset($rowSeg['Adapmonto']) ? $rowSeg['Adapmonto'] : 0;

    $vigencia = $rowSeg['Vigenciacot'];
    $comentario = $rowSeg['Comentario'];

    $fecha = $rowSeg['Fecha'];
    $inicio = $rowSeg['Inicio'];

    // CORRECCIÓN: Convertir facprima a un valor legible si está almacenado en milésimas
    $facprima = isset($rowSeg['Facprima']) ? $rowSeg['Facprima'] : 12;
    
    // SOLO establecer 12 como default si NO hay valor en la base de datos
    if (is_null($facprima) || $facprima === '') {
        $facprima = 12; // Valor por defecto SOLO si no existe
    }
    
    $facprima_display = $facprima; // Este será el valor que se mostrará
    
    $cobertura = isset($rowSeg['Cobertura']) ? $rowSeg['Cobertura'] : '';

    $tiposeguro = $rowSeg['Tiposeguro'];

    // Definir variables faltantes
    $asegurado = isset($rowSeg['Asegurado']) ? $rowSeg['Asegurado'] : '';
    $factor = isset($rowSeg['Factor']) ? $rowSeg['Factor'] : 1.2;

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
    
    // Operaciones de seguro
    $tiposeg = ''; // Inicializa la variable
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

  $consulta3 = "SELECT * FROM Ordencompra WHERE Idcot = ?";
  $stmt3 = $conn->prepare($consulta3);
  $stmt3->bind_param("i", $idcot);
  $stmt3->execute();
  $resultado3 = $stmt3->get_result();
  
  if ($resultado3->num_rows > 0) {
    $datos3 = $resultado3->fetch_assoc();
    $sumaalta = $datos3['Facttotales']; 
    $moneda2 = $datos3['Moneda'];
  }

  $marca = !empty($rowSeg['Marca']) ? $rowSeg['Marca'] : (isset($datos3['Marca']) ? $datos3['Marca'] : '');
  $submarca = !empty($rowSeg['Submarca']) ? $rowSeg['Submarca'] : (isset($datos3['Submarca']) ? $datos3['Submarca'] : '');
  $transmision = !empty($rowSeg['Trasmision']) ? $rowSeg['Trasmision'] : (isset($datos3['Transmision']) ? $datos3['Transmision'] : '');
  $ano = !empty($rowSeg['Ano']) ? $rowSeg['Ano'] : (isset($datos3['Modelo']) ? $datos3['Modelo'] : '');
  $version = !empty($rowSeg['Version']) ? $rowSeg['Version'] : (isset($datos3['Version']) ? $datos3['Version'] : '');
    
}

// Reemplaza la sección donde se maneja la acción 'duplicate_policy' con este código:
if (isset($_POST['action']) && $_POST['action'] === 'duplicate_policy' && isset($_POST['idseguro'])) {
    $id_original = $_POST['idseguro'];
    
    // Obtener los datos de la póliza original
    $sql_get_original = "SELECT * FROM Seguros WHERE Id = ?";
    $stmt_get_original = $conn->prepare($sql_get_original);
    $stmt_get_original->bind_param("i", $id_original);
    $stmt_get_original->execute();
    $result_original = $stmt_get_original->get_result();
    
    if ($result_original->num_rows > 0) {
        $original_policy = $result_original->fetch_assoc();
        
        // Determinar el próximo sufijo para el idcontrato
        $base_idcontrato = $original_policy['Idcontrato'];
        
        // Eliminar cualquier sufijo alfabético existente para obtener el ID base
        $base_idcontrato_clean = preg_replace('/[a-z]$/', '', $base_idcontrato);
        
        // Buscar todos los contratos con este ID base
        $sql_check_suffixes = "SELECT Idcontrato FROM Seguros WHERE Idcontrato LIKE ? ORDER BY Idcontrato ASC";
        $stmt_check_suffixes = $conn->prepare($sql_check_suffixes);
        $pattern = $base_idcontrato_clean . '%';
        $stmt_check_suffixes->bind_param("s", $pattern);
        $stmt_check_suffixes->execute();
        $result_suffixes = $stmt_check_suffixes->get_result();
        
        $existing_contratos = array();
        while ($row = $result_suffixes->fetch_assoc()) {
            $existing_contratos[] = $row['Idcontrato'];
        }
        
        // Determinar el siguiente sufijo (a, b, c, etc.)
        $new_idcontrato = $base_idcontrato_clean;
        $ascii_a = ord('a');
        $i = 0;
        
        // Si el contrato base ya existe sin sufijo, empezar con 'a'
        if (in_array($new_idcontrato, $existing_contratos)) {
            do {
                $new_idcontrato = $base_idcontrato_clean . chr($ascii_a + $i);
                $i++;
            } while (in_array($new_idcontrato, $existing_contratos) && $i < 26); // límite a las 26 letras del alfabeto
        }
        
        // Iniciar transacción
        $conn->begin_transaction();
        
        try {
            // Crear nueva fila en la base de datos con los mismos datos pero Vigente = "No"
            $sql_insert = "INSERT INTO Seguros (";
            $sql_values = " VALUES (";
            $types = "";
            $params = array();
            
            foreach ($original_policy as $key => $value) {
                if ($key !== 'Id') {  // Excluir el ID primario
                    $sql_insert .= $key . ", ";
                    $sql_values .= "?, ";
                    
                    if ($key === 'Idcontrato') {
                        $params[] = $new_idcontrato;
                        $types .= "s";
                    } else if ($key === 'Vigente') {
                        $params[] = "No";  // Cambiar el estado a "No" para la duplicada
                        $types .= "s";
                    } else {
                        $params[] = $value;
                        
                        // Determinar el tipo de dato para bind_param
                        if (is_int($value)) {
                            $types .= "i";
                        } else if (is_numeric($value)) {
                            $types .= "d";
                        } else {
                            $types .= "s";
                        }
                    }
                }
            }
            
            // Eliminar la coma final y cerrar los paréntesis
            $sql_insert = rtrim($sql_insert, ", ") . ")";
            $sql_values = rtrim($sql_values, ", ") . ")";
            $sql_final = $sql_insert . $sql_values;
            
            $stmt_insert = $conn->prepare($sql_final);
            
            // Crear array de referencia para bind_param
            $bind_params = array($types);
            for ($i = 0; $i < count($params); $i++) {
                $bind_params[] = &$params[$i];
            }
            
            call_user_func_array(array($stmt_insert, 'bind_param'), $bind_params);
            $stmt_insert->execute();
            $new_idseguro = $stmt_insert->insert_id;
            
            // Copiar archivos si existen
            $files_to_copy = array(
                'Polizapdf' => $original_policy['Polizapdf'],
                'Endosopdf' => $original_policy['Endosopdf'],
                'Recibopdf' => $original_policy['Recibopdf']
            );
            
            foreach ($files_to_copy as $field => $filename) {
                if (!empty($filename)) {
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $new_filename = 'duplicate_' . uniqid() . '.' . $extension;
                    
                    if (copy('seguros/' . $filename, 'seguros/' . $new_filename)) {
                        $sql_update = "UPDATE Seguros SET $field = ? WHERE Id = ?";
                        $stmt_update = $conn->prepare($sql_update);
                        $stmt_update->bind_param("si", $new_filename, $new_idseguro);
                        $stmt_update->execute();
                    }
                }
            }
            
            // Duplicar documentos extras si existen
            $sql_extras = "SELECT * FROM Documentosextra WHERE Idcontrato = ? AND Tipo = 'Seguros'";
            $stmt_extras = $conn->prepare($sql_extras);
            $stmt_extras->bind_param("s", $base_idcontrato);
            $stmt_extras->execute();
            $result_extras = $stmt_extras->get_result();
            
            while ($extra = $result_extras->fetch_assoc()) {
                if (!empty($extra['Archivo'])) {
                    $extension = pathinfo($extra['Archivo'], PATHINFO_EXTENSION);
                    $new_filename = 'duplicate_' . uniqid() . '.' . $extension;
                    
                    if (copy('Extras/' . $extra['Archivo'], 'Extras/' . $new_filename)) {
                        $sql_insert_extra = "INSERT INTO Documentosextra (Idcontrato, Archivo, Descripcion, Tipo) VALUES (?, ?, ?, 'Seguros')";
                        $stmt_insert_extra = $conn->prepare($sql_insert_extra);
                        $stmt_insert_extra->bind_param("sss", $new_idcontrato, $new_filename, $extra['Descripcion']);
                        $stmt_insert_extra->execute();
                    }
                }
            }
            
            // Confirmar transacción
            $conn->commit();
            
            // Redireccionar a la nueva póliza duplicada (evitando la pantalla en blanco)
            echo "<script>
                alert('Póliza duplicada correctamente con ID: " . $new_idcontrato . "');
                window.location.href = 'seguro_gestion.php?idcliente=" . $idc . "&idcotfinal=" . $idcotfinal . "&idcontrato=" . $new_idcontrato . "';
            </script>";
            exit;
            
        } catch (Exception $e) {
            // Revertir en caso de error
            $conn->rollback();
            echo "<script>
                alert('Error al duplicar la póliza: " . $e->getMessage() . "');
                window.location.href = 'seguro_gestion.php?idcliente=" . $idc . "&idcotfinal=" . $idcotfinal . "&idcontrato=" . $idcontrato . "';
            </script>";
            exit;
        }
    }
}

?>

<br>
<table style="margin-left:50px; width: 95%; border: none;">
<tr><td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;'>
 <h2>Seguro del contrato : <?php echo $idcontrato; ?> 
 <!-- Botón para duplicar póliza -->
 <button onclick="confirmarDuplicarPoliza(<?php echo $idseguro; ?>)" class="btn-duplicate-policy">Duplicar Póliza</button>
 </h2>
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



<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;'>


<button style=" background: #dc3545; margin-top: -50px; border: none; padding: 8px; border-radius: 5px; margin: 4px; color: #fff; cursor: pointer;" onclick="location.href='seguros_principal.php';">Regresar</button>


</td>

</tr>

</table>




<?php  if ($tipo == "Transporte") { ?>
	
<br>
  
    <form action="seguro_formidX2.php" method="POST">
        <input type="hidden" name="idcontrato" value="<?php echo isset($idcontrato) ? $idcontrato : ''; ?>" >
        <input type="hidden" name="idcotfinal" value="<?php echo isset($idcotfinal) ? $idcotfinal : ''; ?>" >
        
       <input type="hidden" name="idseguro" id="idseguro" value="<?php echo isset($idseguro) ? $idseguro : ''; ?>" >
        <input type="hidden" name="idcliente" id="idcliente" value="<?php echo isset($idc) ? $idc : ''; ?>" >
        
      <?php include "charge_user_solo.php"; ?>
  
  <input type="hidden" name="facprima" id="facprima" value="<?php echo isset($facprima) ? $facprima : '12'; ?>">
  <!-- IMPORTANTE: El campo 'cobertura' se envía a seguro_formidX2.php cuando se presiona Guardar -->
  <!-- Asegúrate de que seguro_formidX2.php procese este campo y actualice la tabla Seguros -->
  <input type="hidden" name="cobertura" id="cobertura" value="<?php echo isset($cobertura) ? $cobertura : ''; ?>">
  
  <!-- IMPORTANTE: El campo 'facilidad' también se envía a seguro_formidX2.php cuando se presiona Guardar -->
  <!-- Este campo se actualiza desde los checkboxes de facilidad y debe procesarse en seguro_formidX2.php -->
 
  </table>
  
 
<table style="margin-left:50px; width: 95%; border: none;">
<tr><td colspan="3" style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2; font-size:10px;'>Cliente : <input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $rowLep['Nombre']; ?>" readonly></td>
<td colspan="2" style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Contrato : <input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $contrato; ?>" readonly></td>
</tr>
<tr><td colspan="3" style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2; font-size:10px;'>Descripción : <input style="width:98%; border:none; text-align:left;" type="text" name="descripcion_seguro"  value="<?php echo htmlspecialchars($descripcion_seguro); ?>" readonly></td>
<td colspan="2" style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Tipo de Activo : <input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $datos2['Catalogo']; ?>" readonly></td>
</tr>



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
<td style='border: none; text-align:left;  font-size:10px;'>Facilidad
<input type="checkbox" name="facilidad" id="facilidad" <?php echo $checked2; ?> value="Si" onclick="toggleFacilidad(this)"> 
</td>

<td style='border: none; text-align:left;  font-size:10px;'>Vigencia de Cotización: <input style="width:98%;  text-align:left;" type="date" name="vigencia" id="vigencia" value="<?php echo isset($vigencia) ? $vigencia : ''; ?>">
</td>
      
      
      
<tr>

<td style='border: none; text-align:left;  font-size:10px;'>Prima : <input style="width:98%;  text-align:left;" type="text" name="prima" id="prima" value="<?php echo isset($prima) ? number_format($prima, 2, '.', ',') : '0'; ?>" class="format-number">

</td>
<td style='border: none; text-align:left;  font-size:10px;'>Tasa de Financiamiento : <input style="width:98%;  text-align:left;" type="text" name="tasaf" id="tasaf" value="<?php echo isset($tasaf) ? number_format($tasaf, 2, '.', ',') : ''; ?>" class="format-number">

</td>
<td style='border: none; text-align:left;  font-size:10px;'>Gastos de expedición : <input style="width:98%;  text-align:left;" type="text" name="gtosexp" id="gtosexp" value="<?php echo isset($gtosexp) ? number_format($gtosexp, 2, '.', ',') : ''; ?>" class="format-number"></td>

<td style='border: none; text-align:left;  font-size:10px;'>IVA : <input style="width:98%;  text-align:left;" type="text" step="0.01" name="iva" id="iva" value="<?php echo isset($iva) ? $iva : ''; ?>"></td>


<td style='border: none; text-align:left;  font-size:10px;'>Prima Total : <input type="hidden" name="monto" id="monto" value="<?php echo isset($monto) ? $monto : ''; ?>">
                                                                          <input style="width:98%;  text-align:left;" type="text" name="montot" id="montot" value="<?php echo isset($montot) ? number_format($montot, 2, '.', ',') : ''; ?>"></td>


   </tr>
   
      
<tr>

<td id="campo-facprima-1" style='border: none; text-align:left; font-size:10px; <?php echo $facilidad === "Si" ? "" : "display: none;"; ?>'>
    Factor Prima: 
    <input style="width:98%; text-align:left;" type="text" name="facprima_visible" id="facprima_visible_1" 
           value="<?php echo isset($facprima_display) ? $facprima_display : (isset($facprima) ? $facprima : '12'); ?>" onchange="updateFactorPrima(this)">
</td>

<td style='border: none; text-align:left;  font-size:10px;'>Plazo de arrendamiento meses: <input style="width:98%;  text-align:left;" type="number" step="0.01" name="plazo" id="plazo" value="<?php echo isset($plazo) ? $plazo : ''; ?>"  readonly>

</td>
<td id="campo-udi" style='border: none; text-align:left; font-size:10px; <?php echo $facilidad === "Si" ? "display: none;" : ""; ?>'>UDI :<input style="width:98%; text-align:left;" type="number" step="0.01" name="udi" id="udi" value="<?php echo isset($udi) ? $udi : '0'; ?>">
</td>

<td id="campo-udi2" style='border: none; text-align:left;  font-size:10px; <?php echo $facilidad === "Si" ? "display: none;" : ""; ?>'>Monto UDI : <input style="width:98%;  text-align:left;" type="text" name="udimonto" id="udimonto" value="0" readonly>

</td>

<td style='border: none; text-align:left;  font-size:10px;display:none'>Tipo de Cobertura : <input style="width:98%;  text-align:left;" type="text" name="cobertura" id="cobertura" value="<?php echo isset($cobertura) ? $cobertura : ''; ?>">

</td>




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
<!-- ✅ CORRECCIÓN 2: Cambiar type="number" por type="text" y agregar class="format-number" -->
<td style='border: none; text-align:left;  font-size:10px;'>Factor de Financiamiento: <input style="width:98%;  text-align:left;" type="text" name="factor" id="factor"  value="<?php echo isset($factor) ? $factor : 1.2; ?>" class="format-number"></td>

<td style='border: none; text-align:left;  font-size:10px;'>Monto Mensual a Pagar : <input style="width:98%;  text-align:left;" type="text" name="segurom" id="segurom" value="<?php echo isset($segurom) ? $segurom : 0; ?>" readonly></td>

<td style='border: none; text-align:left;  font-size:10px;'>Monto Mensual a Pagar c/IVA : <input style="width:98%;  text-align:left;" type="text" name="seguromiva" id="seguromiva" readonly></td>



   </tr>       
   

   
   
   
   
   <tr>
    <!-- Botones de cobertura que solo actualizan el campo oculto -->
    <td id="campo-cov1" style='border: none; text-align:left;  font-size:10px; <?php echo $facilidad === "Si" ? "" : "display: none;"; ?>'>
        <input type="radio" name="cobertura_tipo" id="cov1" value="Rotura de maquinaria" <?php echo $cobertura === 'Rotura de maquinaria' ? 'checked' : ''; ?> onchange="updateCobertura('Rotura de maquinaria');">
        <label for="cov1">Rotura de maquinaria</label>
    </td>
    
    <td id="campo-cov2" style='border: none; text-align:left;  font-size:10px; <?php echo $facilidad === "Si" ? "" : "display: none;"; ?>'>
        <input type="radio" name="cobertura_tipo" id="cov2" value="Equipo Electrónico" <?php echo $cobertura === 'Equipo Electrónico' ? 'checked' : ''; ?> onchange="updateCobertura('Equipo Electrónico');">
        <label for="cov2">Equipo Electrónico</label>
    </td>
    
    <td id="campo-cov3" style='border: none; text-align:left;  font-size:10px; <?php echo $facilidad === "Si" ? "" : "display: none;"; ?>'>
        <input type="radio" name="cobertura_tipo" id="cov3" value="Contenidos" <?php echo $cobertura === 'Contenidos' ? 'checked' : ''; ?> onchange="updateCobertura('Contenidos');">
        <label for="cov3">Contenidos</label>
    </td>
    
    <td id="campo-cov4" style='border: none; text-align:left;  font-size:10px; <?php echo $facilidad === "Si" ? "" : "display: none;"; ?>'>
        <input type="radio" name="cobertura_tipo" id="cov4" value="Equipo de Contratistas" <?php echo $cobertura === 'Equipo de Contratistas' ? 'checked' : ''; ?> onchange="updateCobertura('Equipo de Contratistas');">
        <label for="cov4">Equipo de Contratistas</label>
    </td>
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
    <option value="ACTIVELEASING" <?= isset($asegurado) && ($asegurado == 'ACTIVE' || $asegurado == 'ACTIVELEASING') ? 'selected' : '' ?>>ACTIVE</option>
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
    echo "<option value='0' $selected>Pendiente / No Aplica</option>";

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
    <input style="width:98%; text-align:left;" type="date" name="fechapoliza" value="<?php 
        echo !empty($policy['Polizafechapago']) ? date('Y-m-d', strtotime($policy['Polizafechapago'])) : ''; 
    ?>">
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
    Duración del Seguro
    <input style="width:98%; text-align:left;" type="text" name="duracion" id="duracion" readonly value="">
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
  
         <form action="seguro_formidX2.php" method="POST">
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

<!-- AGREGAR CAMPOS FALTANTES EN EL SEGUNDO FORMULARIO -->
<input type="hidden" name="facprima" id="facprima2" value="<?php echo isset($facprima) ? $facprima : '12'; ?>">
<input type="hidden" name="cobertura" id="cobertura2" value="<?php echo isset($cobertura) ? $cobertura : ''; ?>">
<input type="hidden" name="facilidad" id="facilidadInput2" value="<?php echo isset($facilidad) ? $facilidad : 'No'; ?>">
  </table>
  
 
<table style="margin-left:50px; width: 95%; border: none;">
<tr><td colspan="3" style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2; font-size:10px;'>Cliente : <input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $rowLep['Nombre']; ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Contrato : <input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $contrato; ?>" readonly></td>
</tr>
<tr><td colspan="3" style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2; font-size:10px;'>Descripción : <input style="width:98%; border:none; text-align:left;" type="text" name="descripcion_seguro"  value="<?php echo htmlspecialchars($descripcion_seguro); ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Tipo de Activo : <input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $tipo; ?>" readonly></td>
</tr>

<tr>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Suma a Asegurar Cotizada del Activo s/IVA<input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="$<?php echo number_format($valorsiva, 2, '.', ','); ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Suma a Asegurar Cotizada del Activo c/IVA<input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="$<?php echo number_format(($valorsiva * 1.16), 2, '.', ','); ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Moneda de Cotización<input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $moneda; ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Tipo de Cambio Arrendamniento<input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $tcambio; ?>" readonly></td>

</tr>

<tr>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Suma a Asegurar Alta del Activo s/IVA (Valor Factura)<input style="width:98%; border:none; text-align:left;" type="text" name="aseguradasiva" id="aseguradasiva" value="$<?php echo number_format($sumaalta, 2, '.', ','); ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Suma a Asegurar Alta del Activo c/IVA (Valor Factura)<input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="$<?php echo number_format(($sumaalta * 1.16), 2, '.', ','); ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'>Moneda de Alta<input style="width:98%; border:none; text-align:left;" type="text" name="cliente"  value="<?php echo $moneda2; ?>" readonly></td>
<td style='border: none; text-align:left; border-bottom: 1px solid #d2d2d2;font-size:10px;'></td>
</tr>

</table>         

<br>

<table style="margin-left:50px; width: 95%; border: none;">
      
<tr>

<td style='border: none; text-align:left;  font-size:10px;'>Facilidad
<input type="checkbox" name="facilidad" id="facilidad" <?php echo $checked2; ?> value="Si" onclick="toggleFacilidad(this)"> 
</td>

<td style='border: none; text-align:left;  font-size:10px;'>Vigencia de Cotización: <input style="width:98%;  text-align:left;" type="date" name="vigencia" id="vigencia" value="<?php echo isset($vigencia) ? $vigencia : ''; ?>">
</td>
      
      
      
<tr>

<td style='border: none; text-align:left;  font-size:10px;'>Prima : <input style="width:98%;  text-align:left;" type="text" name="prima" id="prima" value="<?php echo isset($prima) ? number_format($prima, 2, '.', ',') : ''; ?>" class="format-number">

</td>
<td style='border: none; text-align:left;  font-size:10px;'>Tasa de Financiamiento : <input style="width:98%;  text-align:left;" type="text" name="tasaf" id="tasaf" value="<?php echo isset($tasaf) ? number_format($tasaf, 2, '.', ',') : ''; ?>" class="format-number">

</td>
<td style='border: none; text-align:left;  font-size:10px;'>Gastos de expedición : <input style="width:98%;  text-align:left;" type="text" name="gtosexp" id="gtosexp" value="<?php echo isset($gtosexp) ? number_format($gtosexp, 2, '.', ',') : ''; ?>" class="format-number"></td>

<td style='border: none; text-align:left;  font-size:10px;'>IVA : <input style="width:98%;  text-align:left;" type="text" step="0.01" name="iva" id="iva" value="<?php echo isset($iva) ? $iva : ''; ?>" class="format-number"></td>


<td style='border: none; text-align:left;  font-size:10px;'>Prima Total : <input type="hidden" name="monto" id="monto" value="<?php echo isset($monto) ? $monto : ''; ?>">
                                                                          <input style="width:98%;  text-align:left;" type="text" name="montot" id="montot" value="<?php echo isset($montot) ? number_format($montot, 2, '.', ',') : ''; ?>" class="format-number"></td>


   </tr>
   
      
<tr>

<td id="campo-facprima-1" style='border: none; text-align:left; font-size:10px; <?php echo $facilidad === "Si" ? "" : "display: none;"; ?>'>
    Factor Prima: 
    <input style="width:98%; text-align:left;" type="text" name="facprima_visible" id="facprima_visible_1" 
           value="<?php echo isset($facprima_display) ? $facprima_display : (isset($facprima) ? $facprima : '12'); ?>" onchange="updateFactorPrima(this)">
</td>

<td style='border: none; text-align:left;  font-size:10px;'>Plazo de arrendamiento meses: <input style="width:98%;  text-align:left;" type="number" step="0.01" name="plazo" id="plazo" value="<?php echo isset($plazo) ? $plazo : ''; ?>"  readonly>

</td>
<td id="campo-udi" style='border: none; text-align:left; font-size:10px; <?php echo $facilidad === "Si" ? "display: none;" : ""; ?>'>UDI :<input style="width:98%; text-align:left;" type="number" step="0.01" name="udi" id="udi" value="<?php echo isset($udi) ? $udi : '0'; ?>">
</td>

<td id="campo-udi2" style='border: none; text-align:left;  font-size:10px; <?php echo $facilidad === "Si" ? "display: none;" : ""; ?>'>Monto UDI : <input style="width:98%;  text-align:left;" type="text" name="udimonto" id="udimonto" value="0" readonly>

</td>

<td style='border: none; text-align:left;  font-size:10px;display:none'>Tipo de Cobertura : <input style="width:98%;  text-align:left;" type="text" name="cobertura" id="cobertura" value="<?php echo isset($cobertura) ? $cobertura : ''; ?>">

</td>




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
<!-- ✅ CORRECCIÓN 2: Cambiar type="number" por type="text" y agregar class="format-number" -->
<td style='border: none; text-align:left;  font-size:10px;'>Factor de Financiamiento: <input style="width:98%;  text-align:left;" type="text" name="factor" id="factor"  value="<?php echo isset($factor) ? $factor : 1.2; ?>" class="format-number"></td>

<td style='border: none; text-align:left;  font-size:10px;'>Monto Mensual a Pagar : <input style="width:98%;  text-align:left;" type="text" name="segurom" id="segurom" value="<?php echo isset($segurom) ? $segurom : 0; ?>" readonly></td>

<td style='border: none; text-align:left;  font-size:10px;'>Monto Mensual a Pagar c/IVA : <input style="width:98%;  text-align:left;" type="text" name="seguromiva" id="seguromiva" readonly></td>



   </tr>       
   

   
   
   
   
   <tr>
    <!-- Botones de cobertura que solo actualizan el campo oculto -->
    <td id="campo-cov1" style='border: none; text-align:left;  font-size:10px; <?php echo $facilidad === "Si" ? "" : "display: none;"; ?>'>
        <input type="radio" name="cobertura_tipo" id="cov1" value="Rotura de maquinaria" <?php echo $cobertura === 'Rotura de maquinaria' ? 'checked' : ''; ?> onchange="updateCobertura('Rotura de maquinaria');">
        <label for="cov1">Rotura de maquinaria</label>
    </td>
    
    <td id="campo-cov2" style='border: none; text-align:left;  font-size:10px; <?php echo $facilidad === "Si" ? "" : "display: none;"; ?>'>
        <input type="radio" name="cobertura_tipo" id="cov2" value="Equipo Electrónico" <?php echo $cobertura === 'Equipo Electrónico' ? 'checked' : ''; ?> onchange="updateCobertura('Equipo Electrónico');">
        <label for="cov2">Equipo Electrónico</label>
    </td>
    
    <td id="campo-cov3" style='border: none; text-align:left;  font-size:10px; <?php echo $facilidad === "Si" ? "" : "display: none;"; ?>'>
        <input type="radio" name="cobertura_tipo" id="cov3" value="Contenidos" <?php echo $cobertura === 'Contenidos' ? 'checked' : ''; ?> onchange="updateCobertura('Contenidos');">
        <label for="cov3">Contenidos</label>
    </td>
    
    <td id="campo-cov4" style='border: none; text-align:left;  font-size:10px; <?php echo $facilidad === "Si" ? "" : "display: none;"; ?>'>
        <input type="radio" name="cobertura_tipo" id="cov4" value="Equipo de Contratistas" <?php echo $cobertura === 'Equipo de Contratistas' ? 'checked' : ''; ?> onchange="updateCobertura('Equipo de Contratistas');">
        <label for="cov4">Equipo de Contratistas</label>
    </td>
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
    <option value="ACTIVELEASING" <?= isset($asegurado) && ($asegurado == 'ACTIVE' || $asegurado == 'ACTIVELEASING') ? 'selected' : '' ?>>ACTIVE</option>
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
    echo "<option value='0' $selected>Pendiente / No Aplica</option>";

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
    Duración del Seguro
    <input style="width:98%; text-align:left;" type="text" name="duracion" id="duracion" readonly value="">
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

<!-- Script para manejar los cambios de facilidad y coberturas -->


<script>
// Reemplazar las funciones actuales de facilidad con las nuevas
function toggleCampos() {
    var checkbox = document.getElementById('facilidad');
    var campoGtosexp = document.getElementById('campo-gtosexp');
    
    var campoUdi = document.getElementById('campo-udi');
    var campoUdi2 = document.getElementById('campo-udi2');
    var campoFacprima = document.querySelectorAll('[id^="campo-facprima-"]');
    var primaInput = document.getElementById('prima');
    
    var campoCov1 = document.getElementById('campo-cov1');
    var campoCov2 = document.getElementById('campo-cov2');
    var campoCov3 = document.getElementById('campo-cov3');
    var campoCov4 = document.getElementById('campo-cov4');

    if (checkbox.checked) {
        // Si está checked
        if(campoGtosexp) campoGtosexp.style.display = 'none';
        
        if(campoUdi) campoUdi.style.display = 'none';
        if(campoUdi2) campoUdi2.style.display = 'none';
        
        // Mostrar todos los campos de facprima
        campoFacprima.forEach(function(campo) {
            if(campo) campo.style.display = '';
        });
        
        if(campoCov1) campoCov1.style.display = '';
        if(campoCov2) campoCov2.style.display = '';
        if(campoCov3) campoCov3.style.display = '';
        if(campoCov4) campoCov4.style.display = '';
        
        if(primaInput) primaInput.readOnly = true;
        
        // Actualizar campo oculto
        var facilidadInput = document.getElementById('facilidadInput');
        if(facilidadInput) facilidadInput.value = 'Si';
        
        var facilidadInput2 = document.getElementById('facilidadInput2');
        if(facilidadInput2) facilidadInput2.value = 'Si';
        
        // Calcular prima inicial
        calcularPrima();
    } else {
        // Si NO está checked
        if(campoGtosexp) campoGtosexp.style.display = '';
        if(campoUdi) campoUdi.style.display = '';
        if(campoUdi2) campoUdi2.style.display = '';
        
        // Ocultar todos los campos de facprima
        campoFacprima.forEach(function(campo) {
            if(campo) campo.style.display = 'none';
        });
        
        if(campoCov1) campoCov1.style.display = 'none';
        if(campoCov2) campoCov2.style.display = 'none';
        if(campoCov3) campoCov3.style.display = 'none';
        if(campoCov4) campoCov4.style.display = 'none';
        
        if(primaInput) primaInput.readOnly = false;
        
        // Actualizar campo oculto
        var facilidadInput = document.getElementById('facilidadInput');
        if(facilidadInput) facilidadInput.value = 'No';
        
        var facilidadInput2 = document.getElementById('facilidadInput2');
        if(facilidadInput2) facilidadInput2.value = 'No';
    }
}

// Añadir el evento al checkbox
document.getElementById('facilidad').addEventListener('change', function() {
    var idseguro = <?php echo json_encode($idseguro); ?>;
    var facilidad = this.checked ? 'Si' : 'No';
    
    // Actualizar campos y calcular prima si es necesario
    toggleCampos();
    
    // Enviar el cambio al servidor
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

// Reemplazar las funciones actuales de actualizar facilidad
function toggleFacilidad(checkbox) {
    // Este método será un simple wrapper a toggleCampos para mantener compatibilidad
    toggleCampos();
}

// Función actualizada para calcular prima cuando cambia facprima
function calcularPrima() {
    console.log("Calculando prima...");
    // Obtener el valor de aseguradasiva y limpiarlo
    var aseguradaSivaElement = document.getElementById('aseguradasiva');
    if (!aseguradaSivaElement) {
        console.log("No se encontró el elemento aseguradasiva");
        return;
    }
    
    var aseguradaSivaStr = aseguradaSivaElement.value;
    var aseguradaSiva = parseFloat(aseguradaSivaStr.replace(/[$,]/g, ''));
    
    // Buscar el facprima visible que esté activo
    var facprima = 0;
    var facprimaInputs = [
        document.getElementById('facprima_visible_1'),
        document.getElementById('facprima_visible_2'),
        document.getElementById('facprima_visible_3')
    ];
    
    for (var i = 0; i < facprimaInputs.length; i++) {
        var input = facprimaInputs[i];
        if (input && input.offsetParent !== null) { // Si el input está visible
            facprima = parseFloat(input.value) || 0;
            console.log('Usando facprima:', facprima, 'desde', input.id);
            break;
        }
    }
    
    var plazo = parseFloat(document.getElementById('plazo').value) || 0;
    var primaInput = document.getElementById('prima');
    
    var gtosexpInput = document.getElementById('gtosexp');
    if (gtosexpInput && (!gtosexpInput.value || gtosexpInput.value === '0')) {
        gtosexpInput.value = '0';
    }
    
    // Calcular prima solo si tenemos todos los valores necesarios
    if (facprima > 0 && plazo > 0 && aseguradaSiva > 0) {
        // CORRECCIÓN: Eliminada la división por 1000
        var primaCalculada = aseguradaSiva * facprima * (plazo/12);
        console.log('Prima calculada:', primaCalculada, 'con formula:', aseguradaSiva, '*', facprima, '*', plazo, '/12');
        primaInput.value = primaCalculada.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        
        // Llamar a las funciones de actualización
        if (typeof actualizarValores === 'function') {
            actualizarValores();
        }
        if (typeof calcularSeguro === 'function') {
            calcularSeguro();
        }
    }
}

// Ejecutar al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM cargado, inicializando campos de facilidad');
    toggleCampos();
});
</script>

<!-- Agrega una función para actualizar el campo de cobertura cuando se seleccionan los radio buttons -->
<script>
function updateCobertura(valor) {
    document.getElementById('cobertura').value = valor;
    document.getElementById('cobertura2').value = valor;
}

// También agregar la función updateFactorPrima para manejar los cambios en el factor prima
function updateFactorPrima(input) {
    var valor = input.value;
    
    // Actualizar todos los campos de facprima
    var facprimaMain = document.getElementById('facprima');
    var facprima2 = document.getElementById('facprima2');
    
    if(facprimaMain) facprimaMain.value = valor;
    if(facprima2) facprima2.value = valor;
    
    // Recalcular prima si es necesario
    if(document.getElementById('facilidad').checked) {
        calcularPrima();
    }
}
</script>

<script>
function confirmarEliminacion() {
    return confirm("¿Estás seguro de que deseas eliminar este documento?");
}
</script>

<script>
function calcularUDI() {
    // Obtener valores
    let udi = parseFloat(document.getElementById('udi').value) || 0;
    let prima = parseFloat(document.getElementById('prima').value.replace(/,/g, '')) || 0;
    
    // Cálculo de UDI base: prima * porcentaje UDI
    let resultadoBase = prima * (udi / 100);
    
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
var udiElement = document.getElementById('udi');
if (udiElement) {
    udiElement.addEventListener('input', calcularUDI);
}
</script>

<!-- JavaScript para formateo de números -->
<script>
// Función para formatear números con comas y permitir puntos decimales
function formatearNumero(input) {
    // Remover todo excepto números y puntos
    let valor = input.value.replace(/[^0-9.]/g, '');
    
    // Permitir solo un punto decimal
    let partes = valor.split('.');
    if (partes.length > 2) {
        valor = partes[0] + '.' + partes.slice(1).join('');
    }
    
    // Formatear con comas como separador de miles
    if (partes[0]) {
        partes[0] = partes[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        valor = partes.join('.');
    }
    
    input.value = valor;
}

// Aplicar formato a todos los campos con class="format-number"
document.addEventListener('DOMContentLoaded', function() {
    const formatFields = document.querySelectorAll('.format-number');
    
    formatFields.forEach(function(field) {
        // Evento para formatear mientras escribes
        field.addEventListener('input', function() {
            formatearNumero(this);
        });
        
        // Evento para prevenir que se mueva el cursor al principio
        field.addEventListener('keydown', function(e) {
            // Permitir teclas especiales (backspace, delete, flechas, etc.)
            if ([8, 9, 27, 13, 46, 110, 190].indexOf(e.keyCode) !== -1 ||
                // Permitir Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                (e.keyCode === 65 && e.ctrlKey === true) ||
                (e.keyCode === 67 && e.ctrlKey === true) ||
                (e.keyCode === 86 && e.ctrlKey === true) ||
                (e.keyCode === 88 && e.ctrlKey === true) ||
                // Permitir home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
            }
            // Asegurar que sea un número o punto decimal
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && 
                (e.keyCode < 96 || e.keyCode > 105) && 
                e.keyCode !== 110 && e.keyCode !== 190) {
                e.preventDefault();
            }
        });
        
        // Formatear el valor inicial si existe
        if (field.value) {
            formatearNumero(field);
        }
    });
});
</script>

<script>
function confirmarDuplicarPoliza(idseguro) {
    if (confirm('¿Está seguro de que desea duplicar esta póliza? El estado cambiará a "No".')) {
        // Crear y enviar formulario para duplicar
        var form = document.createElement('form');
        form.method = 'post';
        form.action = window.location.href;
        
        var inputAction = document.createElement('input');
        inputAction.type = 'hidden';
        inputAction.name = 'action';
        inputAction.value = 'duplicate_policy';
        form.appendChild(inputAction);
        
        var inputId = document.createElement('input');
        inputId.type = 'hidden';
        inputId.name = 'idseguro';
        inputId.value = idseguro;
        form.appendChild(inputId);
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

<?php
// Tabla de documentos
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
    echo "<a href='seguros/" . $rowSeg['Polizapdf'] . "' target='_blank'>Ver Documento</a>";
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
    echo "<a href='seguros/" . $rowSeg['Endosopdf'] . "' target='_blank'>Ver Documento</a>";
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
    echo "<a href='seguros/" . $rowSeg['Recibopdf'] . "' target='_blank'>Ver Documento</a>";
    echo "</td>";
    echo "<form method='POST' action='alta_seguroDEL3.php'>";
   echo "<input type='hidden' name='idseguro' value='" . $rowSeg['Id'] . "'>";
    echo "<input type='hidden' name='idc' value='" . $idc . "'>";
    echo "<input type='hidden' name='idcotfinal' value='" . $idcotfinal . "'>";
    echo "<input type='hidden' name='idcontrato' value='" . $idcontrato . "'>";
    echo "<td><button style='width: 90%;background: #dc3545; border: none; padding: 2px; border-radius: 5px; margin: 4px; color: #fff; cursor:pointer;' type='submit' onclick='return confirmarEliminacion()'>Eliminar</button></td>";
    echo "</form>";
}


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

<!-- Sección para historial de pólizas duplicadas -->
<div style="margin-left:50px; width: 95%; margin-top:20px;">
    <div class="history-toggle" onclick="toggleHistorial()">
        <span>Historial de Pólizas</span>
        <span id="history-indicator">▼</span>
    </div>
    <div id="history-content" class="history-content">
        <?php
        // Obtener todas las pólizas relacionadas con este contrato base (sin sufijo)
        $base_idcontrato = preg_replace('/[a-z]$/', '', $idcontrato); // Elimina cualquier sufijo alfabético
        $sql_related = "SELECT * FROM Seguros WHERE Idcontrato LIKE ? AND Id != ? ORDER BY Id DESC";
        $stmt_related = $conn->prepare($sql_related);
        $pattern = $base_idcontrato . '%';
        $stmt_related->bind_param("si", $pattern, $idseguro);
        $stmt_related->execute();
        $result_related = $stmt_related->get_result();
        
        if ($result_related->num_rows > 0) {
            echo '<div class="history-list">';
            while ($related_policy = $result_related->fetch_assoc()) {
                echo '<div class="history-item" onclick="verPolizaHistorica(' . $related_policy['Id'] . ', \'' . $related_policy['Idcontrato'] . '\')">';
                echo '<strong>Contrato: ' . $related_policy['Idcontrato'] . '</strong> - ';
                echo '<span>Creada el: ' . date('d/m/Y', strtotime($related_policy['Fecha'])) . '</span> - ';
                echo '<span>Estado: ' . ($related_policy['Vigente'] == 'Si' ? '<span style="color: green;">Vigente</span>' : '<span style="color: red;">No vigente</span>') . '</span>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p>No hay pólizas históricas disponibles.</p>';
        }
        ?>
        
        <!-- Sección para mostrar los datos de la póliza histórica seleccionada -->
        <div id="historical-policy-details" style="display: none; margin-top: 20px; border: 2px solid #6c757d; padding: 15px; border-radius: 5px; background-color: #ffffff;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                <h3 id="historical-policy-title" style="margin: 0; color: #6c757d;">Datos de la póliza histórica</h3>
                <button onclick="cerrarPolizaHistorica()" style="background: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;">Cerrar</button>
            </div>
            <div id="historical-policy-content">
                <!-- Aquí se mostrarán los datos de la póliza histórica -->
            </div>
        </div>
    </div>
</div>

<!-- Script para manejar el historial de pólizas -->
<script>
// Script para cargar y mostrar la póliza histórica en la misma página
function verPolizaHistorica(id, idcontrato) {
    // Mostrar indicador de carga
    document.getElementById('historical-policy-details').style.display = 'block';
    document.getElementById('historical-policy-title').innerText = 'Datos de la póliza histórica: ' + idcontrato;
    document.getElementById('historical-policy-content').innerHTML = '<div style="text-align:center; padding:20px;"><i class="material-icons" style="font-size:48px;color:#6c757d;animation:spin 2s linear infinite;">refresh</i><br>Cargando datos de la póliza...</div>';
    
    // Realizar solicitud AJAX para obtener los datos
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'cargar_poliza_historica.php?id=' + id + '&idcontrato=' + encodeURIComponent(idcontrato), true);
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                try {
                    // Verificar primero si hay contenido en la respuesta
                    if (!xhr.responseText.trim()) {
                        throw new Error('La respuesta del servidor está vacía');
                    }
                    
                    // Intentar parsear como JSON
                    var response = JSON.parse(xhr.responseText);
                    
                    if (response.success) {
                        document.getElementById('historical-policy-content').innerHTML = response.html;
                        // Desplazar la página hacia la sección histórica
                        document.getElementById('historical-policy-details').scrollIntoView({behavior: 'smooth'});
                    } else {
                        document.getElementById('historical-policy-content').innerHTML = 
                            '<div style="text-align:center; color:#721c24; background-color:#f8d7da; padding:15px; border-radius:5px;">' + 
                            '<i class="material-icons" style="font-size:36px;">error</i><br>' +
                            '<strong>Error:</strong> ' + (response.message || 'Ocurrió un error desconocido.') + '</div>';
                    }
                } catch (e) {
                    console.error('Error al parsear JSON:', e, 'Respuesta recibida:', xhr.responseText);
                    
                    // Mostrar mensaje de error más descriptivo
                    document.getElementById('historical-policy-content').innerHTML = 
                        '<div style="text-align:center; color:#721c24; background-color:#f8d7da; padding:15px; border-radius:5px;">' +
                        '<i class="material-icons" style="font-size:36px;">error</i><br>' +
                        '<strong>Error al procesar la respuesta:</strong> La respuesta del servidor no tiene el formato esperado.' +
                        '<br><br><button onclick="verDetallesError()" style="background-color:#6c757d; color:white; border:none; padding:5px 10px; border-radius:3px; cursor:pointer;">Ver detalles técnicos</button></div>';
                }
            } else {
                document.getElementById('historical-policy-content').innerHTML = 
                    '<div style="text-align:center; color:#721c24; background-color:#f8d7da; padding:15px; border-radius:5px;">' +
                    '<i class="material-icons" style="font-size:36px;">error</i><br>' +
                    '<strong>Error de comunicación:</strong> El servidor respondió con código ' + xhr.status + '</div>';
            }
        }
    };
    
    xhr.onerror = function() {
        document.getElementById('historical-policy-content').innerHTML = 
            '<div style="text-align:center; color:#721c24; background-color:#f8d7da; padding:15px; border-radius:5px;">' +
            '<i class="material-icons" style="font-size:36px;">error</i><br>' +
            '<strong>Error de red:</strong> No se pudo conectar con el servidor. Verifica tu conexión.</div>';
    };
    
    xhr.send();
}

// Función para mostrar detalles técnicos del error
function verDetallesError() {
    alert('Error al procesar la respuesta del servidor. Esto suele ocurrir cuando el servidor devuelve un error PHP o HTML en lugar del formato JSON esperado. Contacta al administrador del sistema con esta información.');
}

// Función para cerrar la vista de la póliza histórica
function cerrarPolizaHistorica() {
    document.getElementById('historical-policy-details').style.display = 'none';
}

// Actualiza el manejador de eventos para el historial
function toggleHistorial() {
    var content = document.getElementById('history-content');
    var indicator = document.getElementById('history-indicator');
    
    if (content.style.display === 'block') {
        content.style.display = 'none';
        indicator.textContent = '▼';
        // También ocultar la sección de detalles históricos si está abierta
        document.getElementById('historical-policy-details').style.display = 'none';
    } else {
        content.style.display = 'block';
        indicator.textContent = '▲';
    }
}
</script>

<br>
<?php include "expediente_activacion.php"; ?>

</body>
</html>
<?php  } ?>