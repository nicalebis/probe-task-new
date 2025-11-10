<?php
// Make sure the 'data' folder exists and is writable
$targetDir = __DIR__;

// Read the raw POST body (JSON)
$json = file_get_contents('php://input');
if (!$json) {
  http_response_code(400);
  echo "No data received.";
  exit;
}

// Generate a unique filename based on timestamp
$filename = "probe_data_" . date("Ymd_His") . ".json";
$filePath = $targetDir . "/" . $filename;

// Save it
if (file_put_contents($filePath, $json)) {
  http_response_code(200);
  echo "Data saved as $filename";
} else {
  http_response_code(500);
  echo "Failed to write file.";
}
?>

