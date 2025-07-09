<?php
// admin_edit_product.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "leather_shop";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$product = 10;
$id = $_GET['id'] ?? '';
$name = $_GET['name'] ?? '';
$price = $_GET['price'] ?? '';
$description = $_GET['description'] ?? '';
$category = $_GET['category'] ?? '';
$subcategory = $_GET['subcategory'] ?? '';
$image = $_GET['image'] ?? '';
// echo $subcategory;
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Add Product | Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 40px;
        }

        .container {
            width: 400px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        button:hover {
            background-color: #555;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #333;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php if ($product): ?>
        <div class="container">
            <h2>Edit Product</h2>
            <form action="admin_edit_product_backend.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required><br>
                <input type="number" name="price" value="<?= htmlspecialchars($price) ?>" required><br>
                <div>
                <select name="category" id="category" style="width: calc(100% + 20px);padding: 10px 0;" required>
                    <option value="Men" <?= $category == 'Men' ? 'selected' : '' ?>>Men</option>
                    <option value="Women" <?= $category == 'Women' ? 'selected' : '' ?>>Women</option>
                    <option value="Kids" <?= $category == 'Kids' ? 'selected' : '' ?>>Kids</option>
                </select>
                </div>
                <br>
                <div>
                    <select name="subcategory" id="sub-category" required
                        style="width: calc(100% + 20px);padding: 10px 0;">
                        <option value="" disabled>Please Select a Category First</option>
                    </select>
                </div>
                <br>
                <textarea name="description" required><?= htmlspecialchars($description) ?></textarea><br>
                <!-- <img src="img/uploads/<?= htmlspecialchars($image) ?>" width="100"><br> -->
                <img id="imagePreview" src="img/uploads/<?= htmlspecialchars($image) ?>" width="100"><br>

                <input type="file" name="image"><br>
                <button type="submit">Update Product</button>
            </form>
            <a class="back-link" href="admin_dashboard.php">← Back to Dashboard</a>
        </div>
    <?php else: ?>
        <p>Product not found.</p>
    <?php endif; ?>
    <!-- <script>
        

        document.getElementById("logoutBtn").addEventListener("click", () => {
                deleteCookie("username");
                deleteCookie("isAdmin");
                location.reload(); // Reload page after logout
            });

    const subCategoryOptions = {
        Men: ["Jackets", "Shoes", "Bags"],
        Women: ["Bags", "Jackets", "Boots", "Sandals"],
        Kids: ["Jackets", "Shoes", "Bags", "Accessories"]
    };

    const categorySelect = document.getElementById("category");
    const subCategorySelect = document.getElementById("sub-category");

    // This value is injected from PHP for preselection
    const selectedCategory = "<?= htmlspecialchars($category) ?>";
    const selectedSubCategory = "<?= htmlspecialchars($subcategory) ?>";

    // Populate sub-category based on category (initial load or on change)
    function populateSubCategories(category, selectedSub) {
        subCategorySelect.innerHTML = `<option value="" disabled>Select Sub Category</option>`;

        if (subCategoryOptions[category]) {
            subCategoryOptions[category].forEach(subCat => {
                const option = document.createElement("option");
                option.value = subCat;
                option.textContent = subCat;
                if (subCat === selectedSub) {
                    option.selected = true;
                }
                subCategorySelect.appendChild(option);
            });
        }
    }

    // Populate on page load (for edit mode)

    // Also re-populate if category changes (clear selected sub-category)
    categorySelect.addEventListener("change", function () {
        populateSubCategories(this.value, "");
    });
    document.addEventListener("DOMContentLoaded", function () {
    populateSubCategories(selectedCategory, selectedSubCategory);

            const imageInput = document.querySelector('input[name="image"]');
            const imagePreview = document.getElementById('imagePreview');

            imageInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        imagePreview.src = e.target.result;
                    };

                    reader.readAsDataURL(file);
                }
            });
            
        });
    </script>
    -->
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const subCategoryOptions = {
        Men: ["Jackets", "Shoes", "Bags"],
        Women: ["Bags", "Jackets", "Boots", "Sandals"],
        Kids: ["Jackets", "Shoes", "Bags", "Belt"]
    };

    const categorySelect = document.getElementById("category");
    const subCategorySelect = document.getElementById("sub-category");

    const selectedCategory = "<?= htmlspecialchars($category) ?>";
    const selectedSubCategory = "<?= htmlspecialchars($subcategory) ?>";
    console.log('subs',selectedSubCategory);
    // console.log('subs',selectedCategory);

    function populateSubCategories(category, selectedSub) {
        subCategorySelect.innerHTML = `<option value="" disabled>Select Sub Category</option>`;

        if (subCategoryOptions[category]) {
            subCategoryOptions[category].forEach(subCat => {
                const option = document.createElement("option");
                option.value = subCat;
                option.textContent = subCat;
                if (subCat.toLowerCase() === selectedSub.toLowerCase()) {
                    option.selected = true;
                }
                subCategorySelect.appendChild(option);
            });
        }
    }

    // Initial population
    populateSubCategories(selectedCategory, selectedSubCategory);

    // Re-populate on change
    categorySelect.addEventListener("change", function () {
        populateSubCategories(this.value, "");
    });

    // Image preview
    const imageInput = document.querySelector('input[name="image"]');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    });
});
</script>

</body>

</html>