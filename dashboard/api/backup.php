<?php
include('dbcon.php');

// Get all tables in the database
$tables = array();
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

// Create SQL file
$backup_file = 'backup_' . date("Y-m-d_H-i-s") . '.sql';
$file_handler = fopen($backup_file, 'w');

// Iterate through each table and export its structure and data
foreach ($tables as $table) {
    $result = $conn->query("SHOW CREATE TABLE $table");
    $row = $result->fetch_row();
    fwrite($file_handler, "\n\n" . $row[1] . ";\n\n");

    $result = $conn->query("SELECT * FROM $table");
    while ($row = $result->fetch_assoc()) {
        $insert_query = "INSERT INTO $table VALUES(";
        $first = true;
        foreach ($row as $value) {
            if (!$first) {
                $insert_query .= ', ';
            }
            $insert_query .= "'" . $conn->real_escape_string($value) . "'";
            $first = false;
        }
        $insert_query .= ");\n";
        fwrite($file_handler, $insert_query);
    }
}

fclose($file_handler);

// Send appropriate headers for file download
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($backup_file) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($backup_file));
ob_clean();
flush();
readfile($backup_file);

// Redirect the user after the download
echo "<script>window.location.href = '../setting.php';</script>";

// Close connection
$conn->close();
?>