<?php
include 'connect.php';

$page = isset($_GET['page']) ? $_GET['page'] : 0;
$start = $page * 4;
$end = min(($page + 1) * 4, 6);

$sql = "SELECT id, name, price, description, image FROM present ORDER BY id ASC LIMIT $start, $end";
$result = $conn->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
