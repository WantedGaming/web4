<?php
/**
 * Database helper functions
 */
require_once __DIR__ . '/../config/database.php';

/**
 * Execute a query and return all results
 * 
 * @param string $query SQL query
 * @param array $params Parameters for prepared statement
 * @return array Results as associative array
 */
function fetchAll($query, $params = []) {
    $db = getDbConnection();
    $stmt = $db->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

/**
 * Execute a query and return a single row
 * 
 * @param string $query SQL query
 * @param array $params Parameters for prepared statement
 * @return array|false Single row as associative array or false if no results
 */
function fetchOne($query, $params = []) {
    $db = getDbConnection();
    $stmt = $db->prepare($query);
    $stmt->execute($params);
    return $stmt->fetch();
}

/**
 * Execute a query and return a single value
 * 
 * @param string $query SQL query
 * @param array $params Parameters for prepared statement
 * @return mixed|false Single value or false if no results
 */
function fetchValue($query, $params = []) {
    $db = getDbConnection();
    $stmt = $db->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchColumn();
}

/**
 * Execute an insert, update, or delete query
 * 
 * @param string $query SQL query
 * @param array $params Parameters for prepared statement
 * @return int Number of affected rows
 */
function execute($query, $params = []) {
    $db = getDbConnection();
    $stmt = $db->prepare($query);
    $stmt->execute($params);
    return $stmt->rowCount();
}

/**
 * Insert a record and return the last insert ID
 * 
 * @param string $table Table name
 * @param array $data Associative array of column => value pairs
 * @return int Last insert ID
 */
function insert($table, $data) {
    $db = getDbConnection();
    
    $columns = array_keys($data);
    $placeholders = array_map(function($col) { return ":$col"; }, $columns);
    
    $query = "INSERT INTO $table (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $placeholders) . ")";
    
    $stmt = $db->prepare($query);
    
    foreach ($data as $column => $value) {
        $stmt->bindValue(":$column", $value);
    }
    
    $stmt->execute();
    return $db->lastInsertId();
}

/**
 * Update a record
 * 
 * @param string $table Table name
 * @param array $data Associative array of column => value pairs
 * @param string $whereColumn Column name for WHERE clause
 * @param mixed $whereValue Value for WHERE clause
 * @return int Number of affected rows
 */
function update($table, $data, $whereColumn, $whereValue) {
    $db = getDbConnection();
    
    $setParts = [];
    foreach (array_keys($data) as $column) {
        $setParts[] = "$column = :$column";
    }
    
    $query = "UPDATE $table SET " . implode(', ', $setParts) . " WHERE $whereColumn = :whereValue";
    
    $stmt = $db->prepare($query);
    
    foreach ($data as $column => $value) {
        $stmt->bindValue(":$column", $value);
    }
    
    $stmt->bindValue(':whereValue', $whereValue);
    
    $stmt->execute();
    return $stmt->rowCount();
}
