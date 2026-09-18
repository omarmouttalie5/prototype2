<?php
require_once 'db.php';

$designers = $pdo->query("SELECT * FROM Designer")->fetchAll();
$styles = $pdo->query("SELECT * FROM Season_Style")->fetchAll();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $price = $_POST['price'];
    $designer_id = $_POST['designer_id'];
    $style_id = $_POST['style_id'];

    if (!empty($title) && !empty($price)) {
        $sql = "INSERT INTO Clothing_Item (title, price, designer_id, style_id) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$title, $price, $designer_id, $style_id])) {
            header("Location: index.php");
            exit;
        } else {
            $message = "Error adding product.";
        }
    } else {
        $message = "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Fashion & Apparel Store</h1>
        <a href="index.php" class="btn">Back to Home</a>
    </header>

    <div class="container">
        <div class="form-box">
            <h2>Add New Product</h2>

            <?php if (!empty($message)): ?>
                <p style="color: red; margin-bottom: 1rem;"><?= $message ?></p>
            <?php endif; ?>

            <form action="add_product.php" method="POST">
                <div class="form-group">
                    <label for="title">Title *</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="price">Price ($) *</label>
                    <input type="number" step="0.01" id="price" name="price" required>
                </div>

                <div class="form-group">
                    <label for="designer_id">Designer</label>
                    <select id="designer_id" name="designer_id">
                        <option value="">Select Designer</option>
                        <?php foreach ($designers as $designer): ?>
                            <option value="<?= $designer['designer_id'] ?>">
                                <?= htmlspecialchars($designer['brand_name']) ?> (<?= htmlspecialchars($designer['name']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="style_id">Season / Style</label>
                    <select id="style_id" name="style_id">
                        <option value="">Select Season / Style</option>
                        <?php foreach ($styles as $style): ?>
                            <option value="<?= $style['style_id'] ?>">
                                <?= htmlspecialchars($style['season_name']) ?> - <?= htmlspecialchars($style['category']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn" style="width: 100%; margin-top: 0.5rem;">Save Product</button>
            </form>
        </div>
    </div>

</body>
</html>