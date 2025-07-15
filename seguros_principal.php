<?php
// Determinar si es una solicitud AJAX para búsqueda en tiempo real
$esAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
          strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

// Verificar si se está solicitando exportar a Excel
$generarExcel = isset($_POST['generar_excel']) && $_POST['generar_excel'] == 'true';
$exportarPorFechas = isset($_POST['exportar_por_fechas']) && $_POST['exportar_por_fechas'] == 'true';

// Si es una solicitud de Excel, configurar cabeceras antes de cualquier salida
if ($generarExcel || $exportarPorFechas) {
    ob_clean();
    
    // Nombre de archivo diferente si es exportación por fechas
    $nombreArchivo = $exportarPorFechas ? 
        "reporte_seguros_por_fechas_".date('Y-m-d_H-i-s').'.csv' : 
        "reporte_seguros_completo_".date('Y-m-d_H-i-s').'.csv';
        
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="'.$nombreArchivo.'"');
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
    header('Cache-Control: cache, must-revalidate');
    header('Pragma: public');
}

// Si no es una exportación a Excel ni AJAX, incluir el encabezado normal
if (!$generarExcel && !$exportarPorFechas && !$esAjax) {
    include 'user_into_sis.php';
}

// Incluir archivo de conexión
include 'conectar_base.php';

// Función para forzar texto en CSV (evita notación científica) - MODIFICADA PARA SOLUCIONAR PROBLEMA DE COLUMNAS
function formatearParaCSV($valor) {
    // Si es un valor numérico largo (para evitar notación científica)
    if (is_numeric($valor) && strlen((string)$valor) > 10) {
        return "\t" . $valor;  // El tab ya está bien para números
    }
    
    // Si es texto y es largo
    if (is_string($valor) && strlen($valor) > 20) {
        // Añadir un espacio al inicio del texto para forzar formato texto en Excel
        // y ayudar a que no expanda tanto la columna
        return " " . $valor;
    }
    
    return $valor;
}

// Función para limpiar y formatear datos - MODIFICADA PARA MOSTRAR ZEROS
function limpiarDato($valor, $esValorNumerico = false) {
    if (empty($valor) || $valor === null) {
        return $esValorNumerico ? '0' : '';  // Mostrar 0 para valores numéricos
    }
    $valor = str_replace(array("\n", "\r", "\t"), ' ', $valor);
    return trim($valor);
}

// FUNCIÓN ACTUALIZADA: Convertir cualquier formato de fecha a YYYY-MM-DD para SQL
function formatoFechaSQL($fecha) {
    if (empty($fecha)) return '';
    
    // Si ya está en formato YYYY-MM-DD, devolverlo sin cambios
    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
        return $fecha;
    }
    
    // Convertir desde formato DD/MM/YYYY
    $partes = explode('/', $fecha);
    if (count($partes) === 3) {
        return sprintf('%04d-%02d-%02d', $partes[2], $partes[1], $partes[0]);
    }
    
    return $fecha;
}

// FUNCIÓN ACTUALIZADA: Convertir YYYY-MM-DD a formato visual DD/MM/YYYY si fuera necesario
function formatoFechaVisual($fecha) {
    if (empty($fecha)) return '';
    
    // Si está en formato YYYY-MM-DD, convertirlo a DD/MM/YYYY para mostrar
    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
        $partes = explode('-', $fecha);
        return sprintf('%02d/%02d/%04d', $partes[2], $partes[1], $partes[0]);
    }
    
    return $fecha;
}

// Nueva función mejorada para calcular duración en meses entre dos fechas
function calcularDuracionMeses($fechaInicio, $fechaVencimiento) {
    if (empty($fechaInicio) || empty($fechaVencimiento)) {
        return '';
    }
    
    // Verificar y convertir las fechas a formato DateTime para el cálculo
    try {
        // Manejo para formato DD/MM/YYYY
        if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $fechaInicio)) {
            $partesFechaInicio = explode('/', $fechaInicio);
            $fechaInicioObj = new DateTime($partesFechaInicio[2].'-'.$partesFechaInicio[1].'-'.$partesFechaInicio[0]);
        } 
        // Manejo para formato YYYY-MM-DD
        else if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaInicio)) {
            $fechaInicioObj = new DateTime($fechaInicio);
        } else {
            return '';
        }
        
        // Lo mismo para la fecha de vencimiento
        if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $fechaVencimiento)) {
            $partesFechaVenc = explode('/', $fechaVencimiento);
            $fechaVencObj = new DateTime($partesFechaVenc[2].'-'.$partesFechaVenc[1].'-'.$partesFechaVenc[0]);
        } 
        else if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaVencimiento)) {
            $fechaVencObj = new DateTime($fechaVencimiento);
        } else {
            return '';
        }
        
        // Calcular diferencia
        $diferencia = $fechaInicioObj->diff($fechaVencObj);
        $meses = ($diferencia->y * 12) + $diferencia->m;
        
        // Si hay días adicionales, agregar un mes
        if ($diferencia->d > 0) {
            $meses++;
        }
        
        return (string)$meses;
    } catch (Exception $e) {
        return '';
    }
}

// FUNCIÓN ACTUALIZADA: Extraer mes/año de una fecha (compatible con formato YYYY-MM-DD)
function extraerMesAnio($fecha) {
    if (empty($fecha)) return '';
    
    // Formato DD/MM/YYYY
    if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $fecha, $matches)) {
        return $matches[2] . '/' . $matches[3]; // MM/YYYY
    } 
    // Formato YYYY-MM-DD
    else if (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $fecha, $matches)) {
        return $matches[2] . '/' . $matches[1]; // MM/YYYY
    }
    
    return '';
}



// Variables de filtrado que funcionan con GET y POST
$filtroFolio        = isset($_REQUEST['buscar_folio']) ? $_REQUEST['buscar_folio'] : '';
$filtroCliente      = isset($_REQUEST['buscar_cliente']) ? $_REQUEST['buscar_cliente'] : '';
$filtroActivo       = isset($_REQUEST['buscar_activo']) ? $_REQUEST['buscar_activo'] : '';
$filtroAseguradora  = isset($_REQUEST['buscar_aseguradora']) ? $_REQUEST['buscar_aseguradora'] : '';
$filtroPoliza       = isset($_REQUEST['buscar_poliza']) ? $_REQUEST['buscar_poliza'] : '';
$filtroFechaInicio  = isset($_REQUEST['fecha_inicio']) ? $_REQUEST['fecha_inicio'] : '';
$filtroFechaFin     = isset($_REQUEST['fecha_fin']) ? $_REQUEST['fecha_fin'] : '';
$ordenCol           = isset($_REQUEST['orden_col']) ? intval($_REQUEST['orden_col']) : -1;
$ordenDir           = isset($_REQUEST['orden_dir']) ? $_REQUEST['orden_dir'] : 'ASC';

// Paginación que se resetea cuando hay nuevos filtros
$registrosPorPagina = 50;

// Si hay filtros nuevos por POST, resetear a página 1
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$generarExcel && !$exportarPorFechas && !$esAjax) {
    $paginaActual = 1;
} else {
    $paginaActual = isset($_REQUEST['pagina']) ? max(1, intval($_REQUEST['pagina'])) : 1;
}

$offset = ($paginaActual - 1) * $registrosPorPagina;

// Determinar si hay filtros activos
$hayFiltros = !empty($filtroFolio) || !empty($filtroCliente) || !empty($filtroActivo) ||
             !empty($filtroAseguradora) || !empty($filtroPoliza) ||
             !empty($filtroFechaInicio) || !empty($filtroFechaFin);

// RESTAURAR LÓGICA COMPLETA DE EXCEL
if ($generarExcel || $exportarPorFechas) {
    // Crear el output handle
    $output = fopen('php://output', 'w');
    
    // Agregar BOM para UTF-8 (para que Excel reconozca los acentos)
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
    
    // MODIFICADO: Eliminar 'UDI Seguro' y 'Frecuencia Pago Poliza' de los headers
    $headers = array(
        'No. Contrato','Contrato Interno','Nombre Razon','Asegurado','Marca','Submarca','Version','Trasmision','Año',
        'Descripcion','Clasificacion de Activos','Subclasificacion activo','Fecha Firma Arrendamiento','Fecha Fin',
        'Aseguradora','Nombre Broker','No. Poliza','Fecha Pago Poliza','Fecha Inicio','Fecha Vencimiento',
        'Duracion Seguro','Mes/Año','Importe Pagado','Importe Periodo','Prima','Tasa de financiamiento','Gastos Seguro',
        'Monto Seguro','IVA Seguro','Total Seguro','Factor prima','Factor financiamiento','Tipo de financiamiento',
        'UDI %','UDI s/IVA','UDI c/IVA','Fecha Pago UDI','Mes UDI','Año UDI','Fecha Cobro','Importe Cobro',
        'Suma Asegurada','Deducible Danos','Deducible Robo','Suma Asegurada Adaptacion','Deducible Danos Adaptacion',
        'Deducible Robo Adaptacion','Contratado por Active','Comentario Seguro','Comentario Cobro',
        'Poliza Financiada','Fecha de renovación','Tipo de cobertura','Facilidad'
    );
    
    // Escribir las cabeceras
    fputcsv($output, $headers);
    
} else if (!$esAjax) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Seguros</title>
  <link rel="stylesheet" href="global_riesgo.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
  <style>
    body {
      font-family: "Nunito Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      background-color: #fff; margin: 0; padding: 0;
    }
    
    /* Contenedor principal */
    .container {
      width: 95%;
      max-width: 1600px;
      margin: 0 auto;
      padding: 20px 0;
    }
    
    /* ===== FILA SUPERIOR: TÍTULO + BUSCADORES + BOTÓN GENERAR REPORTE ===== */
    .top-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
      flex-wrap: nowrap;
    }
    
    /* Contenedor del título y buscadores */
    .title-and-search {
      display: flex;
      align-items: center;
      flex-grow: 1;
      flex-wrap: nowrap;
    }
    
    /* El título */
    .page-title {
      font-size: 24px;
      margin: 0;
      margin-right: 20px;
      white-space: nowrap;
      font-weight: 600;
      color: #212529; /* Color negro más oscuro como el original */
    }
    
    /* Grupo de buscadores principales */
    .main-search-group {
      display: flex;
      gap: 10px;
      align-items: center;
      flex-wrap: nowrap;
    }
    
    /* Botón generar reporte */
    .report-button-container {
      margin-left: 20px;
    }
    
    /* ===== FILA INFERIOR: BÚSQUEDA POR FECHA + EXPORTAR EXCEL + PAGINACIÓN ===== */
    .bottom-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
      flex-wrap: nowrap;
    }
    
    /* Grupo de búsqueda por fechas */
    .date-search-group {
      display: flex;
      gap: 10px;
      align-items: center;
      flex-wrap: nowrap;
    }
    
    /* Contenedor de paginación */
    .pagination-container {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      gap: 5px;
    }
    
    /* Estilo de cada elemento buscador */
    .search-item {
      display: flex; 
      align-items: center;
      white-space: nowrap;
    }
    
    .search-item label {
      margin-right: 5px;
      font-weight: 600; 
      color: #2e4053; 
      font-size: 13px;
    }
    
    .search-item input {
      padding: 5px 8px; 
      border: 1px solid #ced4da; 
      border-radius: 4px; 
      width: 120px; 
      font-size: 13px;
      height: 20px;
    }
    
    .search-item input:focus {
      border-color: #80bdff;
      outline: 0;
      box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }
    
    .search-item input[type="date"] { 
      width: 140px; 
    }
    
    /* Botones */
    .btn {
      cursor: pointer; 
      border: none; 
      border-radius: 4px; 
      padding: 6px 15px;
      font-size: 13px; 
      font-weight: 500;
      transition: all 0.2s;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 30px; /* Altura reducida */
      white-space: nowrap; /* Evita el salto de línea en textos */
    }
    
    .btn-primary {
      background-color: #3874ff; 
      color: #fff;
    }
    
    .btn-primary:hover { 
      background-color: #2a5db0; 
    }
    
    .btn-success {
      background-color: #28a745; 
      color: #fff;
      width: 150px; /* Ancho fijo para "Generar Reporte" */
    }
    
    .btn-success:hover { 
      background-color: #218838; 
    }
    
    /* TABLA */
    .data-table { 
      width: 100%; 
      border-collapse: collapse;
      box-shadow: 0 0px 3px rgba(0,0,0,0.1);
    }
    
    .data-table th {
      background-color: #f8f9fa;
      border-bottom: 2px solid #dee2e6;
      padding: 10px 8px;
      text-align: left;
      font-size: 13px;
      font-weight: 600;
      color: #495057;
    }
    
    .data-table th button {
      background: none; 
      border: none; 
      cursor: pointer; 
      color: #212529;
      font-weight: 600; 
      font-size: 13px;
      width: 100%; 
      padding: 0;
      text-align: left;
      display: flex;
      align-items: center;
    }
    
    .data-table th button:hover {
      color: #007bff;
    }
    
    .data-table td {
      padding: 8px;
      font-size: 13px;
      border-bottom: 1px solid #e9ecef;
      background-color: #fff;
      vertical-align: middle;
    }
    
    .data-table tbody tr:hover {
      background-color: #f8f9fa;
    }
    
    /* Alineación de columnas específicas */
    .data-table td:nth-child(1),
    .data-table td:nth-child(5),
    .data-table td:nth-child(6),
    .data-table td:nth-child(7) {
      text-align: center;
    }
    .data-table td:nth-child(8),
    .data-table td:nth-child(9) {
      text-align: right;
    }
    .data-table td:nth-child(2),
    .data-table td:nth-child(3),
    .data-table td:nth-child(4),
    .data-table td:nth-child(10),
    .data-table td:nth-child(11) {
      text-align: left;
    }

    /* Paginación con altura reducida */
    .pagination-link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 32px;
      height: 26px; /* Altura reducida */
      padding: 0 8px;
      text-decoration: none;
      border: 1px solid #dee2e6;
      border-radius: 4px;
      margin: 0 2px;
      font-size: 13px;
      font-weight: 400;
      text-align: center;
      transition: all 0.2s;
      background-color: #fff;
      color: #495057;
    }
    
    .pagination-link:hover {
      background-color: #e9ecef;
      border-color: #dee2e6;
      color: #212529;
      text-decoration: none;
      z-index: 1;
    }
    
    .pagination-active {
      background-color: #007bff;
      color: #fff;
      border-color: #007bff;
      font-weight: 500;
    }
    
    .pagination-active:hover {
      background-color: #0069d9;
      color: #fff;
      border-color: #0062cc;
    }

    /* Overlay mejorado */
    .overlay {
      display: none; 
      position: fixed; 
      top: 0; 
      left: 0; 
      width: 100%; 
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5); 
      z-index: 1000; 
      align-items: center; 
      justify-content: center;
      backdrop-filter: blur(3px);
    }
    
    .loading-container {
      background-color: white;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      text-align: center;
      min-width: 250px;
    }
    
    .spinner {
      width: 40px; 
      height: 40px; 
      border: 4px solid #f3f3f3; 
      border-top: 4px solid #3874ff;
      border-radius: 50%; 
      animation: spin 0.8s linear infinite;
      margin: 0 auto 15px;
    }
    
    @keyframes spin { 
      0% { transform: rotate(0deg); } 
      100% { transform: rotate(360deg); } 
    }
    
    .loading-message {
      margin: 0;
      color: #495057;
      font-size: 16px;
    }
  </style>
</head>
<body>

<div class="container">
  <!-- ===== FILA SUPERIOR: TÍTULO + BUSCADORES + BOTÓN GENERAR REPORTE ===== -->
  <div class="top-row">
    <!-- Título y buscadores principales -->
    <div class="title-and-search">
      <h1 class="page-title">Seguros</h1>
      
      <!-- Buscadores principales alineados -->
      <div class="main-search-group">
        <div class="search-item">
          <label for="buscar_folio">Folio:</label>
          <input type="text" id="buscar_folio" value="<?php echo htmlspecialchars($filtroFolio); ?>" oninput="buscarEnTiempoReal()">
        </div>
        
        <div class="search-item">
          <label for="buscar_cliente">Cliente:</label>
          <input type="text" id="buscar_cliente" value="<?php echo htmlspecialchars($filtroCliente); ?>" oninput="buscarEnTiempoReal()">
        </div>
        
        <div class="search-item">
          <label for="buscar_activo">Activo:</label>
          <input type="text" id="buscar_activo" value="<?php echo htmlspecialchars($filtroActivo); ?>" oninput="buscarEnTiempoReal()">
        </div>
        
        <div class="search-item">
          <label for="buscar_aseguradora">Aseguradora:</label>
          <input type="text" id="buscar_aseguradora" value="<?php echo htmlspecialchars($filtroAseguradora); ?>" oninput="buscarEnTiempoReal()">
        </div>
        
        <div class="search-item">
          <label for="buscar_poliza">No. Póliza:</label>
          <input type="text" id="buscar_poliza" value="<?php echo htmlspecialchars($filtroPoliza); ?>" oninput="buscarEnTiempoReal()">
        </div>
      </div>
    </div>
    
    <!-- Botón generar reporte -->
    <div class="report-button-container">
      <button type="button" class="btn btn-success" onclick="generarExcel()">Generar Reporte</button>
    </div>
  </div>
  
  <!-- ===== FILA INFERIOR: BÚSQUEDA POR FECHA + EXPORTAR EXCEL + PAGINACIÓN ===== -->
  <div class="bottom-row">
    <!-- Búsqueda por fechas -->
    <div class="date-search-group">
      <div class="search-item">
        <label for="fecha_inicio">Venc. Desde:</label>
        <input type="date" id="fecha_inicio" 
               value="<?php echo !empty($filtroFechaInicio) ? htmlspecialchars($filtroFechaInicio) : ''; ?>">
      </div>
      
      <div class="search-item">
        <label for="fecha_fin">Venc. Hasta:</label>
        <input type="date" id="fecha_fin" 
               value="<?php echo !empty($filtroFechaFin) ? htmlspecialchars($filtroFechaFin) : ''; ?>">
      </div>
      
      <div class="search-item">
        <button type="button" class="btn btn-primary" onclick="buscarPorFechas()">Buscar</button>
      </div>
      
      <div class="search-item">
        <button type="button" class="btn btn-success" onclick="exportarPorFechas()">Exportar a Excel</button>
      </div>
    </div>
    
    <!-- Paginación -->
    <div class="pagination-container" id="pagination-container">
<?php
        // Calcular total de registros FILTRADOS para paginación correcta
        $sqlCount = "SELECT COUNT(*) AS total FROM CotizacionesFinales CF 
                    INNER JOIN Seguros S ON CF.Idcontrato = S.Idcontrato 
                    LEFT JOIN LeProCli LPC ON CF.Idcliente = LPC.Id 
                    LEFT JOIN Aseguradoras A ON S.Idproveedor = A.Id 
                    WHERE S.vigente = 'Si'";  // MODIFICADO: INNER JOIN y filtro específico

        $whereConditionsCount = [];
        $paramsCount = [];
        $typesCount = '';

        // Aplicar los mismos filtros que en la consulta principal
        if (!empty($filtroFolio)) {
            $whereConditionsCount[] = "CF.Idcontrato LIKE ?";
            $paramsCount[] = "%$filtroFolio%";
            $typesCount .= 's';
        }
        if (!empty($filtroActivo)) {
            $whereConditionsCount[] = "CF.Descripcion LIKE ?";
            $paramsCount[] = "%$filtroActivo%";
            $typesCount .= 's';
        }
        if (!empty($filtroCliente)) {
            $whereConditionsCount[] = "LPC.Nombre LIKE ?";
            $paramsCount[] = "%$filtroCliente%";
            $typesCount .= 's';
        }
        if (!empty($filtroAseguradora)) {
            $whereConditionsCount[] = "A.Nombre LIKE ?";
            $paramsCount[] = "%$filtroAseguradora%";
            $typesCount .= 's';
        }
        if (!empty($filtroPoliza)) {
            $whereConditionsCount[] = "S.Poliza LIKE ?";
            $paramsCount[] = "%$filtroPoliza%";
            $typesCount .= 's';
        }
        
        // MODIFICADO: Filtros de fecha adaptados al formato YYYY-MM-DD
        if (!empty($filtroFechaInicio)) {
            $whereConditionsCount[] = "S.Vencimiento >= ?";
            $paramsCount[] = $filtroFechaInicio;
            $typesCount .= 's';
        }
        if (!empty($filtroFechaFin)) {
            $whereConditionsCount[] = "S.Vencimiento <= ?";
            $paramsCount[] = $filtroFechaFin;
            $typesCount .= 's';
        }

        if (count($whereConditionsCount) > 0) {
            $sqlCount .= " AND " . implode(" AND ", $whereConditionsCount);
        }

        $stmtCount = $conn->prepare($sqlCount);
        if (!empty($typesCount) && !empty($paramsCount)) {
            $stmtCount->bind_param($typesCount, ...$paramsCount);
        }
        $stmtCount->execute();
        $resultCount = $stmtCount->get_result();
        $totalRegistrosFiltrados = $resultCount->fetch_assoc()['total'];
        $totalPaginas = ceil($totalRegistrosFiltrados / $registrosPorPagina);

        if ($totalPaginas > 1) {
          // Flecha atrás
          if ($paginaActual > 1) {
            echo "<a href='javascript:void(0)' onclick='cambiarPagina(" . ($paginaActual - 1) . ")' class='pagination-link'>‹</a>";
          }

          // Determinar qué páginas mostrar
          $mostrarInicio = 1;
          $mostrarFin = min(4, $totalPaginas);
          
          if ($paginaActual > 2) {
            $mostrarInicio = max(1, $paginaActual - 1);
            $mostrarFin = min($totalPaginas, $paginaActual + 1);
          }
          
          // Primera página y elipsis
          if ($mostrarInicio > 1) {
            echo "<a href='javascript:void(0)' onclick='cambiarPagina(1)' class='pagination-link'>1</a>";
            if ($mostrarInicio > 2) {
              echo "<span class='pagination-link' style='border: none; background: none;'>...</span>";
            }
          }

          // Páginas centrales
          for ($i = $mostrarInicio; $i <= $mostrarFin; $i++) {
            $claseActiva = ($i == $paginaActual) ? 'pagination-active' : '';
            echo "<a href='javascript:void(0)' onclick='cambiarPagina($i)' class='pagination-link $claseActiva'>$i</a>";
          }
          
          // Última página y elipsis
          if ($mostrarFin < $totalPaginas) {
            if ($mostrarFin < $totalPaginas - 1) {
              echo "<span class='pagination-link' style='border: none; background: none;'>...</span>";
            }
            echo "<a href='javascript:void(0)' onclick='cambiarPagina($totalPaginas)' class='pagination-link'>$totalPaginas</a>";
          }

          // Flecha adelante
          if ($paginaActual < $totalPaginas) {
            echo "<a href='javascript:void(0)' onclick='cambiarPagina(" . ($paginaActual + 1) . ")' class='pagination-link'>›</a>";
          }
        }
?>
    </div>
  </div>
  
  <!-- Tabla de datos -->
  <table class="data-table">
    <thead>
      <tr>
        <th style='width: 3%;'><button type='button' onclick='ordenarTabla(0)'>Folio</button></th>
        <th style='width: 15%;'><button type='button' onclick='ordenarTabla(1)'>Cliente</button></th>
        <th style='width: 15%;'><button type='button' onclick='ordenarTabla(2)'>Activo</button></th>
        <th style='width: 10%;'><button type='button' onclick='ordenarTabla(3)'>Aseguradora</button></th>
        <th style='width: 7%;'><button type='button' onclick='ordenarTabla(4)'>No. Poliza</button></th>
        <th style='width: 10%;'><button type='button' onclick='ordenarTabla(5)'>Fecha inicio</button></th>
        <th style='width: 10%;'><button type='button' onclick='ordenarTabla(6)'>Fecha vencimiento</button></th>
        <th style='width: 7%;'><button type='button' onclick='ordenarTabla(7)'>Prima</button></th>
        <th style='width: 5%;'><button type='button' onclick='ordenarTabla(8)'>UDI</button></th>
        <th style='width: 10%;'><button type='button' onclick='ordenarTabla(9)'>Contratado por</button></th>
        <th style='width: 10%;'><button type='button' onclick='ordenarTabla(10)'>Comentarios</button></th>
        <th style='width: 5%;'>Edición</th>
      </tr>
    </thead>
    <tbody id="tabla-contenido">
<?php
}

// CONSULTA SQL MEJORADA - MODIFICADA PARA ASEGURAR DATOS CORRECTOS
// Usamos INNER JOIN en lugar de LEFT JOIN con CotizacionesFinales para garantizar datos completos
$sql = "SELECT 
    CF.*,
    CF.Descripcion as CFDescripcion,
    CF.Catalogo as CFCatalogo,
    CF.Tipo as CFTipo,
    CF.Cliente as CFCliente,
    LPC.Nombre as NombreCliente,
    S.*,
    A.Nombre as NombreAseguradora
FROM CotizacionesFinales CF 
INNER JOIN Seguros S ON CF.Idcontrato = S.Idcontrato 
LEFT JOIN LeProCli LPC ON CF.Idcliente = LPC.Id 
LEFT JOIN Aseguradoras A ON S.Idproveedor = A.Id 
WHERE S.vigente = 'Si'";  // Cambiamos a INNER JOIN y filtramos solo por vigente = 'Si'

// FILTROS COMUNES
$params = [];
$types = '';

if (!empty($filtroFolio)) {
    $sql .= " AND CF.Idcontrato LIKE ?";
    $params[] = "%$filtroFolio%";
    $types .= 's';
}

if (!empty($filtroActivo)) {
    $sql .= " AND CF.Descripcion LIKE ?";
    $params[] = "%$filtroActivo%";
    $types .= 's';
}

if (!empty($filtroCliente)) {
    $sql .= " AND LPC.Nombre LIKE ?";
    $params[] = "%$filtroCliente%";
    $types .= 's';
}

if (!empty($filtroAseguradora)) {
    $sql .= " AND A.Nombre LIKE ?";
    $params[] = "%$filtroAseguradora%";
    $types .= 's';
}

if (!empty($filtroPoliza)) {
    $sql .= " AND S.Poliza LIKE ?";
    $params[] = "%$filtroPoliza%";
    $types .= 's';
}

// Filtros de fecha adaptados al formato YYYY-MM-DD
if (!empty($filtroFechaInicio)) {
    $sql .= " AND S.Vencimiento >= ?";
    $params[] = $filtroFechaInicio;
    $types .= 's';
}

if (!empty($filtroFechaFin)) {
    $sql .= " AND S.Vencimiento <= ?";
    $params[] = $filtroFechaFin;
    $types .= 's';
}

// MODIFICADO: Ordenamiento actualizado para trabajar con formato YYYY-MM-DD
$orderBy = "CF.Idcontrato DESC";
if ($ordenCol >= 0) {
    switch ($ordenCol) {
        case 0: $orderBy = "CAST(CF.Idcontrato AS UNSIGNED)"; break;
        case 1: $orderBy = "LPC.Nombre"; break;
        case 2: $orderBy = "CF.Descripcion"; break;
        case 3: $orderBy = "A.Nombre"; break;
        case 4: $orderBy = "CAST(S.Poliza AS UNSIGNED)"; break;
        case 5: $orderBy = "S.Inicio"; break; // Formato de fecha directo
        case 6: $orderBy = "S.Vencimiento"; break; // Formato de fecha directo
        case 7: $orderBy = "CAST(S.Prima AS DECIMAL(10,2))"; break;
        case 8: $orderBy = "CAST(S.Udi AS DECIMAL(10,2))"; break;
        case 9: $orderBy = "S.Contratado"; break;
        case 10: $orderBy = "S.Comentario"; break;
        default: $orderBy = "CAST(CF.Idcontrato AS UNSIGNED) DESC"; break;
    }
    $orderBy .= " " . $ordenDir;
}
$sql .= " ORDER BY $orderBy";

if (!$generarExcel && !$exportarPorFechas) {
    $sql .= " LIMIT $offset, $registrosPorPagina";
}

$stmt = $conn->prepare($sql);
if (!empty($types) && !empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

$registrosMostrados = 0;

while ($row = $result->fetch_assoc()) {
    $registrosMostrados++;
    
    if ($generarExcel || $exportarPorFechas) {
        // LÓGICA DE EXCEL CORREGIDA
        $noContrato = formatearParaCSV(limpiarDato($row["Idcontrato"] ?? '', false));
        $contratoInterno = limpiarDato($row["Foliocontrato"] ?? '', false);
        $nombreRazon = limpiarDato($row["CFCliente"] ?? '', false);
        $asegurado = limpiarDato($row["Asegurado"] ?? '', false);
        $marca = limpiarDato($row["Marca"] ?? '', false);
        $submarca = limpiarDato($row["Submarca"] ?? '', false);
        $version = limpiarDato($row["Version"] ?? '', false);
        $transmision = limpiarDato($row["Trasmision"] ?? '', false);
        $anio = limpiarDato($row["Ano"] ?? '', false);
        
        // CORREGIDO: Usar la descripción de CotizacionesFinales
        $descripcion = limpiarDato($row["CFDescripcion"] ?? '', false);
        
        // CORREGIDO: Asegurarse de tomar Tipo directamente de CotizacionesFinales
        // Verificar el valor antes de asignarlo para depuración
        $tipoOriginal = $row["CFTipo"] ?? '';
        $catalogo = limpiarDato($row["CFCatalogo"] ?? '', false);
        $tipo = limpiarDato($tipoOriginal, false); 
        
        // Si por alguna razón está vacío, intentar usar CF.Tipo directamente
        if (empty($tipo) && isset($row["Tipo"])) {
            $tipo = limpiarDato($row["Tipo"], false);
        }
        
        $clasificacionActivos = $tipo; // Usar el valor de Tipo para clasificación
        $subclasificacionActivo = $catalogo;
        
        // Obtener Fcolo y Furenta de CotizacionesFinales
        $fechaFirmaArrendamiento = limpiarDato($row["Fcolo"] ?? '', false);
        $fechaFin = limpiarDato($row["Furenta"] ?? '', false);
        
        // IMPLEMENTACIÓN PUNTO 2: Confirmamos que usamos la tabla Aseguradoras (A.Nombre)
        // El dato de "aseguradora" se obtiene de la tabla Aseguradoras a través de la relación con S.Idproveedor
        $aseguradora = limpiarDato($row["NombreAseguradora"] ?? '', false);
        
        // IMPLEMENTACIÓN PUNTO 3: Usamos directamente S.Idbroker (sin convertirlo)
        // En lugar de obtener el nombre del broker, usamos directamente el valor textual que está en S.Idbroker
        $nombreBroker = limpiarDato($row["Idbroker"] ?? '', false);
        
        $noPoliza = formatearParaCSV(limpiarDato($row["Poliza"] ?? '', false));
        $fechaPagoPoliza = limpiarDato($row["Polizafechapago"] ?? '', false);
        $fechaInicio = limpiarDato($row["Inicio"] ?? '', false);
        $fechaVencimiento = limpiarDato($row["Vencimiento"] ?? '', false);
        
        // CAMBIO 1: Obtener duración directamente de la base de datos
        $duracionSeguro = limpiarDato($row["Duracion"] ?? '', false);
        
        // CORRECCIÓN 2: Calcular Mes/Año a partir de la fecha de inicio
        $mesAnio = extraerMesAnio($fechaInicio);
        
        // Aplicar zeros a campos numéricos vacíos
        $primaValor = floatval($row["Prima"] ?? 0);
        $tasafValor = floatval($row["Tasaf"] ?? 0);
        $gtosexpValor = floatval($row["Gtosexp"] ?? 0);
        $udiPorcentaje = floatval($row["Udi"] ?? 0);
        
        $importePagado = formatearParaCSV($primaValor > 0 ? $primaValor : 0);
        
        // Calcular montoSeguroValor e IVA para usar en Importe Periodo
        $montoSeguroValor = $primaValor - $tasafValor + $gtosexpValor;
        $ivaSeguroValor = $montoSeguroValor * 0.16;
        
        // MODIFICADO: Calcular importe periodo con la fórmula: Prima + IVA Seguro + Gastos Seguro - Tasa de financiamiento
        $importePeriodoValor = $primaValor + $ivaSeguroValor + $gtosexpValor - $tasafValor;
        $importePeriodo = formatearParaCSV($importePeriodoValor > 0 ? round($importePeriodoValor, 2) : 0);
        
        $prima = formatearParaCSV($primaValor > 0 ? $primaValor : 0);
        $tasaFinanciamiento = limpiarDato($row["Tasaf"] ?? '', true);  // true para mostrar 0
        $gastosSeguro = formatearParaCSV($gtosexpValor > 0 ? $gtosexpValor : 0);
        
        $montoSeguro = formatearParaCSV($montoSeguroValor > 0 ? round($montoSeguroValor, 2) : 0);
        $ivaSeguro = formatearParaCSV($ivaSeguroValor > 0 ? round($ivaSeguroValor, 2) : 0);
        
        $totalSeguroValor = $montoSeguroValor + $ivaSeguroValor;
        $totalSeguro = formatearParaCSV($totalSeguroValor > 0 ? round($totalSeguroValor, 2) : 0);
        
        $factorPrima = limpiarDato($row["Facprima"] ?? '', true);
        $factorFinanciamiento = limpiarDato($row["Factor"] ?? '', true);
        $tipoFinanciamiento = limpiarDato($row["Tiposeguro"] ?? '', false);
        
        // CORREGIDO: Fórmula correcta para UDI sin IVA y con IVA
        // Se calculan pero ya no se incluye UDI Seguro en el reporte
        $udiSeguroSinIVA = ($primaValor > 0 && $udiPorcentaje > 0) ? 
            ($primaValor * ($udiPorcentaje / 100)) : 0;
            
        // Luego calculamos el monto UDI con IVA (multiplica por 1.16)
        $udiSeguroConIVA = $udiSeguroSinIVA * 1.16;
        
        // CORREGIDO: Formatear el porcentaje de UDI para que aparezca como "15%" en lugar de "0.15%"
        $udiPorcentajeTexto = $udiPorcentaje > 0 ? number_format($udiPorcentaje, 0) . '%' : '0%';
        
        // UDI sin IVA muestra el valor SIN IVA
        $udiSinIVA = formatearParaCSV($udiSeguroSinIVA > 0 ? round($udiSeguroSinIVA, 2) : 0);
        
        // UDI con IVA muestra el valor CON IVA
        $udiConIVA = formatearParaCSV($udiSeguroConIVA > 0 ? round($udiSeguroConIVA, 2) : 0);
        
        // CORRECCIÓN 3: Extraer mes y año de la fecha de pago UDI
        $fechaPagoUDI = limpiarDato($row["Fechaudi"] ?? '', false);
        $mesUDI = '';
        $anioUDI = '';
        
        if (!empty($fechaPagoUDI)) {
            // Procesar formato DD/MM/YYYY
            if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $fechaPagoUDI, $matches)) {
                $mesUDI = $matches[2];  // Mes (índice 2)
                $anioUDI = $matches[3];  // Año (índice 3)
            }
            // Procesar formato YYYY-MM-DD
            else if (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $fechaPagoUDI, $matches)) {
                $mesUDI = $matches[2];  // Mes (índice 2)
                $anioUDI = $matches[1];  // Año (índice 1)
            }
        }
        
        $fechaCobro = limpiarDato($row["Fechapcliente"] ?? '', false);
        $importeCobro = formatearParaCSV($primaValor > 0 ? $primaValor : 0);
        
        // CAMPOS CON ZEROS PARA VALORES VACÍOS
        $sumaAsegurada = formatearParaCSV(limpiarDato($row["Sumasegurada"] ?? '', true));
        $deducibleDanos = formatearParaCSV(limpiarDato($row["Deddm"] ?? '', true));
        $deducibleRobo = formatearParaCSV(limpiarDato($row["Dedrt"] ?? '', true));
        $sumaAseguradaAdaptacion = formatearParaCSV(limpiarDato($row["Adapmonto"] ?? '', true));
        $deducibleDanosAdaptacion = formatearParaCSV(limpiarDato($row["Deddma"] ?? '', true));
        $deducibleRoboAdaptacion = formatearParaCSV(limpiarDato($row["Dedrta"] ?? '', true));
        
        $contratadoPorActive = limpiarDato($row["Contratado"] ?? '', false);
        $comentarioSeguro = limpiarDato($row["Comentario"] ?? '', false);
        $comentarioCobro = '';
        $polizaFinanciada = limpiarDato($row["Segfinanciado"] ?? '', false);
        
        $fechaRenovacion = '';
        
        // Cambiar "estructura" por "facilidad" según solicitado
        $facilidad = limpiarDato($row["Facilidad"] ?? '', false);
        
        $tipoCobertura = limpiarDato($row["Cobertura"] ?? '', false);
        
        // MODIFICADO: Eliminadas las columnas 'UDI Seguro' y 'Frecuencia Pago Poliza'
        $rowData = array(
            $noContrato, $contratoInterno, $nombreRazon, $asegurado, $marca, $submarca, $version, $transmision, $anio,
            $descripcion, $clasificacionActivos, $subclasificacionActivo, $fechaFirmaArrendamiento, $fechaFin,
            $aseguradora, $nombreBroker, $noPoliza, $fechaPagoPoliza, $fechaInicio, $fechaVencimiento,
            $duracionSeguro, $mesAnio, $importePagado, $importePeriodo, $prima, $tasaFinanciamiento, $gastosSeguro,
            $montoSeguro, $ivaSeguro, $totalSeguro, $factorPrima, $factorFinanciamiento, $tipoFinanciamiento,
            $udiPorcentajeTexto, $udiSinIVA, $udiConIVA, $fechaPagoUDI, $mesUDI, $anioUDI,
            $fechaCobro, $importeCobro, $sumaAsegurada, $deducibleDanos, $deducibleRobo, $sumaAseguradaAdaptacion,
            $deducibleDanosAdaptacion, $deducibleRoboAdaptacion, $contratadoPorActive,
            $comentarioSeguro, $comentarioCobro, $polizaFinanciada, $fechaRenovacion,
            $tipoCobertura, $facilidad
        );
        
        fputcsv($output, $rowData);
        
    } else {
        // Generar filas para la tabla HTML
        $idcontrato = $row["Idcontrato"];
        $idcliente = $row["Idcliente"];
        $nombre_cliente = $row["CFCliente"] ?? '';
        
        // CORREGIDO: Usar la descripción de CotizacionesFinales 
        $descripcion = $row["CFDescripcion"] ?? '';
        
        // IMPLEMENTACIÓN PUNTO 2: Confirmamos que usamos la tabla Aseguradoras (A.Nombre)
        // El dato de "aseguradora" viene de la tabla Aseguradoras a través de S.Idproveedor
        $aseguradora = $row["NombreAseguradora"] ?? '';
        $poliza = $row["Poliza"] ?? '';
        
        // MODIFICADO: Formatear fechas para visualización si están en formato YYYY-MM-DD
        $inicio = formatoFechaVisual($row["Inicio"] ?? '');
        $vencimiento = formatoFechaVisual($row["Vencimiento"] ?? '');
        
        $prima = $row["Prima"] ?? '';
        $udi = $row["Udi"] ?? '';
        $contratado = $row["Contratado"] ?? '';
        $comentario = $row["Comentario"] ?? '';
        
        echo "<tr>";
        echo "<td>" . htmlspecialchars($idcontrato) . "</td>";
        echo "<td>" . htmlspecialchars($nombre_cliente) . "</td>";
        echo "<td>" . htmlspecialchars($descripcion) . "</td>";
        echo "<td>" . htmlspecialchars($aseguradora) . "</td>";
        echo "<td>" . htmlspecialchars($poliza) . "</td>";
        echo "<td>" . htmlspecialchars($inicio) . "</td>";
        echo "<td>" . htmlspecialchars($vencimiento) . "</td>";
        echo "<td>" . htmlspecialchars($prima) . "</td>"; 
        echo "<td>" . htmlspecialchars($udi) . "</td>";
        echo "<td>" . htmlspecialchars($contratado) . "</td>";
        echo "<td>" . htmlspecialchars($comentario) . "</td>";
         
        echo "<td style='text-align: center;'>";
        echo "<form method='get' action='seguro_principalid.php'>";
        echo "<input type='hidden' name='idcotfinal' value='" . $row["Id"] . "'>";
        echo "<input type='hidden' name='idcontrato' value='" . $idcontrato . "'>";
        echo "<input type='hidden' name='idcliente' value='" . $idcliente . "'>";
        echo "<button type='submit' name='action1_button' style='border: none; background: #17a589; cursor: pointer; border-radius: 5px; width: 34px; text-align: center;'><i style='font-size:16px; color:#fff; text-align: center;' class='material-symbols-outlined'>no_crash</i></button>";
        echo "</form></td>"; 
        echo "</tr>";
    }
}

if ($registrosMostrados == 0 && !$generarExcel && !$exportarPorFechas) {
    echo "<tr><td colspan='12' style='text-align:center; padding:20px;'>No se encontraron registros que coincidan con la búsqueda</td></tr>";
}

if ($generarExcel || $exportarPorFechas) {
    fclose($output);
    exit();
} else if ($esAjax) {
    // Si es una solicitud AJAX, devolver solo las filas de la tabla y la paginación
    exit(); // Ya se ha generado la salida de las filas
} else {
?>
    </tbody>
  </table>
</div>

<!-- iframe para descarga -->
<iframe id="downloadFrame" style="display:none;"></iframe>

<!-- Overlay de carga mejorado -->
<div id="loadingOverlay" class="overlay">
  <div class="loading-container">
    <div class="spinner"></div>
    <p id="loadingMessage" class="loading-message">Cargando datos...</p>
  </div>
</div>

<script>
// Variables para controlar timers
let temporizadorBusqueda = null;
let downloadTimer = null;

// MODIFICADO: Ya no es necesario convertir formatos de fecha en JavaScript
// porque ahora estamos usando directamente el formato YYYY-MM-DD
function buscarEnTiempoReal() {
    if (temporizadorBusqueda) {
        clearTimeout(temporizadorBusqueda);
    }
    
    temporizadorBusqueda = setTimeout(function() {
        // Construir parámetros de búsqueda
        const params = new URLSearchParams();
        params.append('buscar_folio', document.getElementById('buscar_folio').value);
        params.append('buscar_cliente', document.getElementById('buscar_cliente').value);
        params.append('buscar_activo', document.getElementById('buscar_activo').value);
        params.append('buscar_aseguradora', document.getElementById('buscar_aseguradora').value);
        params.append('buscar_poliza', document.getElementById('buscar_poliza').value);
        
        // Mantener los valores de fecha si existen - ahora en formato YYYY-MM-DD
        const fechaInicioHTML = document.getElementById('fecha_inicio').value;
        const fechaFinHTML = document.getElementById('fecha_fin').value;
        
        if (fechaInicioHTML) {
            params.append('fecha_inicio', fechaInicioHTML);
        }
        
        if (fechaFinHTML) {
            params.append('fecha_fin', fechaFinHTML);
        }
        
        // Realizar la búsqueda con AJAX
        buscarAJAX(params.toString());
    }, 500); // Tiempo suficiente para escribir sin interrupciones
}

// Búsqueda por fechas - ahora no necesita convertir formatos
function buscarPorFechas() {
    mostrarCarga('Buscando por fechas...');
    
    const fechaInicioHTML = document.getElementById('fecha_inicio').value;
    const fechaFinHTML = document.getElementById('fecha_fin').value;
    
    // Construir URL con parámetros
    const params = new URLSearchParams();
    params.append('buscar_folio', document.getElementById('buscar_folio').value);
    params.append('buscar_cliente', document.getElementById('buscar_cliente').value);
    params.append('buscar_activo', document.getElementById('buscar_activo').value);
    params.append('buscar_aseguradora', document.getElementById('buscar_aseguradora').value);
    params.append('buscar_poliza', document.getElementById('buscar_poliza').value);
    
    if (fechaInicioHTML) {
        params.append('fecha_inicio', fechaInicioHTML);
    }
    
    if (fechaFinHTML) {
        params.append('fecha_fin', fechaFinHTML);
    }
    
    // Redirigir a la misma página con los parámetros
    window.location.href = '?' + params.toString();
}

// Función para AJAX
function buscarAJAX(parametros) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('tabla-contenido').innerHTML = xhr.responseText;
        }
    };
    
    xhr.send(parametros);
}

// Función para cambiar de página
function cambiarPagina(pagina) {
    mostrarCarga('Cambiando página...');
    
    // Obtener los parámetros actuales de la URL
    const urlParams = new URLSearchParams(window.location.search);
    
    // Actualizar el parámetro de página
    urlParams.set('pagina', pagina);
    
    // Redirigir a la misma página con los nuevos parámetros
    window.location.href = '?' + urlParams.toString();
}

// Ordenamiento de la tabla
function ordenarTabla(columna) {
    mostrarCarga('Ordenando registros...');
    
    // Obtener los parámetros actuales de la URL
    const urlParams = new URLSearchParams(window.location.search);
    
    // Determinar dirección de ordenamiento
    let direccion = 'ASC';
    if (urlParams.get('orden_col') == columna && urlParams.get('orden_dir') == 'ASC') {
        direccion = 'DESC';
    }
    
    // Actualizar parámetros
    urlParams.set('orden_col', columna);
    urlParams.set('orden_dir', direccion);
    
    // Redirigir
    window.location.href = '?' + urlParams.toString();
}

// Generar Excel completo - CORREGIDA
function generarExcel() {
    mostrarCarga('Generando reporte completo...');
    
    const params = new URLSearchParams();
    params.append('generar_excel', 'true');
    params.append('buscar_folio', document.getElementById('buscar_folio').value);
    params.append('buscar_cliente', document.getElementById('buscar_cliente').value);
    params.append('buscar_activo', document.getElementById('buscar_activo').value);
    params.append('buscar_aseguradora', document.getElementById('buscar_aseguradora').value);
    params.append('buscar_poliza', document.getElementById('buscar_poliza').value);
    
    const fechaInicioHTML = document.getElementById('fecha_inicio').value;
    const fechaFinHTML = document.getElementById('fecha_fin').value;
    
    if (fechaInicioHTML) {
        params.append('fecha_inicio', fechaInicioHTML);
    }
    
    if (fechaFinHTML) {
        params.append('fecha_fin', fechaFinHTML);
    }
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '';
    form.style.display = 'none';
    
    for (const [key, value] of params.entries()) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = value;
        form.appendChild(input);
    }
    
        const downloadFrame = document.getElementById('downloadFrame');
    form.target = 'downloadFrame';
    document.body.appendChild(form);
    
    // Mostrar animación de carga
    document.getElementById('loadingMessage').textContent = 'Generando reporte...';
    document.getElementById('loadingOverlay').style.display = 'flex';
    
    // Enviar formulario para descargar
    form.submit();
    document.body.removeChild(form);
    
    // Temporizador para cerrar overlay
    setTimeout(function() {
        document.getElementById('loadingMessage').textContent = 'Descargando Excel...';
        setTimeout(function() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }, 1000);
    }, 1000);
    
    // Temporizador de seguridad para cerrar overlay si algo falla
    downloadTimer = setTimeout(function() {
        document.getElementById('loadingOverlay').style.display = 'none';
    }, 5000);
}

// Exportar a Excel por fechas
function exportarPorFechas() {
    const fechaInicioHTML = document.getElementById('fecha_inicio').value;
    const fechaFinHTML = document.getElementById('fecha_fin').value;
    
    if (!fechaInicioHTML || !fechaFinHTML) {
        alert('Por favor ingresa ambas fechas para exportar.');
        return;
    }
    
    mostrarCarga('Exportando registros por fechas...');
    
    const params = new URLSearchParams();
    params.append('exportar_por_fechas', 'true');
    params.append('buscar_folio', document.getElementById('buscar_folio').value);
    params.append('buscar_cliente', document.getElementById('buscar_cliente').value);
    params.append('buscar_activo', document.getElementById('buscar_activo').value);
    params.append('buscar_aseguradora', document.getElementById('buscar_aseguradora').value);
    params.append('buscar_poliza', document.getElementById('buscar_poliza').value);
    
    params.append('fecha_inicio', fechaInicioHTML);
    params.append('fecha_fin', fechaFinHTML);
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '';
    form.style.display = 'none';
    
    for (const [key, value] of params.entries()) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = value;
        form.appendChild(input);
    }
    
    const downloadFrame = document.getElementById('downloadFrame');
    form.target = 'downloadFrame';
    document.body.appendChild(form);
    
    // Mostrar animación de carga
    document.getElementById('loadingMessage').textContent = 'Exportando por fechas...';
    document.getElementById('loadingOverlay').style.display = 'flex';
    
    // Enviar formulario para descargar
    form.submit();
    document.body.removeChild(form);
    
    // Temporizador para cerrar overlay
    setTimeout(function() {
        document.getElementById('loadingMessage').textContent = 'Descargando Excel...';
        setTimeout(function() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }, 1000);
    }, 1000);
    
    // Temporizador de seguridad
    downloadTimer = setTimeout(function() {
        document.getElementById('loadingOverlay').style.display = 'none';
    }, 5000);
}

// Mostrar overlay de carga con mensaje personalizado
function mostrarCarga(mensaje) {
    document.getElementById('loadingMessage').textContent = mensaje;
    document.getElementById('loadingOverlay').style.display = 'flex';
}

// Limpiar temporizadores al salir de la página
window.addEventListener('beforeunload', function() {
    if (downloadTimer) { clearTimeout(downloadTimer); }
    if (temporizadorBusqueda) { clearTimeout(temporizadorBusqueda); }
});
</script>
</body>
</html>
<?php
}
?>