<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <title>Sistema de la Srta. Marne</title>
    <link rel="stylesheet" href="ccs/estilito.css">
</head>
<body>

<div class="contenedor-sistema">
    <h2>🌸 Registro de Pagos 🌸</h2>
    <p style="text-align: center;">Bienvenida, <strong>Srta. Marne</strong></p>

    <form action="guardar_pago.php" method="POST">
        <label>Número de Referencia:</label>
        <input type="text" name="referencia" placeholder="Ej: 00123456" required>

        <label>Banco Emisor:</label>
        <select name="banco_emisor">
            <option value="Banco 1">Banco 1</option>
            <option value="Banco 2">Banco 2</option>
            <option value="Otro">Otro</option>
        </select>

        <label>Fecha del Pago:</label>
        <input type="date" name="fecha_pago" required>

        <button type="submit">Registrar Pago ✨</button>
    </form>
</div>

</body>
</html>
