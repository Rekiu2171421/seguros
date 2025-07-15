<?php
// Incluye el archivo para la conexión a la base de datos
include 'conectar_base.php';

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Validar que la conexión existe
        if (!$conn) {
            throw new Exception("Error de conexión a la base de datos");
        }

        $idcotfinal = filter_var($_POST["idcotfinal"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idcontrato = filter_var($_POST["idcontrato"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idseguro = filter_var($_POST["idseguro"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idcliente = filter_var($_POST["idcliente"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $user = filter_var($_POST["username3"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vigencia = filter_var($_POST["vigencia"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Procesamiento de valores numéricos - elimina comas y convierte a float
        $prima = str_replace(',', '', $_POST["prima"]);
        $prima = is_numeric($prima) ? floatval($prima) : 0;

        $tasaf = str_replace(',', '', $_POST["tasaf"]);
        $tasaf = is_numeric($tasaf) ? floatval($tasaf) : 0;

        $gastosexp = str_replace(',', '', $_POST["gtosexp"]);
        $gastosexp = is_numeric($gastosexp) ? floatval($gastosexp) : 0;

        $monto = str_replace(',', '', $_POST["monto"]);
        $monto = is_numeric($monto) ? floatval($monto) : 0;

        $plazo = filter_var($_POST["plazo"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $udi = filter_var($_POST["udi"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        // Valores decimales adicionales
        $deddm = str_replace(',', '', $_POST["deddm"]);
        $deddm = is_numeric($deddm) ? floatval($deddm) : 0;
        
        $dedrt = str_replace(',', '', $_POST["dedrt"]);
        $dedrt = is_numeric($dedrt) ? floatval($dedrt) : 0;
        
        $adaptacion = filter_var($_POST["adaptacion"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $adapmonto = str_replace(',', '', $_POST["adapmonto"]);
        $adapmonto = is_numeric($adapmonto) ? floatval($adapmonto) : 0;
        
        $deddma = str_replace(',', '', $_POST["deddma"]);
        $deddma = is_numeric($deddma) ? floatval($deddma) : 0;
        
        $dedrta = str_replace(',', '', $_POST["dedrta"]);
        $dedrta = is_numeric($dedrta) ? floatval($dedrta) : 0;
        
        $segfinanciado = filter_var($_POST["segfinanciado"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $tiposeg = filter_var($_POST["tiposeg"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $factor = str_replace(',', '', $_POST["factor"]);
        $factor = is_numeric($factor) ? floatval($factor) : 1.2;
        
        $segurom = str_replace(',', '', $_POST["segurom"]);
        $segurom = is_numeric($segurom) ? floatval($segurom) : 0;
        
        $comentario = filter_var($_POST["comentario"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        // CORRECCIÓN CRÍTICA: Procesar correctamente el factor prima
        $facprima = $_POST["facprima"];
        // Eliminar comas si existen
        $facprima = str_replace(',', '', $facprima);
        
        // Si el valor contiene punto decimal, usarlo directamente
        if (strpos($facprima, '.') !== false) {
            $facprima = floatval($facprima);
        } 
        // Si no tiene punto decimal y es numérico, convertir (ej: 0012 → 0.012)
        else if (is_numeric($facprima)) {
            // Si el valor es mayor que 1, probablemente necesita convertirse a decimal
            if (floatval($facprima) >= 1) {
                $facprima = floatval($facprima) / 1000;
            } else {
                $facprima = floatval($facprima);
            }
        } 
        // Valor por defecto si hay problemas
        else {
            $facprima = 0.012;
        }
        
        $cobertura = filter_var($_POST["cobertura"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $asegurado = filter_var($_POST["asegurado"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $marca = filter_var($_POST["marca"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $submarca = filter_var($_POST["submarca"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $version = filter_var($_POST["version"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $transmision = filter_var($_POST["transmision"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $ano = filter_var($_POST["ano"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $aseguradora = filter_var($_POST["aseguradora"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $broker = filter_var($_POST["broker"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $poliza = filter_var($_POST["poliza"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $fpoliza = filter_var($_POST["fechapoliza"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $fechai = filter_var($_POST["fechai"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $fechav = filter_var($_POST["fechav"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $duracion = filter_var($_POST["duracion"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $fechaudi = filter_var($_POST["fechaudi"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $fechapcliente = filter_var($_POST["fechapcliente"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $sql = "UPDATE `Seguros` SET 
            `Vigenciacot`=?, 
            `Prima`=?, 
            `Tasaf`=?, 
            `Gtosexp`=?, 
            `Monto`=?,  
            `Plazo`=?, 
            `Udi`=?, 
            `Facprima`=?, 
            `Cobertura`=?,
            `Deddm`=?, 
            `Dedrt`=?, 
            `Adaptacion`=?, 
            `Adapmonto`=?, 
            `Deddma`=?, 
            `Dedrta`=?, 
            `Segfinanciado`=?, 
            `Tiposeguro`=?, 
            `Factor`=?, 
            `Segurom`=?, 
            `Comentario`=?,
            `Asegurado`=?,
            `Marca`=?,
            `Submarca`=?,
            `Version`=?,
            `Trasmision`=?,
            `Ano`=?,
            `Idproveedor`=?,
            `Idbroker`=?,
            `Poliza`=?,
            `Polizafechapago`=?,
            `Inicio`=?,
            `Vencimiento`=?,
            `Fechaudi`=?,
            `Fechapcliente`=?,
            `Duracion`=?,
            `Usuario`=? 
            WHERE `Id`=?";

        $stmt = mysqli_prepare($conn, $sql);
        
        if ($stmt === false) {
            throw new Exception("Error en la preparación de la consulta: " . mysqli_error($conn));
        }

        // Vincula los parámetros
        if (!mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssssssssssssssssss", 
            $vigencia, $prima, $tasaf, $gastosexp, $monto, $plazo, $udi,
            $facprima, $cobertura, $deddm, $dedrt, $adaptacion, $adapmonto,
            $deddma, $dedrta, $segfinanciado, $tiposeg, $factor, $segurom,
            $comentario, $asegurado, $marca, $submarca, $version, $transmision, $ano, $aseguradora, $broker,$poliza,$fpoliza,$fechai,$fechav,$fechaudi,$fechapcliente,$duracion,$user, $idseguro)) {
            throw new Exception("Error al vincular parámetros: " . mysqli_error($conn));
        }

        // Ejecuta la consulta
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Error al ejecutar la consulta: " . mysqli_stmt_error($stmt));
        }

        // Verifica si se afectaron filas
        if (mysqli_stmt_affected_rows($stmt) === 0) {
            throw new Exception("No se actualizó ningún registro. Verifica el ID de cotización.");
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        $mensaje = urlencode("Datos Actualizados Correctamente");
        header("Location: seguro_formid.php?idcotfinal=$idcotfinal&idcliente=$idcliente&idcontrato=$idcontrato&mensaje=$mensaje");
        exit();

    } catch (Exception $e) {
        $error = urlencode("Error: " . $e->getMessage());
        header("Location: seguro_formid.php?idcotfinal=$idcotfinal&idcliente=$idcliente&idcontrato=$idcontrato&error=$error");
        exit();
    }
}
?>
