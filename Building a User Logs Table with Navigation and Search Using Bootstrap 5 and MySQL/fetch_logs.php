<?php
$servername = "localhost";
$username = "root";
$password = "root"; // your MySQL password
$dbname = "user_logs_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = $_GET['search'] ?? '';
$page = $_GET['page'] ?? 1;
$logsPerPage = 10;
$offset = ($page - 1) * $logsPerPage;

$sqlCount = "SELECT COUNT(*) as count FROM user_logs WHERE user_id LIKE ? OR action LIKE ? OR timestamp LIKE ?";
$stmtCount = $conn->prepare($sqlCount);
$searchParam = "%$search%";
$stmtCount->bind_param("sss", $searchParam, $searchParam, $searchParam);
$stmtCount->execute();
$resultCount = $stmtCount->get_result();
$totalLogs = $resultCount->fetch_assoc()['count'];

$sql = "SELECT * FROM user_logs WHERE user_id LIKE ? OR action LIKE ? OR timestamp LIKE ? LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssii", $searchParam, $searchParam, $searchParam, $logsPerPage, $offset);
$stmt->execute();
$result = $stmt->get_result();

$logs = [];
while($row = $result->fetch_assoc()) {
    $logs[] = $row;
}

$response = [
    'logs' => $logs,
    'totalLogs' => $totalLogs
];

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
