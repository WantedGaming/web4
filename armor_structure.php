<?php
require_once 'includes/db.php';

// Get armor table structure
$query = "DESCRIBE armor";
$columns = fetchAll($query);

// Display the results
echo "<pre>";
print_r($columns);
echo "</pre>";
?>
