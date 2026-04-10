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
/* Estructura de Cuadrícula Ordenada */
.grid-pagos {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    padding: 20px 0;
}

.tarjeta-pago {
    background-color: #F8F9FA;
    border-left: 10px solid #BDB2FF;
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
    display: inline-block;
    margin-top: 5px;
}

/* Bloque de Total Recaudado */
.total-box {
    background-color: #BDB2FF;
    color: white;
    padding: 20px;
    border-radius: 20px;
    text-align: center;
    margin: 20px auto 30px auto;
    max-width: 400px;
    box-shadow: 0 4px 15px rgba(189, 178, 255, 0.4);
}

.search-container {
    text-align: center;
    margin-bottom: 30px;
}

/* Ajustes para Móviles */
@media (max-width: 600px) {
    .grid-pagos {
        grid-template-columns: 1fr;
        padding: 10px;
    }
    .total-box {
        width: 90%;
    }
}
</style>
</head>
<body>
<?php
// Consulta para el total general
$query_total = "SELECT SUM(monto) as total_general FROM pagos";
$res_total = mysqli_query($conexion, $query_total);
$fila_total = mysqli_fetch_assoc($res_total);
$total = $fila_total['total_general'] ?? 0;
?>

<div class="main-container">
<div style="text-align: center; margin-bottom: 20px;">
<img src="img/marneli.png" alt="Logo Marneli" style="max-width: 150px;">
</div>

<div class="total-box">
<h2 style="margin: 0;">💰 Total Recaudado</h2>
<p style="font-size: 2em; font-weight: bold; margin: 10px 0;">
<?php echo number_format($total, 2); ?> Bs.
</p>
</div>

<h1 style="text-align: center;">🌸 Historial de Pagos 🌸</h1>

<div style="text-align: center; margin-bottom: 20px;">
<a href="index.php" style="text-decoration: none; color: #BDB2FF; font-weight: bold;">← Volver al Formulario</a>
</div>

<div class="search-container">
<input type="text" id="busqueda_input" class="input-pastel" placeholder="🔍 Buscar por referencia, banco o emisor..." style="max-width: 500px; width: 90%;">
</div>

<div id="resultados_busqueda" class="grid-pagos">
</div>
</div>

<script>
function cargarPagos(consulta = '') {
    const formData = new FormData();
    formData.append('consulta', consulta);

    fetch('buscar_pagos.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('resultados_busqueda').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}

// Inicialización
document.addEventListener('DOMContentLoaded', () => cargarPagos());

// Búsqueda en tiempo real
document.getElementById('busqueda_input').addEventListener('keyup', (e) => {
    cargarPagos(e.target.value);
});
</script>
</body>
</html>
