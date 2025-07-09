<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Upcoming Releases | Leather Shop</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      background-color: #333;
      color: white;
    }

    .logo {
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
      margin-left: 10px;
    }

    .section-title {
      text-align: center;
      margin: 30px 0;
      font-size: 32px;
      color: #333;
    }

    .products {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      padding: 0 20px 40px;
    }

    .product-card {
      background-color: white;
      border-radius: 8px;
      width: 250px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      overflow: hidden;
      text-align: center;
      padding: 20px;
    }

    .product-card img {
      width: 100%;
      height: auto;
      border-radius: 5px;
    }

    .product-card h3 {
      margin: 10px 0;
    }

    .product-card p {
      color: green;
      font-weight: bold;
      margin: 5px 0;
    }

    .product-card button {
      margin-top: 10px;
      padding: 10px 15px;
      background-color: #333;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .product-card button:hover {
      background-color: #555;
    }

    footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 15px 0;
    }

    .social-links a {
      color: white;
      margin: 0 10px;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header>
    <div class="logo">Leather Shop</div>
    <nav>
      <ul>
        <li><a href="website.php">Home</a></li>
        <li><a href="men1.php">Men</a></li>
        <li><a href="women.php">Women</a></li>
        <li><a href="kids.php">Kids</a></li>
        <li><a href="Upcoming release.php">Upcoming Releases</a></li>
      </ul>
    </nav>
    <div class="user-actions">
      <a href="http://localhost/LUXE%20LEATHER%20UI/leather_shop/login.php" id="loginLink">LOGIN</a>
      </div>
  </header>
  <!-- New Releases Section -->
  <h2 class="section-title">Upcoming Releases</h2>
  <div class="products" id="new-releases">
    <!-- Products will be injected here -->
  </div>
  <!-- Footer -->
  <footer>
    <p>&copy; 2024 Leather Shop. All rights reserved.</p>
  </footer>
  <!-- Script to populate and manage cart -->
  <script>
    const newReleases = [
      {
        name: "Premium Leather Tote",
        price: 1800,
      },
      {
        name: "Classic Leather Boots",
        price: 2100,
      },
      {
        name: "Elegant Leather Purse",
        price: 1300,
      },
      {
        name: "Men's Limited Edition Jacket",
        price: 2500,
      }
    ];
    const container = document.getElementById("new-releases");
    newReleases.forEach(product => {
      const card = document.createElement("div");
      card.className = "product-card";
      card.innerHTML = `
        
        <h3>${product.name}</h3>
        <p>₹${product.price}</p>
      `;
      container.appendChild(card);
    });
    </script>
</body>
</html>
