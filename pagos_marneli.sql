CREATE TABLE pagos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    referencia VARCHAR(50) NOT NULL,
    banco_emisor VARCHAR(100) NOT NULL,
    fecha_pago DATE NOT NULL,
    monto DECIMAL(10, 2), -- Por si quieres añadir el total
    registro_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
