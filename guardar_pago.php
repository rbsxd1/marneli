<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $referencia = $_POST['referencia'];
    $banco      = $_POST['banco_emisor'];
    $fecha      = $_POST['fecha_pago'];

    // Limpiar datos para evitar inyecciones básicas
    $referencia = mysqli_real_escape_string($conexion, $referencia);
    $banco      = mysqli_real_escape_string($conexion, $banco);

    $sql = "INSERT INTO pagos (referencia, banco_emisor, fecha_pago)
            VALUES ('$referencia', '$banco', '$fecha')";

    if (mysqli_query($conexion, $sql)) {
        // Redirigir con un mensaje de éxito
        header("Location: index.php?status=success");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}
mysqli_close($conexion);
?>
