<?php
    define('APPROOT', dirname(__FILE__));
    require APPROOT . DIRECTORY_SEPARATOR . 'header.php';
    ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    loadCart();
});
function loadCart() {
    const cartBody = document.getElementById("cart-body");
    cartBody.innerHTML = "";

    const productMap = {};
    const productIds = [];

    for (let key in localStorage) {
        if (key.startsWith("product_")) {
            const id = parseInt(key.replace("product_", ""));
            const qty = parseInt(localStorage.getItem(key));
            if (qty > 0) {
                productIds.push(id);
                productMap[id] = qty;
            }
        }
    }

    if (productIds.length === 0) {
        cartBody.innerHTML = "<tr><td colspan='5'>Your cart is empty.</td></tr>";
        document.getElementById("total-amount").textContent = "₹0";
        document.getElementById("cartVal").textContent = `Cart (0)`;
        return;
    }

    fetch("http://localhost/LUXE%20LEATHER%20UI/leather_shop/fetch_cart_products.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(productIds)
    })
    .then(res => res.json())
    .then(products => {
        let total = 0;
        let count = 0;

        products.forEach(product => {
            const qty = productMap[product.id];
            const price = parseFloat(product.product_price);
            const itemTotal = qty * price;
            total += itemTotal;
            count += qty;

            cartBody.innerHTML += `
                <tr id="product_${product.id}-row">
                    <td>${product.product_name}</td>
                    <td>₹${price}</td>
                    <td style="width:300px">
                        <button onclick="updateQty(${product.id}, 'remove')">-</button>
                        <input type="text" id="product_${product.id}_qty" value="${qty}" style="width: 10%;text-align: center;">
                        <button onclick="updateQty(${product.id}, 'add')">+</button>
                    </td>
                    <td id="product_${product.id}_total">₹${itemTotal.toFixed(2)}</td>
                    <td><button onclick="removeItem(${product.id})">Remove</button></td>
                </tr>`;
        });

        document.getElementById("total-amount").textContent = `₹${total.toFixed(2)}`;
        document.getElementById("cartVal").textContent = `Cart (${count})`;
    });
}

function updateQty(productId, action) {
    const key = `product_${productId}`;
    let qty = parseInt(localStorage.getItem(key)) || 0;

    if (action === "add") {
        qty += 1;
    } else if (action === "remove") {
        qty = Math.max(0, qty - 1);
    }

    if (qty === 0) {
        localStorage.removeItem(key);
    } else {
        localStorage.setItem(key, qty);
    }

    loadCart();
    syncCartToServer();
}

function removeItem(productId) {
    localStorage.removeItem(`product_${productId}`);
    loadCart();
    syncCartToServer();
}

function collectCartItems() {
    const items = [];

    document.querySelectorAll("#cart-body tr").forEach(row => {
        const product = row.querySelector("td:nth-child(1)").textContent;
        const price = parseFloat(row.querySelector("td:nth-child(2)").textContent.replace("₹", ""));
        const qty = parseInt(row.querySelector("input[type='text']").value);
        const total = parseFloat(row.querySelector("td:nth-child(4)").textContent.replace("₹", ""));
        if (qty > 0) {
            items.push({ product, price, quantity: qty, total });
        }
    });

    return items;
}

function syncCartToServer() {
    const user_id = localStorage.getItem("user_id");
    if (!user_id) return;

    const payload = {
        user_id: parseInt(user_id),
        cart: collectCartItems()
    };

    fetch("http://localhost/LUXE%20LEATHER%20UI/leather_shop/save_cart.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => console.log("✅ Cart synced", data))
    .catch(err => console.error("❌ Sync failed", err));
}
function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }
function saveGrandTotal() {
    const username = getCookie("username");
    if (!username) {
        window.location.href = "http://localhost/LUXE%20LEATHER%20UI/leather_shop/login.php";
        return
    }
    const totalText = document.getElementById("total-amount").textContent;
    const amount = parseFloat(totalText.replace("₹", "")) || 0;
    localStorage.setItem("grand_total", amount.toFixed(2));
    window.location.href = "delivery.html";
}
</script>
<div class="cart-container">
      <h2>Shopping Cart</h2>
      <table>
        <thead>
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="cart-body">
        </tbody>
        <tfoot>
          <tr id="total-amount-row">
            <td colspan="3" style="text-align: left">
              <strong>Total Amount:</strong>
            </td>
            <td id="total-amount"><strong>₹0</strong></td>
            <td></td>
          </tr>
        </tfoot>
      </table>
      <button class="checkout-btn" style="cursor:pointer;" onclick="saveGrandTotal()">Proceed to Delivery</button>
      </div>
