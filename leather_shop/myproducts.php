<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Product | Leather Shop</title>
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

        /* Men’s Section Layout */
        .men-section {
            padding: 40px 20px;
        }

        .men-section h1 {
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

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999;
        }

        .modal-content {
            background: #fff;
            padding: 30px;
            border-radius: 5px;
            text-align: center;
        }

        .modal-content button {
            margin: 10px;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <!-- Header -->
    <?php
    define('APPROOT', dirname(__FILE__));
    require APPROOT . DIRECTORY_SEPARATOR . '../header.php';
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
    $sql = "SELECT * FROM admin_product"; // limit to 6 items
    $result = $conn->query($sql);
    ?>
    <div id="deleteModal" class="modal" style="display:none;">
        <div class="modal-content">
            <p>Are you sure you want to delete this product?</p>
            <button id="confirmDelete">Yes</button>
            <button onclick="closeModal()">No</button>
        </div>
    </div>

    <!-- Men’s Leather Products Section -->
    <section class="men-section">
        <h1>My Products</h1>

        <!-- Filter Section -->
        <div class="filter-section">
            <div>
                <label for="category">Category:</label>
                <select id="category">
                    <option value="all">All</option>
                    <option value="jackets">Jackets</option>
                    <option value="shoes">Shoes</option>
                    <option value="bags">Bags</option>
                </select>
            </div>
            <div>
                <label for="price">Price Range:</label>
                <select id="price">
                    <option value="all">All</option>
                    <option value="0-100">₹0 - ₹1000</option>
                    <option value="100-200">₹1000 - ₹2000</option>
                    <option value="200-500">₹2000 - ₹5000</option>
                </select>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="product-grid">
            <?php while ($row = $result->fetch_assoc()): ?>

                <div class="product-item" data-category="jackets" data-price="1500">
                    <!-- <form action=""> -->
                    <img src="http://localhost/LUXE%20LEATHER%20UI/leather_shop/img/uploads/<?= htmlspecialchars($row['product_file']) ?>"
                        alt="<?= htmlspecialchars($row['product_name']) ?>" alt="Leather Jacket">
                    <h2><?= htmlspecialchars($row['product_name']) ?></h2>
                    <span>₹<?= htmlspecialchars($row['product_price']) ?></span>
                    <!-- <button onclick="handleEdit(<?= $row['id'] ?>)" class="btn" style="cursor:pointer;">Edit</button> -->
                    <!-- <button onclick="handleEdit(
    <?= $row['id'] ?>, 
    '<?= addslashes(htmlspecialchars($row['product_name'])) ?>', 
    <?= $row['product_price'] ?>, 
    '<?= addslashes(htmlspecialchars($row['product_description'])) ?>', 
    '<?= addslashes(htmlspecialchars($row['product_category'])) ?>',
    '<?= addslashes(htmlspecialchars($row['product_subcategory'])) ?>', 
    '<?= addslashes(htmlspecialchars($row['product_file'])) ?>'
)" class="btn" style="cursor:pointer;">Edit</button> -->
                    <button onclick='handleEdit(
    <?= json_encode($row["id"]) ?>,
    <?= json_encode($row["product_name"]) ?>,
    <?= json_encode($row["product_price"]) ?>,
    <?= json_encode($row["product_description"]) ?>,
    <?= json_encode($row["product_category"]) ?>,
    <?= json_encode($row["product_subcategory"]) ?>,
    <?= json_encode($row["product_file"]) ?>
)' class="btn" style="cursor:pointer;">Edit</button>

                    <button onclick="handleDelete(<?= $row['id'] ?>)" class="btn" style="cursor:pointer;">Delete</button>
                    <!-- </form> -->
                </div>
            <?php endwhile; ?>
        </div>
    </section>
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
        function handleEdit(id, name, price, description, category, subcategory, image) {
            const url = new URL('/LUXE%20LEATHER%20UI/leather_shop/admin_edit_product.php', window.location.origin);

            url.searchParams.append('id', id);
            url.searchParams.append('name', name);
            url.searchParams.append('price', price);
            url.searchParams.append('description', description);
            url.searchParams.append('category', category);
            url.searchParams.append('subcategory', subcategory);
            url.searchParams.append('image', image);

            window.location.href = url.toString();
        }
        let deleteId = null;

        function handleDelete(id) {
            deleteId = id;
            document.getElementById("deleteModal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("deleteModal").style.display = "none";
            deleteId = null;
        }

        document.getElementById("confirmDelete").addEventListener("click", function () {
            if (deleteId) {
                window.location.href = `delete_product.php?id=${deleteId}`;
            }
        });
    </script>
    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Leather Shop. All rights reserved.</p>
    </footer>
</body>

</html>