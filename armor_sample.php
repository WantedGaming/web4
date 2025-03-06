<?php
require_once 'includes/db.php';

// Get a few rows from the armor table
$query = "SELECT * FROM armor LIMIT 5";
$armorItems = fetchAll($query);

// Display the results
echo "<pre>";
print_r($armorItems);
echo "</pre>";
?>
