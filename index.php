<?php
require_once 'db.php';

$query = "
    SELECT 
        c.item_id, 
        c.title, 
        c.price, 
        d.name AS designer_name, 
        d.brand_name, 
        s.season_name, 
        s.category 
    FROM Clothing_Item c
    LEFT JOIN Designer d ON c.designer_id = d.designer_id
    LEFT JOIN Season_Style s ON c.style_id = s.style_id
    ORDER BY c.item_id DESC
";

$stmt = $pdo->prepare($query);
$stmt->execute();
$items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fashion Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Fashion & Apparel Store</h1>
        <a href="add_product.php" class="btn">+ Add Product</a>
    </header>

    <div class="container">
        <h2>Products List</h2>

        <?php if (empty($items)): ?>
            <p>No products available.</p>
        <?php else: ?>
            <div class="product-grid">
                <?php foreach ($items as $item): ?>
                    <div class="card">
                        <h3><?= htmlspecialchars($item['title']) ?></h3>
                        <p><strong>Brand:</strong> <?= htmlspecialchars($item['brand_name'] ?? 'N/A') ?></p>
                        <p><strong>Designer:</strong> <?= htmlspecialchars($item['designer_name'] ?? 'N/A') ?></p>
                        
                        <div class="price">$<?= number_format($item['price'], 2) ?></div>

                        <?php if (!empty($item['season_name'])): ?>
                            <span class="tag">
                                <?= htmlspecialchars($item['season_name']) ?> (<?= htmlspecialchars($item['category']) ?>)
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>