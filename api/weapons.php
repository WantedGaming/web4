<?php
/**
 * Weapons API endpoint
 * 
 * This file provides a REST API for weapons data
 */

// Set headers for JSON response
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

// Include database connection
require_once '../config/config.php';
require_once '../includes/db.php';

// Get request method
$method = $_SERVER['REQUEST_METHOD'];

// Handle only GET requests
if ($method !== 'GET') {
    http_response_code(405); // Method Not Allowed
    echo json_encode([
        'status' => 'error',
        'message' => 'Method not allowed. Only GET requests are supported.'
    ]);
    exit;
}

// Get query parameters
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$type = isset($_GET['type']) ? (int)$_GET['type'] : null;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

// Validate limit and offset
$limit = max(1, min($limit, 100)); // Between 1 and 100
$offset = max(0, $offset);

try {
    // If ID is provided, get a specific weapon
    if ($id) {
        // In a real implementation, this would fetch from the database
        // For now, return dummy data
        $weapon = [
            'id' => $id,
            'name' => 'Excalibur',
            'type' => 'Sword',
            'damage' => 50,
            'attributes' => ['Holy', 'Legendary'],
            'level_requirement' => 60,
            'description' => 'A legendary sword said to have been wielded by King Arthur.',
            'image_url' => '/images/weapons/excalibur.jpg'
        ];
        
        echo json_encode([
            'status' => 'success',
            'data' => $weapon
        ]);
    }
    // If type is provided, get weapons of a specific type
    else if ($type) {
        // In a real implementation, this would fetch from the database
        // For now, return dummy data
        $weapons = [
            [
                'id' => 1,
                'name' => 'Excalibur',
                'type_id' => 1,
                'damage' => 50,
                'level_requirement' => 60
            ],
            [
                'id' => 5,
                'name' => 'Durandal',
                'type_id' => 1,
                'damage' => 45,
                'level_requirement' => 55
            ],
            [
                'id' => 9,
                'name' => 'Claymore',
                'type_id' => 1,
                'damage' => 40,
                'level_requirement' => 50
            ]
        ];
        
        echo json_encode([
            'status' => 'success',
            'data' => $weapons,
            'meta' => [
                'total' => 156,
                'limit' => $limit,
                'offset' => $offset
            ]
        ]);
    }
    // Otherwise, get all weapons with pagination
    else {
        // In a real implementation, this would fetch from the database
        // For now, return dummy data
        $weapons = [
            [
                'id' => 1,
                'name' => 'Excalibur',
                'type' => 'Sword',
                'damage' => 50,
                'level_requirement' => 60
            ],
            [
                'id' => 2,
                'name' => 'Dragon\'s Breath Bow',
                'type' => 'Bow',
                'damage' => 45,
                'level_requirement' => 55
            ],
            [
                'id' => 3,
                'name' => 'Shadowblade Dagger',
                'type' => 'Dagger',
                'damage' => 35,
                'level_requirement' => 45
            ],
            [
                'id' => 4,
                'name' => 'Staff of the Archmage',
                'type' => 'Staff',
                'damage' => 40,
                'level_requirement' => 50
            ]
        ];
        
        echo json_encode([
            'status' => 'success',
            'data' => $weapons,
            'meta' => [
                'total' => 530,
                'limit' => $limit,
                'offset' => $offset
            ]
        ]);
    }
} catch (Exception $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode([
        'status' => 'error',
        'message' => 'An error occurred while processing your request.',
        'error' => $e->getMessage()
    ]);
}
