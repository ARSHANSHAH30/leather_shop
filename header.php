<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leather Shop | Homepage</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
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

        /* Hero Section Styles */
        .hero {
            background: url('hero-bg.jpg') no-repeat center center/cover;
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .hero h1 {
            font-size: 48px;
        }

        .hero p {
            font-size: 24px;
            margin: 10px 0;
        }

        .hero .btn {
            padding: 10px 30px;
            background-color: #333;
            color: white;
            text-decoration: none;
            font-size: 20px;
            border-radius: 5px;
        }

        /* Featured Section Styles */
        .featured {
            padding: 40px 20px;
            text-align: center;
        }

        .featured h2 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .product-carousel {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .product-item {
            width: 200px;
            text-align: center;
        }

        .product-item img {
            width: 100%;
            height: auto;
        }

        /* Product Listings Section */
        .product-listing {
            padding: 40px 20px;
        }

        .filter-section {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .product-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .product-item {
            width: 200px;
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .product-item img {
            width: 100%;
            height: auto;
        }

        .product-item .btn {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 3px;
        }

        /* Product Detail Page */
        .product-detail {
            display: flex;
            padding: 40px;
        }

        .product-image img {
            width: 500px;
            height: auto;
        }

        .product-info {
            margin-left: 40px;
        }

        .product-info h1 {
            font-size: 32px;
        }

        .product-info span {
            font-size: 24px;
            color: green;
            margin-top: 10px;
            display: block;
        }

        .actions {
            margin-top: 20px;
        }

        .actions input {
            width: 50px;
            margin-right: 10px;
        }

        .actions .btn {
            padding: 10px 20px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        /* Footer Styles */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        .social-links a {
            color: white;
            margin: 0 10px;
        }
        .cart-container {
        width: 80%;
        margin: 40px auto;
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      }

      table {
        width: 100%;
        border-collapse: collapse;
      }

      th,
      td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
      }

      .quantity input {
        width: 50px;
        text-align: center;
      }

      .remove-btn {
        padding: 5px 10px;
        background-color: red;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 3px;
      }

      .checkout-btn {
        display: block;
        width: 200px;
        padding: 10px;
        background-color: #333;
        color: white;
        text-align: center;
        margin: 20px auto;
        text-decoration: none;
        border-radius: 5px;
      }
    </style>

</head>

<body>

    <!-- Header -->
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
        <div class="user-actions" id="user-actions">
            <a href="http://localhost/LUXE%20LEATHER%20UI/leather_shop/login.php" id="loginLink">LOGIN</a>
            <a href="cart.php" class="cart" id="cartVal">Cart (0)</a>
        </div>
    </header>
    <script>
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }

        // Function to delete a cookie
        function deleteCookie(name) {
            document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        }

        // Check if the username cookie` exists
        const username = getCookie("username");
        const isAdmin = getCookie("isAdmin");
        console.log('isAdmin', isAdmin);

        if (username) {
            const userActions = document.getElementById("user-actions");
            if (isAdmin) {
                userActions.innerHTML = `
        <span>Welcome, ${username}</span>
        <button id="logoutBtn" style="margin-left: 10px;cursor:pointer;">Logout</button>
        <a href="http://localhost/LUXE%20LEATHER%20UI/leather_shop/addcart.php" class="cart" id="cartVal">Add Product</a>
        <a href="http://localhost/LUXE%20LEATHER%20UI/leather_shop/myproducts.php" class="cart" id="cartVal">My Product</a>

        `;
            }
            else {
                userActions.innerHTML = `
        <span>Welcome, ${username}</span>
        <button id="logoutBtn" style="margin-left: 10px;cursor:pointer;">Logout</button>
        <a href="cart.php" class="cart" id="cartVal">Cart (0)</a>`
            }
            // Replace the login link with welcome message and logout button


            // Add click event to logout button
            document.getElementById("logoutBtn").addEventListener("click", () => {
                deleteCookie("username");
                deleteCookie("isAdmin");
                location.reload(); // Reload page after logout
            });
        }
        // function updateCartCounter() {
        //     let cartCount = 0;
        //     let items = [
        //         "mens_leather_jacket", "mens_leather_shoes", "mens_leather_bag",
        //         "womens_womens_leather_jacket", "womens_trendy_leather_bag", "womens_stylish_leather_boots", "womens_leather_sandals",
        //         "kids_kids_leather_jacket", "kids_kids_leather_shoes", "kids_kids_leather_bag", "kids_leather_belt"
        //     ];

        //     items.forEach((item) => {
        //         cartCount += parseInt(localStorage.getItem(item) || "0");
        //     });

        //     document.getElementById("cartVal").textContent = `Cart (${cartCount})`;
        // }

        function addToCart(productId) {
            const key = `product_${productId}`;
            let qty = localStorage.getItem(key);
            localStorage.setItem(key, qty ? parseInt(qty) + 1 : 1);

            updateCartCounter();
        }

        function updateCartCounter() {
            let count = 0;
            for (let key in localStorage) {
                if (key.startsWith("product_")) {
                    count += parseInt(localStorage.getItem(key)) || 0;
                }
            }
            document.getElementById("cartVal").textContent = `Cart (${count})`;
        }


        // document.addEventListener("DOMContentLoaded", updateCartCounter);
        document.addEventListener("DOMContentLoaded", () => {
            const isAdmin = getCookie("isAdmin");
            if (!isAdmin) {
                updateCartCounter();
            }
        });
    </script>