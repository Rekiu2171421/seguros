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

        $idcotfinal = filter_var($_POST["idcotfinal"], FILTER_SANITIZE_STRING);
        $idcontrato = filter_var($_POST["idcontrato"], FILTER_SANITIZE_STRING);
        $idseguro = filter_var($_POST["idseguro"], FILTER_SANITIZE_STRING);
        $idcliente = filter_var($_POST["idcliente"], FILTER_SANITIZE_STRING);
        
        $user = filter_var($_POST["username3"], FILTER_SANITIZE_STRING);
        $vigencia = filter_var($_POST["vigencia"], FILTER_SANITIZE_STRING);
        $prima = filter_var($_POST["prima"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $tasaf = filter_var($_POST["tasaf"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $gastosexp = filter_var($_POST["gtosexp"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $monto = filter_var($_POST["monto"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $plazo = filter_var($_POST["plazo"], FILTER_SANITIZE_STRING);
        $udi = filter_var($_POST["udi"], FILTER_SANITIZE_STRING);
        $deddm = filter_var($_POST["deddm"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $dedrt = filter_var($_POST["dedrt"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $adaptacion = filter_var($_POST["adaptacion"], FILTER_SANITIZE_STRING);
        $adapmonto = filter_var($_POST["adapmonto"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $deddma = filter_var($_POST["deddma"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $dedrta = filter_var($_POST["dedrta"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $segfinanciado = filter_var($_POST["segfinanciado"], FILTER_SANITIZE_STRING);
        $tiposeg = filter_var($_POST["tiposeg"], FILTER_SANITIZE_STRING);
        $factor = filter_var($_POST["factor"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $segurom = isset($_POST["segurom"]) ? str_replace(',', '', $_POST["segurom"]) : '';
        $segurom = is_numeric($segurom) ? floatval($segurom) : 0;
        $comentario = filter_var($_POST["comentario"], FILTER_SANITIZE_STRING);
        $facprima = filter_var($_POST["facprima"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $cobertura = filter_var($_POST["cobertura"], FILTER_SANITIZE_STRING);
        
        // DEBUG: Log de valores recibidos
        error_log("DEBUG seguro_formidX2.php - Factor Prima recibido: " . ($_POST["facprima"] ?? 'NULL'));
        error_log("DEBUG seguro_formidX2.php - Factor Prima procesado: " . ($facprima ?? 'NULL'));
        
        // ✅ AGREGAR EL CAMPO FACILIDAD
        $facilidad = filter_var($_POST["facilidad"], FILTER_SANITIZE_STRING);

        $asegurado = $_POST["asegurado"];
        $marca = $_POST["marca"];
        $submarca = $_POST["submarca"];
        $version = $_POST["version"];
        $transmision = $_POST["transmision"];
        $ano = $_POST["ano"];
        
        $aseguradora = $_POST["aseguradora"];
        $broker = $_POST["broker"];
        $poliza = $_POST["poliza"];
        $fpoliza = $_POST["fechapoliza"];
        $fechai = $_POST["fechai"];
        $fechav = $_POST["fechav"];
        $duracion = $_POST["duracion"];
        
        $fechaudi = $_POST["fechaudi"];
        $fechapcliente = $_POST["fechapcliente"];
        
        // ✅ AGREGAR Facilidad AL UPDATE
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
            `Facilidad`=?,
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

        // ✅ AGREGAR UN PARÁMETRO MÁS Y CAMBIAR A 38 's'
        if (!mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssssssssssssss", 
            $vigencia, $prima, $tasaf, $gastosexp, $monto, $plazo, $udi,
            $facprima, $cobertura, $facilidad, $deddm, $dedrt, $adaptacion, $adapmonto,
            $deddma, $dedrta, $segfinanciado, $tiposeg, $factor, $segurom,
            $comentario, $asegurado, $marca, $submarca, $version, $transmision, $ano, $aseguradora, $broker,$poliza,$fpoliza,$fechai,$fechav,$fechaudi,$fechapcliente,$duracion,$user,  $idseguro)) {
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
         header("Location: seguro_principalid.php?idcotfinal=$idcotfinal&idcliente=$idcliente&idcontrato=$idcontrato&mensaje=$mensaje");
        exit();

    } catch (Exception $e) {
        $error = urlencode("Error: " . $e->getMessage());
        header("Location: seguro_principalid.php?idcotfinal=$idcotfinal&idcliente=$idcliente&idcontrato=$idcontrato&error=$error");
        exit();
    }
}
?>
