<?php
// styles.php

// Set the content type to CSS
header("Content-type: text/css");

// Define PHP variables for dynamic styles
$primaryColor = "#3498db";
$secondaryColor = "#2ecc71";
$fontSize = "16px";

// Set background color based on time of day
$hour = date("H");

if ($hour < 12) {
    $backgroundColor = "#FFFBCC"; // Morning
} elseif ($hour < 18) {
    $backgroundColor = "#FFD700"; // Afternoon
} else {
    $backgroundColor = "#2C3E50"; // Evening
}
?>

body {
    font-size: <?php echo $fontSize; ?>;
    background-color: <?php echo $backgroundColor; ?>;
    color: #fff;
}

a {
    color: <?php echo $secondaryColor; ?>;
    text-decoration: none;
}

a:hover {
    color: <?php echo $primaryColor; ?>;
}
