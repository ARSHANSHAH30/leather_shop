<?php
// Redirect if not logged in as admin using cookies
if (!isset($_COOKIE['isAdmin'])) {
    header("Location: http://localhost/LUXE%20LEATHER%20UI/website.php");
    exit();
}
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
            /* padding: 40px; */
            margin: 0;
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
    </style>
</head>

<body>
<header>
        <div class="logo">Leather Shop</div>
        <nav>
            <ul>
                <li><a href="http://localhost/LUXE%20LEATHER%20UI/website.php">Home</a></li>
                <li><a href="http://localhost/LUXE%20LEATHER%20UI/men1.php">Men</a></li>
                <li><a href="http://localhost/LUXE%20LEATHER%20UI/women.php">Women</a></li>
                <li><a href="http://localhost/LUXE%20LEATHER%20UI/kids.php">Kids</a></li>
                <li><a href="http://localhost/LUXE%20LEATHER%20UI/Upcoming release.php">Upcoming Releases</a></li>
            </ul>
        </nav>
        <div class="user-actions"  id="user-actions">
            <!-- <a href="http://localhost/LUXE%20LEATHER%20UI/leather_shop/login.php" id="loginLink">LOGOUT</a> -->
        <button id="logoutBtn" style="margin-left: 10px;cursor:pointer;">Logout</button>

            <!-- <a href="cart.php" class="cart" id="cartVal">Cart (0)</a> -->
        </div>
    </header>
    <div style="padding:40px 0;">
    <div class="container">
        <h2>Add New Product</h2>
        <form action="admin_add_product_backend.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Product Name" required />
            <input type="number" name="price" placeholder="Price (e.g., 199.99)" required />
            <div>
                <select name="category" id="category" required style="width: calc(100% + 20px);padding: 10px 0;">
                    <option value="" disabled selected>Select Category</option>
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>
                    <option value="Kids">Kids</option>
                </select>
            </div>
            <br>
            <div>
                <select name="sub-category" id="sub-category" required style="width: calc(100% + 20px);padding: 10px 0;">
                    <option value="" disabled selected>Please Select a Category First</option>
                </select>
            </div>
            <br>
            <input type="file" name="image" placeholder="Image Filename (e.g., jacket.jpg)" />
            <textarea name="description" placeholder="Product Description" rows="4" required></textarea>
            <button type="submit" name="add">Add Product</button>
        </form>
        <a class="back-link" href="http://localhost/LUXE%20LEATHER%20UI/website.php">← Back to Dashboard</a>
    </div>
    </div>
    <script>
        document.getElementById("logoutBtn").addEventListener("click", () => {
                deleteCookie("username");
                deleteCookie("isAdmin");
                location.reload(); // Reload page after logout
            });
            const subCategoryOptions = {
        Men: ["Jackets", "Shoes", "Bags"],
        Women: ["Bags", "Jackets", "Boots","Sandals"],
        Kids: ["Jackets", "Shoes", "Bags","Accessories"]
    };

    const categorySelect = document.getElementById("category");
    const subCategorySelect = document.getElementById("sub-category");

    categorySelect.addEventListener("change", function () {
        const selectedCategory = this.value;
        
        // Clear current sub-category options
        subCategorySelect.innerHTML = `<option value="" disabled selected>Select Sub Category</option>`;

        // Populate new sub-category options
        if (subCategoryOptions[selectedCategory]) {
            subCategoryOptions[selectedCategory].forEach(subCat => {
                const option = document.createElement("option");
                option.value = subCat;
                option.textContent = subCat;
                subCategorySelect.appendChild(option);
            });
        }
    });
    </script>
    
</body>

</html>