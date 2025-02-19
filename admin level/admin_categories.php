<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    die("Access Denied! Admins only.");
}

$result = $conn->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Categories</title>
</head>
<body>
    <h2>Category Management</h2>

    <form action="add_category.php" method="POST">
        <input type="text" name="name" placeholder="Category Name" required>
        <textarea name="description" placeholder="Description"></textarea>
        <button type="submit">Add Category</button>
    </form>

    <h3>Category List</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>
                    <a href="edit_category.php?id=<?php echo $row['id']; ?>">Edit</a> |
                    <a href="delete_category.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
