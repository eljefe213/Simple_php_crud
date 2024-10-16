<?php
include 'config.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "User updated successfully.";
        header("Location: read.php");
        exit();
    } else {
        echo "Error updating user.";
    }
} else {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<form method="POST">
    Name: <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
    Email: <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
    <input type="submit" value="Update User">
</form>