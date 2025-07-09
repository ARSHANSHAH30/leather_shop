<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kids' Leather Products | Leather Shop</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
        }

        /* Header Styles */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #333;
            color: white;
        }

        header .logo {
            font-size: 24px;
            font-weight: bold;
        }

        nav ul {
            list-style: none;
            display: flex;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        .user-actions a {
            color: white;
            margin: 0 10px;
        }

        /* Kids’ Section Layout */
        .kids-section {
            padding: 40px 20px;
        }

        .kids-section h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 36px;
        }

        /* Filter Section */
        .filter-section {
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .filter-section label {
            font-weight: bold;
            margin-right: 5px;
        }

        .filter-section select {
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        /* Product Grid */
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .product-item {
            width: 200px;
            padding: 15px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .product-item img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .product-item h2 {
            font-size: 18px;
            margin: 10px 0;
        }

        .product-item span {
            color: green;
            font-size: 16px;
            display: block;
            margin-bottom: 10px;
        }

        .product-item .btn {
            background-color: #333;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 3px;
            text-decoration: none;
            font-size: 14px;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: 20px;
        }

        .social-links a {
            color: white;
            margin: 0 10px;
        }
    </style>
</head>

<body>
    <!-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Filtering logic
            const categorySelect = document.getElementById("category");
            const priceSelect = document.getElementById("price");
            const productItems = document.querySelectorAll(".product-item");

            function filterProducts() {
                const selectedCategory = categorySelect.value;
                const selectedPrice = priceSelect.value;

                productItems.forEach((item) => {
                    const title = item.querySelector("h2").innerText.toLowerCase();
                    const price = parseInt(item.querySelector("span").innerText.replace(/[₹,]/g, ""));

                    let matchesCategory = selectedCategory === "all" ||
                        (selectedCategory === "jackets" && title.includes("jacket")) ||
                        (selectedCategory === "shoes" && title.includes("shoes")) ||
                        (selectedCategory === "bags" && title.includes("bag")) ||
                        (selectedCategory === "accessories" && (title.includes("belt") || title.includes("accessory")));

                    let matchesPrice = true;
                    if (selectedPrice !== "all") {
                        const [min, max] = selectedPrice.split("-").map(Number);
                        matchesPrice = price >= min * 10 && price <= max * 10;
                    }

                    if (matchesCategory && matchesPrice) {
                        item.style.display = "block";
                    } else {
                        item.style.display = "none";
                    }
                });
            }

            categorySelect.addEventListener("change", filterProducts);
            priceSelect.addEventListener("change", filterProducts);
        });
    </script> -->


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
    $sql = "SELECT * FROM admin_product WHERE product_category = 'Kids' LIMIT 4"; // limit to 6 items
    $result = $conn->query($sql);
    ?>
    <!-- Kids’ Leather Products Section -->
    <section class="kids-section">
        <h1>Kids’ Leather Collection</h1>
        <!-- Filter Section -->
        <div class="filter-section">
            <div>
                <label for="category">Category:</label>
                <select id="category">
                    <option value="all">All</option>
                    <option value="jackets">Jackets</option>
                    <option value="shoes">Shoes</option>
                    <option value="bags">Bags</option>
                    <option value="belt">Accessories</option>
                </select>
            </div>
            <div>
                <label for="price">Price Range:</label>
                <select id="price">
                    <option value="all">All</option>
                    <option value="0-50">₹0 - ₹500</option>
                    <option value="50-100">₹500 - ₹1000</option>
                    <option value="100-150">₹1000 - ₹1500</option>
                </select>
            </div>
        </div>
        <!-- Product Grid -->
        <div class="product-grid">
            <?php while ($row = $result->fetch_assoc()): ?>
                <!-- <div class="product-item"> -->
                <div class="product-item" data-category="<?= strtolower(htmlspecialchars($row['product_subcategory'])) ?>"
                    data-price="<?= htmlspecialchars($row['product_price']) ?>">

                    <img src="http://localhost/LUXE%20LEATHER%20UI/leather_shop/img/uploads/<?= htmlspecialchars($row['product_file']) ?>"
                        alt="Kids Leather Jacket">
                    <h2><?= htmlspecialchars($row['product_name']) ?></h2>
                    <span>₹<?= htmlspecialchars($row['product_price']) ?></span>
                    <!-- <a href="cart.php" class="btn">Add to Cart</a> -->
                    <button onclick="addToCart(<?= $row['id'] ?>)" class="btn">Add to Cart</button>

                </div>
            <?php endwhile; ?>
        </div>
    </section>
    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Leather Shop. All rights reserved.</p>

    </footer>
    <script>
            function filterProducts() {
            const selectedCategory = document.getElementById('category').value;
            const selectedPrice = document.getElementById('price').value;
            const products = document.querySelectorAll('.product-item');

            products.forEach(product => {
                const category = product.getAttribute('data-category');
                const price = parseInt(product.getAttribute('data-price'));
                let show = true;

                // Filter by category
                if (selectedCategory !== 'all' && category !== selectedCategory) {
                    show = false;
                }

                // Filter by price
                if (selectedPrice !== 'all') {
                    const [min, max] = selectedPrice.split('-').map(Number);
                    if (price < min * 10 || price > max * 10) {
                        show = false;
                    }
                }

                product.style.display = show ? 'block' : 'none';
            });
        }
        // Attach filter listeners
        document.getElementById('category').addEventListener('change', filterProducts);
        document.getElementById('price').addEventListener('change', filterProducts);
    </script>
</body>

</html>