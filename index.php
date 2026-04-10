<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <title>Sistema de la Srta. Marne</title>
    <link rel="stylesheet" href="ccs/estilito.css">
</head>
<body>
<?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
<div style="background-color: #D8E2DC; color: #6D6875; padding: 10px; border-radius: 15px; text-align: center; margin-bottom: 20px; border: 1px solid #BDB2FF;">
✨ ¡Pago registrado con éxito, Srta. Marne! ✨
</div>
<?php endif; ?>
<div class="contenedor-sistema">
<div style="text-align: center; margin-top: 20px;">
<img src="img/marneli.png" alt="Logo Marneli" style="max-width: 150px; height: auto; drop-shadow: 0 4px 8px rgba(0,0,0,0.1);">
</div>
    <h2>🌸 Registro de Pagos 🌸</h2>
    <p style="text-align: center;">Bienvenida, <strong>Srta. Marne</strong></p>

    <form action="guardar_pago.php" method="POST">
    <label for="referencia">Número de Referencia (Máx. 12 dígitos):</label>
    <input
    type="text"
    name="referencia"
    id="referencia"
    class="input-pastel"
    placeholder="Ej: 00123456"
    maxlength="12"
    oninput="this.value = this.value.replace(/[^0-9]/g, '');"
    required
    >
        <select name="banco_emisor" id="banco_emisor" class="select-pastel" required>
        <option value="" disabled selected>Selecciona un banco...</option>
        <?php
        $archivo = 'bancos.csv';
        if (file_exists($archivo)) {
            $gestor = fopen($archivo, "r");
            while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                $nombre = trim($datos[0]);
                $codigo = trim($datos[1]);
                // Mostramos "Nombre - Código" en el menú, pero guardamos solo el nombre (o lo que prefieras)
                echo "<option value='$nombre'>$nombre - $codigo</option>";
            }
            fclose($gestor);
        }
        ?>
        </select>
        <label for="emisor">Nombre del Emisor:</label>
        <input type="text" name="emisor" id="emisor" class="input-pastel" placeholder="Ej: Juan Pérez" required>

        <label for="monto">Monto del Pago:</label>
        <input type="number" step="0.01" name="monto" id="monto" class="input-pastel" placeholder="0.00" required>

        <label>Fecha del Pago:</label>
        <input type="date" name="fecha_pago" required>

        <button type="submit">Registrar Pago ✨</button>
            <div style="margin-top: 30px; text-align: center;">
            <a href="ver_pagos.php" class="btn-secundario">Ver todos los pagos realizados</a>
            </div>
    </form>
</div>

</body>
</html>
