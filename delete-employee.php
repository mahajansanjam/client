<?php
include 'databaase.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $deleteSql = "DELETE FROM employee_details WHERE id = '$id'";

    if ($conn->query($deleteSql) === TRUE) {
        
        header("Location: employees_detail.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid Request.";
}
?>
