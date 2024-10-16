<?php
include 'config.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    echo "User deleted successfully.";
    header("Location: read.php");
    exit();
} else {
    echo "Error deleting user.";
}
