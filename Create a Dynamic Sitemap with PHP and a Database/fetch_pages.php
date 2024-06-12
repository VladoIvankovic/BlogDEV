<?php
include 'db_connect.php';

$sql = "SELECT url, last_modified FROM pages";
$result = $conn->query($sql);

$pages = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $pages[] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();
?>