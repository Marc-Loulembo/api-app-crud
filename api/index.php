<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

header('Content-Type: application/json');

require_once './config/database.php';
require_once './controllers/ItemController.php';

$database = new Database();
$db = $database->getConnection();

$request = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if (($pos = strpos($request, '?')) !== false) {
    $request = substr($request, 0, $pos);
}

$basePath = '/api';
$endpoint = str_replace($basePath, '', $request);
$endpoint = trim($endpoint, '/'); 

$parts = explode('/', $endpoint);
$itemId = null;
if(isset($parts[0]) && $parts[0] === 'items') {
    if(isset($parts[1]) && is_numeric($parts[1])) {
        $itemId = $parts[1];
    }
    $controller = new ItemController($db, $requestMethod, $itemId);
    $controller->processRequest();
} else {
    echo json_encode(['error' => 'Endpoint not found']);
}
