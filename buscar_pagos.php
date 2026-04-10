<?php
include('conexion.php');

$busqueda = isset($_POST['consulta']) ? mysqli_real_escape_string($conexion, $_POST['consulta']) : '';

// Buscamos coincidencia en referencia, emisor o banco
$query = "SELECT * FROM pagos WHERE
          referencia LIKE '%$busqueda%' OR
          emisor LIKE '%$busqueda%' OR
          banco_emisor LIKE '%$busqueda%'
          ORDER BY id DESC";

$resultado = mysqli_query($conexion, $query);

if (mysqli_num_rows($resultado) > 0) {
    while($pago = mysqli_fetch_assoc($resultado)) {
        echo '<div class="tarjeta-pago">';
        echo '<h3>Ref: ' . htmlspecialchars($pago['referencia']) . '</h3>';
        echo '<p>👤 <b>Emisor:</b> ' . htmlspecialchars($pago['emisor']) . '</p>';
        echo '<p>💰 <b>Monto:</b> ' . number_format($pago['monto'], 2) . ' Bs.</p>';
        echo '<p><span class="banco-tag">' . htmlspecialchars($pago['banco_emisor']) . '</span></p>';
        // Busca esta línea en tu archivo ver_pagos.php y cámbiala:
        echo '<p>📅 <b>Fecha/Hora:</b> ' . date("d/m/Y h:i A", strtotime($pago['registro_at'])) . '</p>';
        echo '</div>';
    }
} else {
    echo '<p style="text-align:center; color:#6D6875;">No se encontraron pagos con ese criterio. ✨</p>';
}
?>
