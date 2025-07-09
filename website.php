<?php
define('APPROOT', dirname(__FILE__));
require APPROOT . DIRECTORY_SEPARATOR . 'header.php';
?>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "leather_shop";
    // Connect to database
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM admin_product WHERE product_category = 'Men' LIMIT 5"; // limit to 6 items
    $result = $conn->query($sql);
    ?>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-text">
            <h1>Explore the Best Leather Collection</h1>
            <p>Discover new arrivals and exclusive collections for men, women, and kids</p>
            <a href="#" class="btn">Shop Now</a>
        </div>
    </section>
    <!-- Featured Sections -->
    <section class="featured">
        <h2>New Arrivals</h2>
        <div class="product-carousel">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product-item">
                    <img src="http://localhost/LUXE%20LEATHER%20UI/leather_shop/img/uploads/<?= htmlspecialchars($row['product_file']) ?>" alt="<?= htmlspecialchars($row['product_name']) ?>">
                    <p><?= htmlspecialchars($row['product_name']) ?></p>
                    <span>₹<?= htmlspecialchars($row['product_price']) ?></span>
                    <!-- <a href="cart 3.html" class="btn">Add to Cart</a> -->
                    <button style="cursor: pointer;" onclick="addToCart(<?= $row['id'] ?>)" class="btn">Add to Cart</button>
                    </div>
            <?php endwhile; ?>
        </div>
    </section>
    <!-- Product Listings Section -->
    <section class="product-listing">
        <h2>Men's Leather Products</h2>
            <div class="filter-section">
            <h4>Filters</h4>
            </div>
            <div class="product-grid">
            <!-- <form id="productForm"> -->
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product-item">
                    <img src="product1.jpg" alt="Leather Jacket">
                    <p><?= htmlspecialchars($row['product_name']) ?></p>
                    <span>₹<?= htmlspecialchars($row['product_price']) ?></span>
                    <!-- <a href="cart 3.html" class="btn">Add to Cart</a> -->
                    <button style="cursor: pointer;" onclick="handleAddToCart('jacket')" class="btn">Add to Cart</button>

                </div>
            <?php endwhile; ?>
        </div>
    </section>
    <!-- Product Detail Page -->
    <section class="product-detail">
        <div class="product-image">
            <img src="product1.jpg" alt="Leather Jacket">
        </div>
        <div class="product-info">
            <h1>Men's Leather Jacket</h1>
            <span>₹1500</span>
            <p>A premium leather jacket with top-notch craftsmanship. Available in all sizes and colors.</p>
            <form id="cartForm">
                <div class="actions">
                    <input type="number" name="mens_leather_jacket" id="mens_leather_jacket" value="1" min="1">
                   
                </div>
            </form>
        </div>
    </section>
    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Leather Shop. All rights reserved.</p>
    </footer>
</body>
</html>