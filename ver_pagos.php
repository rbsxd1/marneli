<?php include('conexion.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <style>
    /* Ajustes específicos para móviles */
    @media (max-width: 600px) {
        .contenedor-tarjetas {
            grid-template-columns: 1fr; /* Una tarjeta por fila */
            padding: 10px; /* Menos margen lateral */
        }

        .main-container h1 {
            font-size: 1.5em; /* Título un poco más pequeño */
        }

        /* Ajuste crucial para el bloque morado del Total */
        div[style*="background-color: #BDB2FF;"] {
            position: relative; /* Asegura que no flote de forma extraña */
            float: none; /* Si tenía float, lo quitamos */
            width: 90% !important; /* Que use casi todo el ancho */
            margin: 10px auto 20px auto !important; /* Espacio uniforme */
            display: block; /* Que ocupe su propia línea */
        }

        /* Ajuste para que las tarjetas no sean tan anchas */
        .tarjeta-pago {
            width: 100%;
            max-width: none;
            box-sizing: border-box; /* Incluye padding en el ancho */
        }
    }
    </style>
</head>
<?php
// Consulta para sumar todos los montos
$query_total = "SELECT SUM(monto) as total_general FROM pagos";
$res_total = mysqli_query($conexion, $query_total);
$fila_total = mysqli_fetch_assoc($res_total);
$total = $fila_total['total_general'];
?>

<div style="background-color: #BDB2FF; color: white; padding: 20px; border-radius: 20px; text-align: center; margin: 20px auto; max-width: 400px; box-shadow: 0 4px 15px rgba(189, 178, 255, 0.4);">
<h2 style="margin: 0;">💰 Total Recaudado</h2>
<p style="font-size: 2em; font-weight: bold; margin: 10px 0;">
<?php echo number_format($total, 2); ?> Bs.
</p>
</div>
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
                echo '<p>👤 <b>Emisor:</b> ' . htmlspecialchars($pago['emisor']) . '</p>';
                echo '<p>💰 <b>Monto:</b> ' . number_format($pago['monto'], 2) . ' Bs.</p>';
                echo '<p><span class="banco-tag">' . htmlspecialchars($pago['banco_emisor']) . '</span></p>';
                echo '<p>📅 Fecha: ' . $pago['fecha_pago'] . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>
