<?php
// Include your database connection file
include('db.php');

// Connect to the database
$conn = Database::connect();

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    
    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ?");
    $stmt->execute(['%' . $query . '%']);
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Return the results as JSON
    echo json_encode($results);
}
?>