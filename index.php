<?php
header("Content-Type: application/json");

$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (!isset($data["data"])) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing data field"
    ]);
    exit;
}

$decoded = base64_decode($data["data"], true);

if ($decoded === false) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid base64"
    ]);
    exit;
}

$json = json_decode($decoded, true);

if (json_last_error() === JSON_ERROR_NONE) {
    echo json_encode([
        "status" => "success",
        "decoded" => $json
    ]);
} else {
    echo json_encode([
        "status" => "success",
        "decoded" => $decoded
    ]);
}
