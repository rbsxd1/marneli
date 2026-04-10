<?php include('conexion.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <title>Pagos Registrados - Marneli</title>
    <link rel="stylesheet" href="ccs/estilito.css">
    <style>
        .contenedor-tarjetas {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .tarjeta-pago {
            background-color: #F8F9FA;
            border-left: 10px solid #BDB2FF; /* Morado pastel */
            border-radius: 15px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        .tarjeta-pago:hover {
            transform: translateY(-5px);
        }
        .tarjeta-pago h3 { color: #5E548E; margin: 0 0 10px 0; }
        .tarjeta-pago p { margin: 5px 0; font-size: 0.9em; color: #6D6875; }
        .banco-tag {
            background: #FFC8DD;
            padding: 2px 8px;
            border-radius: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <h1 style="text-align: center;">🌸 Historial de Pagos 🌸</h1>
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="index.php" style="text-decoration: none; color: #BDB2FF;">← Volver al Formulario</a>
        </div>

        <div class="contenedor-tarjetas">
            <?php
            $query = "SELECT * FROM pagos ORDER BY id DESC"; // Cambia 'id' por tu columna de ID
            $resultado = mysqli_query($conexion, $query);

            while($pago = mysqli_fetch_assoc($resultado)) {
                echo '<div class="tarjeta-pago">';
                echo '<h3>Ref: ' . htmlspecialchars($pago['referencia']) . '</h3>';
                echo '<p><span class="banco-tag">' . htmlspecialchars($pago['banco_emisor']) . '</span></p>';
                echo '<p>📅 Fecha: ' . $pago['fecha_pago'] . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>
