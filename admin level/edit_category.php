<?php
include('config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $category = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE categories SET name = ?, description = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $description, $id);
    $stmt->execute();

    header("Location: admin_categories.php");
    exit();
}
?>

<form action="edit_category.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
    <input type="text" name="name" value="<?php echo $category['name']; ?>" required>
    <textarea name="description"><?php echo $category['description']; ?></textarea>
    <button type="submit">Update Category</button>
</form>
