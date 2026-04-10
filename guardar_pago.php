<?php
include('conexion.php');

// Recibir datos del formulario
$referencia = mysqli_real_escape_string($conexion, $_POST['referencia']);
$banco = mysqli_real_escape_string($conexion, $_POST['banco_emisor']);
$emisor = mysqli_real_escape_string($conexion, $_POST['emisor']);
$monto = mysqli_real_escape_string($conexion, $_POST['monto']);
$fecha = mysqli_real_escape_string($conexion, $_POST['fecha_pago']);

// 1. Validar que la referencia sea solo números (lo que hablamos antes)
if (!ctype_digit($referencia)) {
    die("Error: La referencia debe contener solo números.");
}

// 2. PREVENCIÓN DE DUPLICADOS: Buscar si la referencia ya existe
$check_query = "SELECT referencia FROM pagos WHERE referencia = '$referencia'";
$check_res = mysqli_query($conexion, $check_query);

if (mysqli_num_rows($check_res) > 0) {
    // Si ya existe, detenemos el proceso
    echo "<script>
    alert('⚠️ Error: Este número de referencia ya fue registrado anteriormente.');
    window.location.href='index.php';
    </script>";
    exit();
}

// 3. Si no existe, procedemos al guardado normal
$query = "INSERT INTO pagos (referencia, banco_emisor, emisor, monto, fecha_pago)
VALUES ('$referencia', '$banco', '$emisor', '$monto', '$fecha')";

if (mysqli_query($conexion, $query)) {
    header("Location: ver_pagos.php");
} else {
    echo "Error al registrar: " . mysqli_error($conexion);
}
?>
