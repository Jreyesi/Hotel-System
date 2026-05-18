<?php
/**
 * Script de prueba para el entorno de QA (Quality Assurance)
 * Objetivo: Validar la conexión a la base de datos SQLite y verificar tablas del sistema hotelero.
 */

header('Content-Type: application/json');

// Ruta simulada de la base de datos SQLite del sistema
$dbFile = 'hotel_database.db'; 

$response = [
    "status" => "error",
    "environment" => "QA_Testing",
    "timestamp" => date('Y-m-d H:i:s'),
    "checks" => []
];

try {
    // 1. Verificar si el archivo de base de datos existe
    if (!file_exists($dbFile)) {
        throw new Exception("El archivo de la base de datos '$dbFile' no fue encontrado en el directorio raíz.");
    }
    $response["checks"]["file_exists"] = true;

    // 2. Intentar la conexión mediante PDO
    $pdo = new PDO("sqlite:" . $dbFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $response["checks"]["database_connection"] = true;

    // 3. Verificar si existen tablas clave (ejemplo: 'room' o 'customer')
    $query = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='room';");
    $tableExists = $query->fetch();

    if ($tableExists) {
        $response["status"] = "success";
        $response["checks"]["hotel_tables_structure"] = "valid";
        $response["message"] = "Entorno de QA verificado: Base de datos lista y estructurada correctamente.";
    } else {
        $response["checks"]["hotel_tables_structure"] = "missing_tables";
        $response["message"] = "Conexión lograda, pero la estructura de tablas del hotel no se ha inicializado.";
    }

} catch (Exception $e) {
    $response["status"] = "fail";
    $response["message"] = "Error en el entorno de QA: " . $e->getMessage();
}

// Retornar el resultado en formato JSON para simular una respuesta de API o pipeline
echo json_encode($response, JSON_PRETTY_PRINT);